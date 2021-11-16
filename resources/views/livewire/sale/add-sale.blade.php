@section('title', 'Add new sale')
@section('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
<div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-7">
            {{-- <form wire:submit.prevent="addSale"> --}}
              <div class="row">
                <div class="form-group col-md-6">
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                    </div>
                    <input wire:model="customer_name" name="customer_name" required type="text" class="form-control" placeholder="Customer name" value="Walk in-customer">
                    @error('customer_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    </div>
                    <input wire:model="number" type="text" class="form-control" placeholder="Number">
                  </div>
                </div>
              </div>
            {{-- </form> --}}
              <div class="card-body table-responsive">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>X</th>
                      <th>Item</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cart as $item)
                    <tr>
                      <td>
                        <a href="#" wire:click.prevent="removeCart('{{$item->rowId}}')"><i class="fas fa-trash text-danger"></i></a>
                      </td>
                      <td>{{$item->name}}</td>
                      <td>
                        <span class="btn btn-sm" wire:click="increment('{{$item->rowId}}')"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                        {{$item->qty}}
                        <span class="btn btn-sm" wire:click="decrement('{{$item->rowId}}')"><i class="fa fa-minus-circle" aria-hidden="true"></i></span>
                      </td>
                      <td>{{$item->price}} TK</td>
                      <td>{{$item->subtotal}} TK</td>
                    </tr>
                    @endforeach
                    @if(Cart::count() > 0)
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Items</th>
                      <th>{{Cart::content()->count()}}({{Cart::count()}})</th>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Price Total</th>
                      <th>{{Cart::priceTotal()}} TK</th>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Tax(+)</th>
                      <th>{{Cart::tax()}} TK</th>
                    </tr> 
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Discount(-)</th>
                      <th>{{Cart::discount()}} TK</th>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Total</th>
                      <th>{{Cart::total()}} TK</th>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <button wire:click="destroyCart" class="btn btn-sm btn-danger">Clear All</button>
                      </td>
                      <td></td>
                      <th></th>
                      <th>
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#confirmModal"><i class="fas fa-money-bill"></i> CASH PAYMENT</button>
                      </th>
                    </tr> 
                    @endif
                  </tbody>
                </table>
                @if(Cart::count() < 1)
                  <p>Cart is empty:)</p>
                @endif
              </div>
          </div>
          <div class="col-md-5">
                <div wire:ignore class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach($products as $item)
                      <tr style="cursor: pointer" wire:click="addToCart({{$item->id}})" wire:key="{{$item->id}}">
                          <td>{{$item->name}} ({{$item->stock}})</td>
                          <td class=" text-center"><img src="{{asset($item->image)}}" style="height:100px; weight:100px; padding:10px;" />
                        </td>
                        <td>${{$item->price}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">

        </div>
        <div wire:ignore.self class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="defaultModalLabel">Please Confirm!</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="date">Sale Date <span class="text-danger">*</span></label>
                      <input wire:model="sale_date" type="date" class="form-control" required />
                    </div>
                    <div class="form-group">
                      <label for="date">Payable Amount:</label>
                      {{Cart::total()}} TK
                    </div>
                    <div class="form-group">
                      <label for="received_amount">Received Amount <span class="text-danger">*</span></label>
                      <input wire:model="received_amount" type="number" class="form-control" required />
                    </div>
                    <div class="form-group">
                      @if($received_amount-Cart::total() < 0)
                      <span class="text-danger">
                        <label for="received_amount">Due Amount: </label>
                        {{Cart::total()-$received_amount}} TK
                      </span>
                      @else
                      <span class="text-success">
                        <label for="received_amount">Return Amount: </label>
                        {{$received_amount-Cart::total()}} TK
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">CANCEL</button>
                      <span wire:loading.remove>
                        <button wire:click="addSale" type="submit" class="btn btn-success waves-effect">CONFIRM</button>
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
    </section>
    <!-- /.content -->

  </div>
</div>

@section('script')

<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

@endsection