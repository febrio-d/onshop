<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 shadow" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold text-dark"><?= $user['name'] ?></h4>
                    <p class="card-text mt-n2"><?= $user['email'] ?></p>
                    <p class="card-text" style="position: absolute; bottom: 0px;"><small class="text-muted">Date created <?= date('d F Y', $user['date_created']);  ?></small></p>
                    <div class="text-right" style="position: absolute; right: 20px;bottom: 20px;">
                        <a href="<?= base_url('admin/edit') ?>" class="btn-sm btn-outline"><i class="fas fa-fw fa-edit"></i> Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->