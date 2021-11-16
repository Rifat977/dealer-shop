@section('title', 'Product - Admin')
@section('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
<div>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
        </div>



        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product Table</h6>
            </div>
            <div class="card-body">
                <div wire:ignore class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($products as $item)
                            <tr wire:key="{{$item->id}}">
                                <td>{{$sl++}}</td>
                                <td>{{$item->name}}</td>
                                <td><img src="{{asset($item->image)}}" style="height:110px; weight:110px; padding:10px;" /></td>
                                <td>{{$item->category->name}}</td>
                                <td>${{$item->price}}</td>
                                <td>
                                    <button class="btn btn-sm btn-success m-1" wire:click="selectProduct({{$item->id}})" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-primary m-1" wire:click="selectProduct({{$item->id}})" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger m-1" wire:click="selectProduct({{$item->id}})" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Product</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input wire:model="name" type="text" class="form-control" name="name" required>
                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Image</label><br>
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" style="height:120px; weight:120px; padding:10px;">
                                @else
                                    <img src="{{$oldImage}}" style="height:120px; weight:120px; padding:10px;">
                                @endif
                                <input type="file" wire:model="image" name="image" class="form-control mt-2" />
                                @error('image') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Details</label>
                                <textarea name="details" wire:model="details" class="form-control">{{$details}}</textarea>
                                @error('details') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-label">Category</label>
                                <select wire:model="category_id" class="form-control">
                                    <option>Select Category</option>
                                    @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group ">
                                <label class="form-label">Buying Price</label>
                                <input wire:model="buying_price" name="buying_price" type="number" class="form-control" required>
                                @error('buying_price') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group ">
                                <label class="form-label">Sale Price</label>
                                <input wire:model="price" type="number" class="form-control" name="price" required>
                                @error('price') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group ">
                                <label class="form-label">Stock</label>
                                <input wire:model="stock" type="number" class="form-control" name="stock" required>
                                @error('stock') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span wire:loading>
                        <button type="submit" class="btn btn-success disabled waves-effect">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading ..
                        </button>
                    </span>
                    <span wire:loading.remove>
                        <button wire:click.prevent="updateProduct" type="submit" class="btn btn-success waves-effect">
                            SAVE CHANGES
                        </button>
                    </span>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Please Confirm!</h4>
                </div>
                <div class="modal-body">
                    Do you want to delete?
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="deleteProduct" data-dismiss="modal" type="button" class="btn btn-danger waves-effect">DELETE</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>



</div>
@section('script')

<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

@endsection