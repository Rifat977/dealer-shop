<?php

namespace App\Http\Livewire;

use App\Models\ShopSale;
use Livewire\Component;

class SaleList extends Component
{
    public $findSale, $sale;
    public $selectId, $sale_date, $customer_name, $number, $price_total, $total, $paid;

    public function redirectToInvoice($id){
        return redirect()->route('viewsale',$id);
    }

    public function findSale($id){
        $this->findSale = ShopSale::with('product')->find($id);
        $this->sale_date = $this->findSale->sale_date;
        $this->price_total = $this->findSale->price_total;
        $this->total = $this->findSale->total;
        $this->paid = $this->findSale->payment;
        $this->customer_name = $this->findSale->customer_name;
        $this->number = $this->findSale->number;
        $this->selectId = $this->findSale->id;
    }

    public function updateSale(){
        $sale = ShopSale::find($this->selectId);
        $sale->customer_name = $this->customer_name;
        $sale->number = $this->number;
        $sale->payment = $this->paid;
        $sale->save();
        $this->mount();
        if ($sale) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Sale update success!!"
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Sale update failed!!"
            ]);
        }
    }

    public function mount(){
        $this->sale = ShopSale::all();
    }

    public function deleteSale(){
        $sale = ShopSale::find($this->selectId);
        $sale->product()->delete();
        $sale->delete();
        if ($sale) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Sale deleted success!!"
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Sale deleted failed!!"
            ]);
        }
        $this->mount();
    }
    
    public function render()
    {
        return view('livewire.sale.sale-list');
    }
}
