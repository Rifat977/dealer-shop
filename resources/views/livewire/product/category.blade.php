@section('title', 'Category - Admin')
@section('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
<div>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            
            <button data-toggle="modal" data-target="#addModal" class="d-sm-inline-block btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle"></i>
                Add Category
            </button>
        </div>


        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Category Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($categorys as $item)
                    <tr>
                      <td>{{$sl++}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->slug}}</td>
                      <td>
                        <button class="btn btn-sm btn-primary" wire:click="editCategory({{$item->id}})" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit    "></i></button>
                        <button class="btn btn-sm btn-danger" wire:click="editCategory({{$item->id}})" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    </div>

    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group form-float">
                            <label class="form-label">Name</label>
                            <input wire:model="name" type="text" class="form-control" name="name" required>
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <span wire:loading>
                        <button type="submit" class="btn btn-success disabled">
                            processing ..
                        </button>
                    </span>
                    <span wire:loading.remove>
                        <button wire:click.prevent="addCategory" type="submit" class="btn btn-success">
                            ADD
                        </button>
                    </span>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group form-float">
                            <label class="form-label">Name</label>
                            <input wire:model="editName" type="text" class="form-control" name="name" required>
                        @error('editName') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <span wire:loading>
                        <button type="submit" class="btn btn-success disabled waves-effect">
                            processing ..
                        </button>
                    </span>
                    <span wire:loading.remove>
                        <button wire:click.prevent="updateCategory" type="submit" class="btn btn-success waves-effect">
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
                    <button wire:click="deleteCategory" data-dismiss="modal" type="button" class="btn btn-danger waves-effect">DELETE</button>
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