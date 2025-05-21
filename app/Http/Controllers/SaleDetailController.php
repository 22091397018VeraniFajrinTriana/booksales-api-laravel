<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use App\Models\Sale;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleDetailController extends Controllers
{
    /**
     * Display a listing of the sale details.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $saleDetails = SaleDetail::with('sale', 'book')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $saleDetails
        ]);
    }

    /**
     * Store a newly created sale detail in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sale_id' => 'required|exists:sales,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if the book has enough stock
        $book = Book::find($request->book_id);
        if ($book->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not enough stock available for this book'
            ], 422);
        }

        // Decrease book stock
        $book->stock -= $request->quantity;
        $book->save();

        // Create sale detail
        $saleDetail = SaleDetail::create($request->all());

        // Update sale total amount
        $sale = Sale::find($request->sale_id);
        $sale->total_amount += ($request->price * $request->quantity);
        $sale->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Sale detail created successfully',
            'data' => $saleDetail
        ], 201);
    }

    /**
     * Display the specified sale detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $saleDetail = SaleDetail::with('sale', 'book')->find($id);
        
        if (!$saleDetail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sale detail not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $saleDetail
        ]);
    }

    /**
     * Update the specified sale detail in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $saleDetail = SaleDetail::find($id);
        
        if (!$saleDetail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sale detail not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'sale_id' => 'exists:sales,id',
            'book_id' => 'exists:books,id',
            'quantity' => 'integer|min:1',
            'price' => 'numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // If quantity is being updated, adjust the book stock
        if ($request->has('quantity') && $request->quantity != $saleDetail->quantity) {
            $book = Book::find($saleDetail->book_id);
            
            // Return stock from the old quantity
            $book->stock += $saleDetail->quantity;
            
            // Check if there's enough stock for the new quantity
            if ($book->stock < $request->quantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Not enough stock available for this book'
                ], 422);
            }
            
            // Deduct stock for the new quantity
            $book->stock -= $request->quantity;
            $book->save();
            
            // Update sale total amount
            $sale = Sale::find($saleDetail->sale_id);
            $sale->total_amount -= ($saleDetail->price * $saleDetail->quantity);
            $sale->total_amount += ($request->price ?? $saleDetail->price) * $request->quantity;
            $sale->save();
        }

        $saleDetail->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Sale detail updated successfully',
            'data' => $saleDetail
        ]);
    }

    /**
     * Remove the specified sale detail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $saleDetail = SaleDetail::find($id);
        
        if (!$saleDetail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sale detail not found'
            ], 404);
        }

        // Return stock to book
        $book = Book::find($saleDetail->book_id);
        $book->stock += $saleDetail->quantity;
        $book->save();

        // Update sale total amount
        $sale = Sale::find($saleDetail->sale_id);
        $sale->total_amount -= ($saleDetail->price * $saleDetail->quantity);
        $sale->save();

        $saleDetail->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Sale detail deleted successfully'
        ]);
    }
}