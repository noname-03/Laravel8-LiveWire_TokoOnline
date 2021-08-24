<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $productId;
    public $title;
    public $description;
    public $price;
    public $image;
    public $imageOld;

    protected $listeners = [
        'edit.product' => 'editProductHandler'
    ]; // karena menggunakan emit maka harus menggunakan listeners

    public function render()
    {
        return view('livewire.products.update');
    }

    public function editProductHandler($product)
    {
        $this->productId = $product['id'];
        $this->title = $product['title'];
        $this->description = $product['description'];
        $this->price = $product['price'];
        $this->imageOld = asset('/storage/' . $product['image']);
    }
    public function update()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:500',
            'price' => 'required|numeric',
            'image' => 'required|max:1024'
        ]);

        if ($this->productId) {
            $product = Product::find($this->productId);//mencari data

            $image = ''; //untuk menghilangkan erer maka kita harus membuat varibale baru
            if ($this->image) { //jika ada data baru maka akan memproses ini
                Storage::disk('public')->delete($product->image);
                $imageName = \Str::slug($this->title, '-')
                . '-'
                . uniqid()
                . '.' . $this->image->getClientOriginalExtension();

                $this->image->storeAs('public', $imageName, 'local');
                $image = $imageName; // $image dari variabel kosong
            }else{ //jika tidak ada maka akan memproses ini
                $image = $product->image; // $image dari variable kosong
            }
            $product->update([
                'title' => $this->title,
                'price' => $this->price,
                'description' => $this->description,
                'image' => $image
                ]);

                $this->emit('productUpdated');
        }
    }
}
