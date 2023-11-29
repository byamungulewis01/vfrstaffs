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
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#savings" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Savings</span>
            </a>
            <ul aria-expanded="false"
                class="collapse first-level {{ in_array(Route::currentRouteName(), ['saving.index', 'saving.show', 'saving.showMember']) ? 'in' : '' }}">
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['saving.index', 'saving.show']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['saving.index', 'saving.show']) ? 'active' : '' }}"
                        href="{{ route('saving.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Monthly Savings</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['saving.members', 'saving.showMember']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['saving.members', 'saving.showMember']) ? 'active' : '' }}"
                        href="{{ route('saving.members') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Members Savings</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('saving.create') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Create Savings</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#loans" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-currency-dollar"></i>
                </span>
                <span class="hide-menu">Loans</span>
            </a>
            <ul aria-expanded="false"
                class="collapse first-level {{ in_array(Route::currentRouteName(), ['loan.index', 'loan.show']) ? 'in' : '' }}">
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.index', 'loan.show']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.index', 'loan.show']) ? 'active' : '' }}"
                        href="{{ route('loan.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Monthly Active Loan</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.loan_closed']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.loan_closed']) ? 'active' : '' }}"
                        href="{{ route('loan.loan_closed') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Monthly Closed Loan</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#users" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Members</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">All Members</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.active') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Active Members</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.inactive') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Inactive Members</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#settings" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Settings</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('setting.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Pre Settings</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('setting.loginHistory') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Login History</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('setting.systemHistory') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">System History</span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</nav>
