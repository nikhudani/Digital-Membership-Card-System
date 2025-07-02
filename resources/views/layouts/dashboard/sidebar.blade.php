<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li class="">
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @can('roleHas', ['customer'])
                        
                    <li class="">
                        <a href="{{route('virtual-card')}}" class="waves-effect">
                            <i class="ti-id-badge"></i>
                            <span>My Digital ElynaPass</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ route('purchase-history') }}" class="waves-effect">
                            <i class="ti-reload"></i>
                            <span>Purchase History</span>
                        </a>
                    </li>

                @endcan

                @can('roleHas', ['vendor'])
                        
                    <li class="">
                        <a href="{{route('purchase-history')}}" class="waves-effect">
                            <i class="ti-reload"></i>
                            <span>Purchase History</span>
                        </a>
                    </li>

                @endcan

                @can('roleHas', ['admin', 'user'])

                    <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ti-id-badge"></i>
                            <span>Customers</span>
                        </a>
                        <ul class="sub-menu mm-collapse" style="height: 0px;">
                            <li>
                                <a href="{{route('customer')}}">List</a>
                            </li>
                            <li>
                                <a href="{{route('virtual-card')}}">EP Digital Card</a>
                            </li>
                            <li>
                                <a href="{{route('purchase-history')}}">Purchase History</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ti-receipt"></i>
                            <span>Vendors</span>
                        </a>
                        <ul class="sub-menu mm-collapse" style="height: 0px;">
                            <li>
                                <a href="{{route('vendor-list')}}">List</a>
                            </li>
                            <li>
                                <a href="{{route('vendor-details')}}">Details</a>
                            </li>
                            <li>
                                <a href="{{route('vendor-settings')}}">Settings</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-title">Membership Management</li>
                    <li class="">
                        <a href="{{route('plans')}}" class="waves-effect">
                            <i class="ti-medall"></i>
                            <span>Plan</span>
                        </a>
                    </li>
                    {{-- <li class="">
                        <a href="{{route('qr-code')}}" class="waves-effect">
                            <i class="ti-layout-grid2"></i>
                            <span>QR Code</span>
                        </a>
                    </li> --}}
                    
                @endcan

                @can('roleHas', 'admin')
                        
                    <li class="menu-title">Users Management</li>
                    <li class="">
                        <a href="{{ route('users') }}" class="waves-effect">
                            <i class="ti-user"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="menu-title">Settings</li>
                    <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                            <i class="ti-settings"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false" style="height: 0px;">
                            <li>
                                <a href="{{route('account')}}">Account</a>
                            </li>
                            <li>
                                <a href="{{route('system')}}">System</a>
                            </li>
                        </ul>
                    </li>

                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

</div>