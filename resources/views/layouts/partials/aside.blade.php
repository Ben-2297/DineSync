<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="{{ asset('logo/Logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size: 19px">{{ setting('site_name') }}</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ auth()->user()->avatar_url }}" id="profileImage" class="img-circle elevation-2" style="width:37px; height: 37px; alt="User Image">
        </div>
        <div class="info">
          @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.profile.edit') }}" class="d-block" x-ref="username">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</a>
          @else
            <a href="{{ route('chef.profile.edit') }}" class="d-block" x-ref="username">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</a>
          @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      @if ( auth()->user()->role === 'admin' )
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.products') }}" class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/create') ? 'active' : '' }}">
                <i class="nav-icon fas fa-pepper-hot"></i>
                <p>
                  Product
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Account Management
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Settings
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a x-ref="profileLink" href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Profile
                </p>
              </a>
            </li>
          </ul>
        </nav>
      @else
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('chef.dashboard') }}" class="nav-link {{ request()->is('chef/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('chef.settings') }}" class="nav-link {{ request()->is('chef/settings') ? 'active' : '' }}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a x-ref="profileLink" href="{{ route('chef.profile.edit') }}" class="nav-link {{ request()->is('chef/profile') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        </ul>
      </nav>
      @endif
    </div>
</aside>