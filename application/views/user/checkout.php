<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="col-lg-8 col-xl-6 col-md-10">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Payment</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('user/add') ?>">
                    <div class="form-group row">
                        <label for="total" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp. </span>
                                </div>
                                <input type="number" name="total" id="total" readonly class="form-control" aria-label="Username" value="<?= $_SESSION['total']; ?>" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="money" class="col-sm-3 col-form-label">Paid</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp. </span>
                                </div>
                                <input type="number" name="money" id="money" class="form-control" value="0" aria-label="Money" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-around">
                        <a href="<?= base_url('user/index'); ?>" class="btn btn-outline-danger"><i class="fas fa-backward"></i> Back</a>
                        <button class="btn btn-outline-primary" type="submit">Pay</button>
                        <a href="<?= base_url('user/index/unset'); ?>" class="btn btn-outline-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if ($this->session->userdata('shopping')) :
        $session = $this->session->userdata('shopping'); ?>
        <div class="col-lg-10 col-xl-8 col-md-11">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Shopping List</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <?php $i = 1;
                        $total = 0;
                        foreach ($data as $item) :
                            if (isset($session[$item->item_id])) :
                                $quantity = 0;
                                $quantity = $session[$item->item_id] * $item->price;
                                $total += $quantity;
                        ?>
                                <tr>
                                    <th class="text-center"><?= $i; ?>.</th>
                                    <td><?= $item->name; ?></td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <a href="<?= base_url('user/index/') . $item->item_id . '/plus'; ?>" class="btn badge badge-success col-sm-2"><i class="fa fa-fw fa-plus"></i></a>
                                            <div class="col-sm-4 text-center"><?= $session[$item->item_id] ?></div>
                                            <a href="<?= base_url('user/index/') . $item->item_id . '/min'; ?>" class="btn badge badge-danger col-sm-2"><i class="fa fa-fw fa-minus"></i></a>
                                        </div>
                                    </td>
                                    <td>Rp. <?= $quantity ?></td>
                                    <td class="text-center"><a href="<?= base_url('user/index/') . $item->item_id . '/del'; ?>" class="btn badge badge-danger"><i class="fa fa-trash-alt"></i></a></td>
                                </tr>
                        <?php
                                $i++;
                            endif;
                        endforeach;
                        $_SESSION['total'] = $total;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
</div>