@section('title', 'Add new product - Admin')
@section('style')

@endsection
<div>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
        </div>


        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-dark">Add Product</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input wire:model="name" name="name" type="text" class="form-control" />
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input wire:model="image" name="image" type="file" class="form-control" />
                            @error('image') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select wire:model="category_id" name="category_id" class="form-control" id="">
                                <option value="">- Select option -</option>
                                @foreach($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Buying Price <span class="text-danger">*</span></label>
                            <input wire:model="buying_price" name="buying_price" type="number" class="form-control" />
                            @error('buying_price') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Sale Price <span class="text-danger">*</span></label>
                            <input wire:model="price" name="price" type="number" class="form-control" />
                            @error('price') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Stock <span class="text-danger">*</span></label>
                            <input wire:model="stock" name="stock" type="number" class="form-control" />
                            @error('stock') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <textarea wire:model="details" name="details" class="form-control"></textarea>
                            @error('details') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <span wire:loading.remove>
                            <button wire:click.prevent="addProduct" type="submit" class="btn mt-2 btn-success">
                                Add Product
                            </button>
                        </span>
                        <span wire:loading>
                            <button type="button" class="btn mt-2 btn-success disabled">
                                Processing ..
                            </button>
                        </span>
                    </div>
                </div>
            </div>
          </div>

    </div>



</div>
@section('script')
@endsection