<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controllers
{
    /**
     * Display a listing of the sales.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sales = Sale::with('customer', 'saleDetails.book')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $sales
        ]);
    }

    /**
     * Store a newly created sale in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required|date',
            'total_amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $sale = Sale::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Sale created successfully',
            'data' => $sale
        ], 201);
    }

    /**
     * Display the specified sale.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $sale = Sale::with('customer', 'saleDetails.book')->find($id);
        
        if (!$sale) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sale not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $sale
        ]);
    }

    /**
     * Update the specified sale in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        
        if (!$sale) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sale not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'exists:customers,id',
            'sale_date' => 'date',
            'total_amount' => 'numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $sale->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Sale updated successfully',
            'data' => $sale
        ]);
    }

    /**
     * Remove the specified sale from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        
        if (!$sale) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sale not found'
            ], 404);
        }

        $sale->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Sale deleted successfully'
        ]);
    }
}