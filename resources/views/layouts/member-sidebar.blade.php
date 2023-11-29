<nav class="sidebar-nav scroll-sidebar" data-simplebar>
    <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-home"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item {{ in_array(Route::currentRouteName(), ['member.savings']) ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('member.savings') }}" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Savings</span>
            </a>
        </li>
        <li class="sidebar-item {{ in_array(Route::currentRouteName(), ['member.loans','member.show_loan']) ? 'active' : '' }}">
            <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['member.loans','member.show_loan']) ? 'active' : '' }}" href="{{ route('member.loans') }}" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-currency-dollar"></i>
                </span>
                <span class="hide-menu">Loans</span>
            </a>
        </li>

    </ul>
</nav>
