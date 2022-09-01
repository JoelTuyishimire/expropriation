<ul class="menu-nav">
    <li class="menu-item nav-dashboard" aria-haspopup="true">
        <a href="/" class="menu-link">
            <i class="menu-icon flaticon-dashboard"></i>
            <span class="menu-text">Dashboard</span>
        </a>
    </li>
    @canany(['Manage Expropriations','View Expropriations'])
        <li class="menu-item nav-transactions" aria-haspopup="true">
            <a href="{{ route('admin.expropriations.index') }}" class="menu-link">
                <i class="menu-icon flaticon-cart"></i>
                <span class="menu-text">Expropriations</span>
            </a>
        </li>
    @endcanany
    @can("Manage Citizens")
        <li class="menu-item nav-transactions" aria-haspopup="true">
            <a href="{{ route('admin.citizens.index') }}" class="menu-link">
                <i class="menu-icon flaticon-cart"></i>
                <span class="menu-text">Citizens</span>
            </a>
        </li>
    @endcan
    @canany(["Manage Claims",'Make Claims'])
        <li class="menu-item nav-transactions" aria-haspopup="true">
            <a href="{{ route('admin.claims.index') }}" class="menu-link">
                <i class="menu-icon flaticon-cart"></i>
                <span class="menu-text">Claims</span>
            </a>
        </li>
    @endcanany
    @can('Manage Property Types')
        <li class="menu-item nav-transactions" aria-haspopup="true">
            <a href="{{ route('admin.property-types.index') }}" class="menu-link">
                <i class="menu-icon flaticon-cart"></i>
                <span class="menu-text">Property Types</span>
            </a>
        </li>
    @endcan
    @can('Manage Property Items')

        <li class="menu-item nav-transactions" aria-haspopup="true">
            <a href="{{ route('admin.property-items.index') }}" class="menu-link">
                <i class="menu-icon flaticon-cart"></i>
                <span class="menu-text">Property Items</span>
            </a>
        </li>

    @endcan

    @can('View Reports')
        <li class="menu-item menu-item-submenu nav-all-reports" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon flaticon-statistics"></i>
                <span class="menu-text">Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">reports</span>
                            </span>
                    </li>
                    <li class="menu-item nav-transactions-report" aria-haspopup="true">
                        <a href="{{ route('admin.expropriations.report') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Expropriations</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endcan
    @can('Manage System Users')
        <li class="menu-section">
            <h4 class="menu-text">System Users Section</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>
        <li class="menu-item menu-item-submenu nav-user-managements" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon flaticon-users"></i>
                <span class="menu-text">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">User Management</span>
                            </span>
                    </li>
                    <li class="menu-item nav-all-users" aria-haspopup="true">
                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Users</span>
                        </a>
                    </li>
                    <li class="menu-item nav-all-permissions" aria-haspopup="true">
                        <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Permissions</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endcan

</ul>

