<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ShopExpense;

class Expense extends Component
{
    public $name, $cost, $editName, $editCost, $selectId;
    public $expense;
    public $sl=1;

    public function addExpense(){
        $this->validate([
            'name' => 'required|max:255',
            'cost' => 'required',
        ]);
        $res = ShopExpense::Create([
            'name' => $this->name,
            'cost'=> $this->cost
        ]);
        $this->mount();
        $this->name = '';
        $this->cost = '';
        if($res){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Expense added Successfully!!"
            ]);
        }else{
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Expense added failed!!"
            ]);
        }
    }

    public function updateExpense(){
        $this->validate([
            'editName' => 'required|max:255',
            'editCost' => 'required|max:255',
        ]);
        $item = ShopExpense::find($this->selectId);
        $item->name = $this->editName;
        $item->cost = $this->editCost;
        $item->save();

        $this->mount();

        if($item){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Expense update Successfully!!"
            ]);
        }else{
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Expense update failed!!"
            ]);
        }
    }

    public function deleteExpense(){
        $item = ShopExpense::find($this->selectId);
        $item->delete();
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Expense delete success!!"
        ]);
        $this->mount();
    }

    public function select($id){
        $item = ShopExpense::find($id);
        $this->editName = $item->name;
        $this->editCost = $item->cost;
        $this->selectId = $item->id;
    }

    public function mount(){
        $this->expense = ShopExpense::all();
    }

    public function render()
    {
        return view('livewire.expense');
    }
}
