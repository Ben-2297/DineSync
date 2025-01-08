<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Setting</h3>
                        </div>
                        <form wire:submit.prevent="updateSetting">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="site_name">Site Name</label>
                                    <input wire:model.defer="state.site_name" type="text" class="form-control" id="site_name" placeholder="Enter site name">
                                </div>
                                <div class="form-group">
                                    <label for="site_title">Site Title</label>
                                    <input wire:model.defer="state.site_title" type="text" class="form-control" id="site_title" placeholder="Enter site title">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.sidebar_collapse" type="checkbox" class="custom-control-input" id="sidebarCollapse">
                                        <label class="custom-control-label" for="sidebarCollapse">Sidebar Collapse</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">General Contacts</h3>
                        </div>
                        <form wire:submit.prevent="updateSetting">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="site_email">Site Contact Email</label>
                                    <input wire:model.defer="state.site_email" type="text" class="form-control" id="site_email" placeholder="Enter site contact email">
                                </div>
                                <div class="form-group">
                                    <label for="site_address">Site Contact Address</label>
                                    <input wire:model.defer="state.site_address" type="text" class="form-control" id="site_address" placeholder="Enter site contact address">
                                </div>
                                <div class="form-group">
                                    <label for="site_mobile">Site Contact Number</label>
                                    <input wire:model.defer="state.site_mobile" type="number" class="form-control" id="site_mobile" placeholder="Enter site contact number">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>