<?php
namespace App\Livewire;

use App\Models\Kategori;
use App\Models\Banner;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Beranda - Kantin Cisat')]
class HomePage extends Component
{
    public function render()
    {
        
        
        $banner = Banner::inRandomOrder()->first(); 

    
        $kategoris = Kategori::all();

       
        $productQuery = Product::query()
            ->where('status', 1)
            ->with('variants'); 

        
        $products = $productQuery->paginate(20);

        
        $products->getCollection()->transform(function ($product) {
            if ($product->variants->isNotEmpty()) {
                // Get the minimum and maximum prices from the variants
                $product->price_min = $product->variants->min('price');
                $product->price_max = $product->variants->max('price');

                $product->total_stock = $product->variants->sum('stock');
            } else {
                
                $product->price_min = 0;
                $product->price_max = 0;

                $product->total_stock = $product->stock ?? 0;
            }

            return $product;
        });

        
        return view('livewire.home-page', compact('banner', 'kategoris'), [
            'products' => $products,]); 
    }
}
