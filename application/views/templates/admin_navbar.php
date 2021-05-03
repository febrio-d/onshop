<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="<?= base_url('admin') ?>">
        <img class="rounded-circle img-profile float-left mx-auto" src="<?= base_url('assets/img/') ?>logo.png" width="50" />
        <div class="sidebar-brand-text mx-3">Onshop Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading mt-n3">
        <i class="fas fa-fw fa-box-open"></i>
        Items
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>



    <li class="nav-item mt-n3">
        <a class="nav-link" href="<?= base_url('admin/add_item'); ?>">
            <i class="fas fa-fw fa-plus-circle"></i>
            <span>Add Item</span>
        </a>
    </li>


    <hr class="sidebar-divider">

    <div class="sidebar-heading mt-n3 mb-3">
        <i class="fas fa-fw fa-users-cog"></i>
        Users
    </div>

    <?php if ($this->session->userdata('role_id') == 1) : ?>
        <li class="nav-item mt-n3">
            <a class="nav-link" href="<?= base_url('admin/list-user') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>List of Users</span></a>
        </li>

        <li class="nav-item mt-n3">
            <a class="nav-link" href="<?= base_url('admin/registration') ?>">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Registration</span></a>
        </li>
    <?php endif; ?>

    <li class="nav-item mt-n3">
        <a class="nav-link" href="<?= base_url('admin/history'); ?>">
            <i class="fas fa-fw fa-history"></i>
            <span>History</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->