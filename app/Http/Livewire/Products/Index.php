<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
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
    public $formUpdate = false;

    protected $listeners = [
        'formClose' => 'formCloseHandler',
        'productStore' => 'productStoreHandler',
        'productUpdated' => 'productUpdatedHendler'
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

    public function editProduct($productId)
    {
        $this->formUpdate = true;
        $this->formVisible = true;
        $product = Product::find($productId);
        $this->emit('edit.product', $product);//mnengirim data dari component index ke component update livewire
    }

    public function productUpdatedHendler()
    {
        $this->formVisible = false;
        session()->flash('message', 'Your Product Was Updated');
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image); //jika file atau data mempunyai data maka akan menghapus gambar terlebih dahulu
        }
        $product->delete();
        session()->flash('message', 'Product Was Deleted!');
    }
}
