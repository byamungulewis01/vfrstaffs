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
                class="collapse first-level {{ in_array(Route::currentRouteName(), ['loan.create', 'loan.index', 'loan.show', 'loan.history', 'loan.payment','loan.closed_show']) ? 'in' : '' }}">
                <li class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.create']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.create']) ? 'active' : '' }}"
                        href="{{ route('loan.create') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Loan Request</span>
                    </a>
                </li>
                <li class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.payment']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.payment']) ? 'active' : '' }}"
                        href="{{ route('loan.payment') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Loan Payment</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.index', 'loan.show']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.index', 'loan.show']) ? 'active' : '' }}"
                        href="{{ route('loan.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Active Loan</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.loan_closed','loan.closed_show']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.loan_closed','loan.closed_show']) ? 'active' : '' }}"
                        href="{{ route('loan.loan_closed') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Closed Loan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ in_array(Route::currentRouteName(), ['loan.history']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['loan.history']) ? 'active' : '' }}"
                        href="{{ route('loan.history') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Loan History</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#loans" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-currency-dollar"></i>
                </span>
                <span class="hide-menu">I&E Statements</span>
            </a>
            <ul aria-expanded="false"
                class="collapse first-level {{ in_array(Route::currentRouteName(), ['income_expences.index']) ? 'in' : '' }}">
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['income_expences.index']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['income_expences.index']) ? 'active' : '' }}"
                        href="{{ route('income_expences.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Add I&E Statements</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ in_array(Route::currentRouteName(), ['income_expences.monthly']) ? 'active' : '' }}">
                    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['income_expences.monthly']) ? 'active' : '' }}"
                        href="{{ route('income_expences.monthly') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">View Monthly I&E</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#reports" aria-expanded="false">
                <span class="d-flex">
                    <i class="ti ti-qrcode"></i>
                </span>
                <span class="hide-menu">Reports</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('vsa_account') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">VSA Account</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('journal_report') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Journal List</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('loan_report') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Loan Report</span>
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
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.all') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">All Members</span>
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
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('setting.systemHistory') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">System History</span>
                    </a>
                </li> --}}
            </ul>
        </li>


    </ul>
</nav>
