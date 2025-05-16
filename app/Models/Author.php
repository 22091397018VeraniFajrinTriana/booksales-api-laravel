use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'bio',
        'country'
    ];

    /**
     * Get the books for the author.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}