<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Kebun Raya</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Route::is('dashboard.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Route::is('product.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.index') }}"><i class="fas fa-fire"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="{{ Route::is('category.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('category.index') }}"><i class="fas fa-fire"></i>
                    <span>Categories </span>
                </a>
            </li>
        
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Laporan Keuanagan</li>
            <li class="">
                <a class="nav-link" href="{{ route('report.index') }}"><i class="fas fa-fire"></i>
                    <span>Laporan Bulanan</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Pesanan </li>
            <li class="{{ Route::is('order.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('order.index') }}"><i class="fas fa-fire"></i>
                    <span>List Pesanan</span>
                </a>
            </li>
            <li class="">
                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-fire"></i>
                    <span>Tambahkan Pesanan</span>
                </a>
            </li>
        </ul>

    </aside>
</div>
