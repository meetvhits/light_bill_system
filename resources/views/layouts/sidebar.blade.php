<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="{{ asset('assets/images/icon/staff.png') }}" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <a href="{{ route('logout') }}" class="dropdown-item"><i class="fas fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user())
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">--- MAIN MENU</li>
                    <li>
                        <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false">
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-dark" href="{{ route('customer') }}" aria-expanded="false">
                            <span class="hide-menu">Customers</span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-dark" href="{{ route('unitrange') }}" aria-expanded="false">
                            <span class="hide-menu">Unit Range</span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-dark" href="{{ route('editbillcharge') }}" aria-expanded="false">
                            <span class="hide-menu">Bill Charge</span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-dark" href="{{ route('lightbill') }}" aria-expanded="false">
                            <span class="hide-menu">Light Bill</span>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
</aside>
