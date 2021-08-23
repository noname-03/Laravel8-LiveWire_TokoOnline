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
    public $formVisible; // show form with wrie:click
    // protected $updatesQueryString = [
    //   ['search']
    // ];

    protected $listeners = [
        'formClose' => 'formCloseHandler',
        'productStore' => 'productStoreHandler'
    ];


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

    public function formCloseHandler()
    {
        $this->formVisible = false;
    }
    public function productStoreHandler()
    {
        $this->formVisible = false;// refresh halaman setelah submit
        session()->flash('message', 'Your Product Was Stored');

    }

}
