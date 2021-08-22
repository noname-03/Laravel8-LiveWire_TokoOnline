<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search;
    // protected $updatesQueryString = [
    //   ['search']
    // ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        // protected $paginationTheme = 'bootstrap';
        // $product = Product::latest()->paginate($this->paginate);//ini adalah awal
        $product =  $this->search === null ?
                    Product::latest()->paginate($this->paginate) :
                    Product::latest()->where('title', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        return view('livewire.products.index', [
            'products' => $product,
        ])->extends('layouts.app');
    }

}
