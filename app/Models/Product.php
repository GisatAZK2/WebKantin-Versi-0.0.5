<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'stock',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function kategori(){
    return $this->belongsTo(Kategori::class, 'category_id'); 
}

    // Relasi ke Variant
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images')->singleFile();  
    }
}
