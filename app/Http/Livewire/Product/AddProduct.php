<?php

namespace App\Http\Livewire\Product;

use App\Models\ShopCategory;
use App\Models\ShopProduct;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public $category;
    public $name, $image, $category_id, $buying_price, $price, $stock, $details;

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

    public function addProduct(){
        $this->validate();
        $product = new ShopProduct;
        if($this->image==null){
            $product->name = $this->name;
            $product->image = 'https://dummyimage.com/400x280/000/d1d1d1&text=Demo+Image';
            $product->category_id = $this->category_id;
            $product->buying_price = $this->buying_price;
            $product->price = $this->price;
            $product->stock = $this->stock;
            $product->details = $this->details;
            $product->save();
            if($product){
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'success',
                    'message'=>"Product insert success!!"
                ]);
            }else{
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'error',
                    'message'=>"Product insert failed!!"
                ]);
            }
        }else{
            $image = $this->image->store('photos');
            $product->name = $this->name;
            $product->image = 'http://'.Request::getHttpHost().'/storage/'.$image;
            $product->category_id = $this->category_id;
            $product->buying_price = $this->buying_price;
            $product->price = $this->price;
            $product->stock = $this->stock;
            $product->details = $this->details;
            $product->save();
            if($product){
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'success',
                    'message'=>"Product insert success!!"
                ]);
            }else{
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'error',
                    'message'=>"Product insert failed!!"
                ]);
            }
        }
    }

    public function mount(){
        $this->category = ShopCategory::all();
    }

    public function render()
    {
        return view('livewire.product.add-product');
    }
}
