@section('title', 'Sale List - Admin')
@section('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
<div>
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Sale</h1>
    </div>



    <div class="card shadow mb-4">
      <div class="card-body">
        <div wire:ignore class="table-responsive">
          <table wire:ignore class="table table-bordered table-striped table-hover dataTable js-exportable" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Payment Status</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Payment Status</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($sale as $item)
              <tr wire:key="{{$item->id}}">
                <td>{{$item->sale_date}}</td>
                <td>{{$item->customer_name}}</td>
                <td class="">
                  @if($item->payment >= $item->total)
                  <span class="badge badge-success">Paid</span>    
                  @else
                  <span class="badge badge-danger">Due</span>    
                  @endif
                </td>
                <td>{{$item->total}} TK</td>
                <td>{{$item->payment}} TK</td>
                <td>{{$item->payment-$item->total < 0 ? $item->total-$item->payment : $item->payment-$item->total}} TK</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" wire:click="findSale({{$item->id}})" href="#" data-toggle="modal" data-target="#viewModal"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" wire:click="findSale({{$item->id}})" href="#" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item"  wire:click="findSale({{$item->id}})" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <div wire:ignore.self class="modal fade" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sale Details</h5>
        </div>
        <div class="modal-body">
          <h5 class="modal-title text-center">Bhai Bhai Traders</h5>
          <div class="row mt-4">

            <div class="col-6">
              <strong>Date:</strong> {{$sale_date}} <br>
              <strong>Payment Status:</strong>
                @if($paid >= $total)
                <span class="badge badge-success">Paid</span>    
                @else
                <span class="badge badge-danger">Unpaid</span>    
                @endif <br>
                <strong>Paid By:</strong> Cash
            </div>
            <div class="col-6">
              <strong>Customer:</strong> {{$customer_name}} <br>
              <strong>Number:</strong> {{$number}}
                
            </div>

            <div class="col-12 mt-3">
              <table class="table table-bordered table-hover">
                <tr>
                  <th>Product</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Subtotal</th>
                </tr>
                @if($findSale!=null)
                @foreach ($findSale->product as $item)
                <tr>
                  <td>{{$item->name}}</td>
                  <td>{{$item->qty}}</td>
                  <td>{{$item->price}}</td>
                  <td>{{$item->subtotal}} </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="2"></td>
                  <th>Total</th>
                  <th>{{$findSale->price_total}} TK</th>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <th>Tax</th>
                  <th>{{$findSale->tax}} TK</th>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <th>Discount</th>
                  <th>{{$findSale->discount}} TK</th>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <th>Grand Total</th>
                  <th>{{$findSale->total}} Tk</th>
                </tr>
                <tr>
                  <th colspan="2"></th>
                  <th>Paid Amount</th>
                  <th>{{$findSale->payment}} TK</th>
                </tr>
                <tr>
                  <th colspan="2"></th>
                  <th>Due</th>
                  <th>{{$findSale->payment-$findSale->total < 0 ? $findSale->total-$findSale->payment : $findSale->payment-$findSale->total}} TK</th>
                </tr>
                @endif
              </table>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <span wire:loading>
            <button type="submit" class="btn btn-sm btn-success disabled">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div> Lodaing..
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
          <h4 class="modal-title" id="defaultModalLabel">Edit Sale</h4>
        </div>
        <div class="modal-body">
          <div class="form-group form-float">
            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
            <input wire:model="customer_name" type="text" class="form-control" name="name" required>
            @error('editName') <span class="text-danger">{{$message}}</span> @enderror
          </div>
          <div class="form-group form-float">
            <label class="form-label">Number <span class="text-danger">*</span></label>
            <input wire:model="number" type="text" class="form-control" name="name" required>
            @error('editName') <span class="text-danger">{{$message}}</span> @enderror
          </div>
          <div class="form-group form-float">
            <label class="form-label">Date <span class="text-danger">*</span></label>
            <input wire:model="sale_date" type="date" class="form-control" name="name" required>
            @error('editName') <span class="text-danger">{{$message}}</span> @enderror
          </div>
          <div class="form-group form-float">
            Payable Amount: {{$total}}
          </div>
          <div class="form-group form-float">
            <label class="form-label">Paid Amount <span class="text-danger">*</span></label>
            <input wire:model="paid" type="number" class="form-control" name="name" required>
            @error('editName') <span class="text-danger">{{$message}}</span> @enderror
          </div>
          <div class="form-group form-float">
            @if($paid-$total < 0)
                      <span class="text-danger">
                        Due Amount:
                        {{$total-$paid}} TK
                      </span>
                      @else
                      <span class="text-success">
                        <label for="received_amount">Change: </label>
                        {{$paid-$total}} TK
                      </span>
                      @endif
          </div>
        </div>
        <div class="modal-footer">
          <span wire:loading>
            <button type="submit" class="btn btn-success disabled waves-effect">
              processing ..
            </button>
          </span>
          <span wire:loading.remove>
            <button wire:click.prevent="updateSale" type="submit" class="btn btn-success waves-effect">
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
          <button wire:click="deleteSale" data-dismiss="modal" type="button" class="btn btn-danger waves-effect">DELETE</button>
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