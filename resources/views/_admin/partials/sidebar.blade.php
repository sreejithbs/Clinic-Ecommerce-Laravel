<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ \StringHelper::setActive('admin_dashboard') }}" >
                <a href="{{ route('admin_dashboard') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ \StringHelper::setActive('admin_profile_edit') }}" >
                <a href="{{ route('admin_profile_edit') }}">
                    <i class="la la-user"></i>
                    <span class="menu-title">My Profile</span>
                </a>
            </li>

            <li class="nav-item {{ \StringHelper::setActive('admin_user_*', 'open') }}">
                <a href="javascript:void(0);"><i class="la la-users"></i>
                    <span class="menu-title">Admins Management</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ \StringHelper::setActive('admin_user_list') }}">
                        <a class="menu-item" href="{{ route('admin_user_list') }}">List all Admins</a>
                    </li>
                </ul>
            </li>

            {{-- @can('isSuper', auth()->user()) --}}
            @can('isSuper')
                <li class="nav-item {{ \StringHelper::setActive('admin_product_*', 'open') }}">
                    <a href="javascript:void(0);"><i class="la la-list"></i>
                        <span class="menu-title">Products Management</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ \StringHelper::setActive('admin_product_list') }}">
                            <a class="menu-item" href="{{ route('admin_product_list') }}">List all Products</a>
                        </li>
                    </ul>
                </li>
            @endcan

            <li class="nav-item {{ \StringHelper::setActive('admin_clinic_*', 'open') }}">
                <a href="javascript:void(0);"><i class="la la-institution"></i>
                    <span class="menu-title">Clinics Management</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ \StringHelper::setActive('admin_clinic_list') }}">
                        <a class="menu-item" href="{{ route('admin_clinic_list') }}">List all Clinics</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ \StringHelper::setActive('admin_inventory_purchase_*', 'open') }}">
                <a href="javascript:void(0);"><i class="ft-refresh-ccw"></i>
                    <span class="menu-title">Inventory Management</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ \StringHelper::setActive('admin_inventory_purchase_list') }}">
                        <a class="menu-item" href="{{ route('admin_inventory_purchase_list') }}">List all Inventory Purchases</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>