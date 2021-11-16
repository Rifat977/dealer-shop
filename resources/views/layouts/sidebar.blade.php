<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
  <a class="nav-link" href="{{ route('dashboard') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link {{Request::is('product/*') ? '' : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Product</span>
  </a>
  <div id="collapseTwo" class="collapse {{Request::is('product/*') ? 'collapse show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Components:</h6>
      <a class="collapse-item {{Request::is('product/category') ? 'active' : ''}}" href="{{ route('category') }}">Category</a>
      <a class="collapse-item {{Request::is('product/add') ? 'active' : ''}}" href="{{ route('add-product') }}">Add Product</a>
      <a class="collapse-item {{Request::is('product/products') ? 'active' : ''}}" href="{{ route('product') }}">Product</a>
    </div>
  </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link {{Request::is('sale/*') ? '' : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Sale</span>
  </a>
  <div id="collapseThree" class="collapse {{Request::is('sale/*') ? 'collapse show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Components:</h6>
      <a class="collapse-item {{Request::is('sale/add') ? 'active' : ''}}" href="{{ route('addsale') }}">Add Sale</a>
      <a class="collapse-item {{Request::is('sale/list') ? 'active' : ''}}" href="{{ route('salelist') }}">Sale List</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->