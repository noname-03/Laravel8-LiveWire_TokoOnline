<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    //deklarasi field dari database
    public $title;
    public $description;
    public $price;
    public $image;

    public function render()
    {
        return view('livewire.products.create');
    }
    public function store()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:500',
            'price' => 'required|numeric',
            'image' => 'required|max:1024'
        ]);

        //validasi untuk nama foto yang akan digunakan
        $imageName = '';
        if ($this->image) {
            $imageName = \Str::slug($this->title, '-')
                . '-'
                . uniqid()
                . '.' . $this->image->getClientOriginalExtension();

            $this->image->storeAs('public', $imageName, 'local');
        }

        Product::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imageName
        ]);
        // if ($this->image) {
        //     $imageName = \Str::slug($this->title, '-')
        //         . '-'
        //         . uniqid()
        //         . '.' . $this->image->getClientOriginalExtension();

        //     $this->image->storeAs('public', $imageName, 'local');
        //     //nama diambil dari slug yaitu dari title yang dipisah dengan "-" dan "-" lalau unikid random dan mengambil extention dari orginal foto

        // }

        // $products = [
        //     'title' => $this->title,
        //     'description' => $this->description,
        //     'price' => $this->price,
        //     'image' => $this->$imageName
        // ];
        // dd($products);
        // Product::create($products);
        $this->emit('productStore');
    }
}
