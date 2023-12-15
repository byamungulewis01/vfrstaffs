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
                    <i class="ti ti-files"></i>
                </span>
                <span class="hide-menu">Approving</span>
            </a>
            <ul aria-expanded="false"
                class="collapse first-level {{ in_array(Route::currentRouteName(), ['saving.requests', 'saving.requestShow']) ? 'in' : '' }}">
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['saving.requests', 'saving.requestShow']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['saving.requests', 'saving.requestShow']) ? 'active' : '' }}"
                        href="{{ route('saving.requests') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Monthly Savings</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.requests', 'loan.requestShow']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.requests', 'loan.requestShow']) ? 'active' : '' }}"
                        href="{{ route('loan.requests') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Loan Approving</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.monthly_request_loans', 'loan.requestShow']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.monthly_request_loans', 'loan.requestShow']) ? 'active' : '' }}"
                        href="{{ route('loan.monthly_request_loans') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Monthly Loans</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.restructure']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.restructure']) ? 'active' : '' }}"
                        href="{{ route('loan.restructure') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Restructuring Loans</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['income_expenses']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['income_expenses']) ? 'active' : '' }}"
                        href="{{ route('income_expenses') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Income & Expenses</span>
                    </a>
                </li>
            </ul>
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

            </ul>
        </li>

    </ul>
</nav>
