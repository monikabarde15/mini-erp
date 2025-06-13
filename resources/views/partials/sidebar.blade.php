<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-text mx-3">Mini ERP</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
@auth
    @if(auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Products</span>
        </a>
    </li>
    @endif

    @if(in_array(auth()->user()->role, ['admin', 'salesperson']))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sales-orders.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Sales Orders</span>
        </a>
    </li>
    @endif
@endauth


    <hr class="sidebar-divider d-none d-md-block">
</ul>
