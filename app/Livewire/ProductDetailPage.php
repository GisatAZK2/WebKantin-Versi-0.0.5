<?php
namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductDetailPage extends Component
{
    

    public $name;

    

    public function render()
    {
        return view('livewire.product-detail-page', [
            'products' => Product::with('variants')
                ->where('name', $this->name)
                ->firstOrFail(),
        ]);
    }
}
