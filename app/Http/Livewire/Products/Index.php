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

    public function render()
    {
        // protected $paginationTheme = 'bootstrap';
        $tes = Product::orderBy('id', 'DESC')->paginate($this->paginate);
        return view('livewire.products.index', [
            'tes' => $tes,
        ])->extends('layouts.app');
    }

}
