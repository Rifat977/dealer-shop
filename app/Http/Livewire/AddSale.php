<?php

namespace App\Http\Livewire;

use App\Models\SaleProduct;
use App\Models\ShopProduct;
use App\Models\ShopSale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;


class AddSale extends Component
{
    public $total, $discount=0;
    public $customer_name="Walk in customer", $number, $sale_date, $received_amount;

    protected $rules = [
        'customer_name' => 'required|string',
    ];

    public function addToCart($id){
        $product = ShopProduct::findOrFail($id);
        $res = Cart::add($product->id, $product->name,1, $product->price);
        if($res){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Item added to cart!!"
        ]);
                }
        $this->mount();
    }

    public function removeCart($rowId){
        Cart::remove($rowId);
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Cart item deleted!!"
            ]);
        $this->mount();
    }

    public function increment($rowId){
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty+=1);
        $this->mount();
    }

    public function decrement($rowId){
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty-=1);
        $this->mount();
    }

    public function destroyCart(){
        Cart::destroy();
        $this->mount();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'error',
            'message' => "Cart item removed!!"
        ]);
    }

    public function addSale(){
        $this->validate();
        $priceTotal = Cart::priceTotal();
        $sale = ShopSale::create([
            'customer_name' => $this->customer_name,
            'number' => $this->number,
            'price_total' => $priceTotal,
            'tax' => Cart::tax(),
            'discount' => Cart::discount(),
            'total' => Cart::total(),
            'sale_date' => $this->sale_date,
            'payment' => $this->received_amount > Cart::total() ? Cart::total() : $this->received_amount,
        ]);
        $cart = Cart::content();
        foreach($cart as $item){
            $product = ShopProduct::find($item->id);
            $product->stock = $product->stock-$item->qty;
            $product->save();
            $profit = $item->price-$product->buying_price;
            $sale->product()->create([
                'product_id' => $item->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'weight' => $item->weight,
                'discount' => $item->discount,
                'tax' => $item->tax,
                'subtotal' => $item->subtotal,
                'profit' => $profit*$item->qty,
            ]);
        }
        if($cart){
            Cart::destroy();
            $this->mount();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Product sold successfully!!"
            ]);
        }
        $this->mount();

    }

    public function mount(){       
        $this->render();
    }

    public function render()
    {
        $products = ShopProduct::all();
        $cart = Cart::content();
        return view('livewire.sale.add-sale', compact('products', 'cart'));
    }
}
