<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variant extends Model  implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'stock',
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
