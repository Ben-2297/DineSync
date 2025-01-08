<x-admin-layouts>
    <div>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      
          <!-- Main content -->
          <div class="content">
            <div class="container-fluid">
              
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <!-- small box -->
                <livewire:admin.dashboard.order-count />

                <!-- small box -->
                <livewire:admin.dashboard.product-count />
                
                <!-- small box -->
                <livewire:admin.dashboard.customer-count />

                <!-- small box -->
                <livewire:admin.dashboard.chef-count />
              </div>
              <livewire:admin.dashboard.totalsales />
              <livewire:admin.dashboard.order-status />
            </div>
          </div>
    </div>
</x-admin-layouts>