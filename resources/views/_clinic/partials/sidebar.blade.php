<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ \StringHelper::setActive(['clinic_dashboard']) }}" >
                <a href="{{ route('clinic_dashboard') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Home Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item {{ \StringHelper::setActive(['clinic_profile_edit']) }}" >
                <a href="{{ route('clinic_profile_edit') }}">
                    <i class="la la-user"></i>
                    <span class="menu-title">My Profile</span>
                </a>
            </li>

            <li class="nav-item {{ \StringHelper::setActive(['clinic_inventory_*'], 'open') }}">
                <a href="javascript:void(0);"><i class="la la-list"></i>
                    <span class="menu-title">Inventory Summary</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ \StringHelper::setActive(['clinic_inventory_*']) }}">
                        <a class="menu-item" href="{{ route('clinic_inventory_list') }}">List all Inventory Summary</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>