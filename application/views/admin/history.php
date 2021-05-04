<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow-lg mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" width="3%">#</th>
                            <th>User</th>
                            <th>Purchase Code</th>
                            <th>Total</th>
                            <th>Date of Purchase</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>User</th>
                            <th>Purchase Code</th>
                            <th>Total</th>
                            <th>Date of Purchase</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($history as $content) :
                            if ($content->role_id != '1') :
                        ?>
                                <tr>
                                    <th scope="row" class="text-center"><?= $i; ?>.</th>
                                    <td><?= $content->name ?></td>
                                    <td><?= $content->history_id; ?></td>
                                    <td>Rp. <?= $content->total; ?></td>
                                    <td><?= date("l jS \of F Y h:i:s A", $content->date); ?></td>
                                    <td>
                                        <a href="<?= base_url('user/detail/') . $content->history_id; ?>" target="_blank" class="btn btn-primary"><i class="fas fa-fw fa-info"></i>Detail</a>
                                        <a href="<?= base_url('admin/delete/') . $content->record_id; ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i>Delete</a>
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            endif;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->