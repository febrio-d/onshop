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
                            <th>Purchase Code</th>
                            <th>User ID</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Change</th>
                            <th>Date of Purchase</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Purchase Code</th>
                            <th>User ID</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Change</th>
                            <th>Date of Purchase</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($history as $content) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i; ?>.</th>
                                <td><?= $content->history_id; ?></td>
                                <td><?= $content->user_id; ?></td>
                                <td>Rp. <?= $content->total; ?></td>
                                <td>Rp. <?= $content->paid; ?></td>
                                <td class="btn-info">Rp. <?= $content->paid - $content->total; ?></td>
                                <td><?= date("l jS \of F Y h:i:s A", $content->date); ?></td>
                                <td><a href="<?= base_url('user/detail/') . $content->history_id; ?>" class="btn btn-primary"><i class="fas fa-fw fa-info"></i>Detail</a></td>
                            </tr>
                        <?php
                            $i++;
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