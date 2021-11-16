<?php

namespace App\Http\Livewire;

use App\Models\ShopCategory;
use App\Models\ShopProduct;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
class Product extends Component
{
    use WithFileUploads;

    public $products, $sl = 1;
    public $selectId;
    public $name, $oldImage, $image, $category_id, $buying_price, $price, $stock, $details;
    public $category;

    protected $rules = [
        'name' => 'required|string',
        'category_id' => 'required',
        'buying_price' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'details' => ''
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function selectProduct($id)
    {
        $product = ShopProduct::find($id);
        $this->image = null;
        $this->selectId = $id;
        $this->name = $product->name;
        $this->oldImage = $product->image;
        $this->category_id = $product->category_id;
        $this->buying_price = $product->buying_price;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->details = $product->details;
    }

    public function updateProduct()
    {
        $this->validate();
        $product = ShopProduct::find($this->selectId);
        if ($this->image == null) {
            $product->name = $this->name;
            $product->category_id = $this->category_id;
            $product->buying_price = $this->buying_price;
            $product->price = $this->price;
            $product->stock = $this->stock;
            $product->details = $this->details;
            $product->save();
            if ($product) {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'success',
                    'message' => "Product update success!!"
                ]);
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'message' => "Product update failed!!"
                ]);
            }
        } else {
            $path = parse_url($this->oldImage);
            if (File::exists(public_path($path['path']))) {
                File::delete(public_path($path['path']));
            }
            $image = $this->image->store('photos');
            $product->name = $this->name;
            $product->image = 'http://'.Request::getHttpHost().'/storage/'.$image;
            $product->category_id = $this->category_id;
            $product->buying_price = $this->buying_price;
            $product->price = $this->price;
            $product->stock = $this->stock;
            $product->details = $this->details;
            $product->save();
            if ($product) {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'success',
                    'message' => "Product update success!!"
                ]);
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'message' => "Product update failed!!"
                ]);
            }
        }
        $this->mount();
    }

    public function deleteProduct(){
        $product = ShopProduct::find($this->selectId);
        $path = parse_url($this->oldImage);
        if (File::exists(public_path($path['path']))) {
            File::delete(public_path($path['path']));
        }
        $product->delete();
        $this->mount();
    }

    public function mount()
    {
        $this->products = ShopProduct::orderBy('id', 'desc')->get();
        $this->category = ShopCategory::all();
    }

    public function render()
    {
        return view('livewire.product.product');
    }
}
