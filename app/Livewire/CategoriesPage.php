<?php

namespace App\Livewire;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Kategori - Kantin Cisat')]
class CategoriesPage extends Component
{
    public function render()
    {
        $kategoris = Kategori::all();
 
        return view('livewire.categories-page',compact('kategoris'));
    }
}
