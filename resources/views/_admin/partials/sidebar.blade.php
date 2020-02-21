<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ \StringHelper::setActive('admin_dashboard') }}" >
                <a href="{{ route('admin_dashboard') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <!-- <li class="navigation-header">
                <span>Inventory Management</span>
            </li> -->
            <li class="nav-item {{ \StringHelper::setActive('admin_product_*', 'open') }}">
                <a href="javascript:void(0);"><i class="la la-list"></i>
                    <span class="menu-title">Inventory Management</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ \StringHelper::setActive('admin_product_create') }}">
                        <a class="menu-item" href="{{ route('admin_product_create') }}">Add new Product</a>
                    </li>

                    <li class="{{ \StringHelper::setActive('admin_product_list') }}">
                        <a class="menu-item" href="{{ route('admin_product_list') }}">List all Products</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>