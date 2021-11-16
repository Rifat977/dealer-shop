<?php

namespace App\Http\Livewire;

use App\Models\SaleProduct;
use App\Models\ShopSale;
use Livewire\Component;


class Dashboard extends Component
{

    public function render()
    {
        $total_sale = ShopSale::sum('total');
        $total_paid = ShopSale::sum('payment');
        $total_due = $total_sale-$total_paid;
        $total_profit = SaleProduct::sum('profit');
        return view('livewire.dashboard', compact('total_sale', 'total_due', 'total_profit'));
    }
}
