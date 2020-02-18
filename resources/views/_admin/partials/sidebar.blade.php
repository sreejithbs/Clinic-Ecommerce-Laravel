<div class="main-menu menu-fixed menu-dark menu-accordion menu-bordered menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ (\Route::current()->getName() == 'admin_dashboard') ?  'active' : '' }}" >
                <a href="{{ route('admin_dashboard') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="navigation-header">
                <span data-i18n="nav.category.ui">Inventory Management</span>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0);"><i class="la la-list"></i>
                    <span class="menu-title">Products</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="card-bootstrap.html">Add New Product</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>