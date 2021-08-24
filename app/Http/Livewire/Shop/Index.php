<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;


    public function mount()
    {
        $this->search = request()->query('search', $this->search);

    }

    public function render()
    {
        $product =  $this->search === null ?
        Product::latest()->paginate(8) :
        Product::latest()->where('title', 'like', '%' . $this->search . '%')->paginate(8);
        return view('livewire.shop.index',[
            'products' => $product,
        ])->extends('layouts.app');
    }
}
