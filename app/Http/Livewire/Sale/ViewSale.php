<?php

namespace App\Http\Livewire\Sale;

use App\Models\ShopSale;
use Livewire\Component;

class ViewSale extends Component
{

    public $sale;

    public function mount($id){
        $this->sale = ShopSale::find($id);
    }

    public function render()
    {
        return view('livewire.sale.view-sale');
    }
}
