<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class ProductPage extends Component
{
    use WithPagination;

    public $selected_kategoris = [];
    public $search = '';

    public function mount()
    {
        $this->selected_kategoris = request()->input('selected_kategoris', []);
    }

    public function render()
    {
        $kategoris = Kategori::all();

        $productQuery = Product::query()
            ->where('status', 1)
            ->with('variants');

    
        if (!empty($this->selected_kategoris)) {
            $productQuery->whereHas('kategori', function ($query) {
                $query->whereIn('id', $this->selected_kategoris);
            });
        }

        
        if (!empty($this->search)) {
            $productQuery->where('name', 'like', '%' . $this->search . '%');
        }

        $products = $productQuery->paginate(6);

        
        $products->getCollection()->transform(function ($product) {
            if ($product->variants->isNotEmpty()) {
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

        return view('livewire.product-page', [
            'products' => $products,
            'kategoris' => $kategoris,
        ]);
    }

    
    public function toggleKategori($kategoriId)
    {
        if (in_array($kategoriId, $this->selected_kategoris)) {
            $this->selected_kategoris = array_diff($this->selected_kategoris, [$kategoriId]);
        } else {
            $this->selected_kategoris[] = $kategoriId;
        }

    
        $this->resetPage();
    }

    public function performSearch()
    {
        $this->resetPage(); 
    }

    
    public function updatedSearch()
    {
        $this->resetPage();
    }

    
    protected function getQueryString()
    {
        return [
            'search' => ['as' => 'search'],
            'selected_kategoris' => ['as' => 'selected_kategoris'],
            'page' => ['as' => 'page']
        ];
    }
}
