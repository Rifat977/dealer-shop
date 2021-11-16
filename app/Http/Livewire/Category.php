<?php

namespace App\Http\Livewire;

use App\Models\ShopCategory;
use Livewire\Component;

class Category extends Component
{    
    public $name;
    public $editName, $editId;
    public $categorys;
    public $sl=1;


    public function addCategory(){
        $this->validate([
            'name' => 'required|max:255|unique:shop_categories',
        ]);
        $slug = strtolower(str_replace(" ", "-",$this->name));
        $res = ShopCategory::Create([
            'name' => $this->name,
            'slug'=> $slug
        ]);
        $this->mount();
        $this->name = '';
        if($res){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Category added Successfully!!"
            ]);
        }else{
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Category added failed!!"
            ]);
        }
    }

    public function editCategory($id){
        $item = ShopCategory::find($id);
        $this->editName = $item->name;
        $this->editId = $item->id;
    }

    public function updateCategory(){
        $this->validate([
            'editName' => 'required|max:255',
        ]);
        $slug = strtolower(str_replace(" ", "-",$this->editName));
        $item = ShopCategory::find($this->editId);
        $item->name = $this->editName;
        $item->slug = $slug;
        $item->save();

        $this->mount();

        if($item){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Category update Successfully!!"
            ]);
        }else{
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Category update failed!!"
            ]);
        }
    }

    public function deleteCategory(){
        $item = ShopCategory::find($this->editId);
        $item->delete();
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Category delete success!!"
        ]);
        $this->mount();
    }

    public function mount(){
        $this->categorys = ShopCategory::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.product.category');
    }
}
