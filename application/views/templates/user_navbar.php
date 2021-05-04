<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="<?= base_url('user') ?>">
        <img class="rounded-circle img-profile float-left mx-auto" src="<?= base_url('assets/img/') ?>logo.png" width="50" />
        <div class="sidebar-brand-text mx-auto">Onshop</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <div class="sidebar-heading">
        Items
    </div>

    <!-- Nav Item -->
    <li class="nav-item mt">
        <a class="nav-link" href="<?= base_url('user') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>

    <li class="nav-item mt-n3">
        <a class="nav-link" href="<?= base_url('user/history'); ?>">
            <i class="fas fa-fw fa-history"></i>
            <span>History</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <div class="sidebar-heading">
        Others
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/about'); ?>">
            <i class="fas fa-fw fa-info"></i>
            <span>About Me</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <?php if ($this->session->userdata('role_id') <= 2) { ?>
        <li class="nav-item mt-n3">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-arrow-alt-circle-right"></i>
                <span>Back to the Admin Pages</span>
            </a>
        </li>
    <?php } ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->