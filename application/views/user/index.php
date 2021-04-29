<!-- Begin Page Content -->
<div class="container-fluid">

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
                                    <td>Rp.<?= $quantity ?></td>
                                    <td class="text-center"><a href="<?= base_url('user/index/') . $item->item_id . '/del'; ?>" class="btn badge badge-danger"><i class="fa fa-trash-alt"></i></a></td>
                                </tr>
                        <?php
                                $i++;
                            endif;
                        endforeach;
                        $_SESSION['total'] = $total;
                        ?>
                    </table>
                    <div class="row justify-content-end">
                        <a class="btn btn-outline-primary mr-3" href="<?= base_url('user/checkout') ?>">Check Out</a>
                        <a href="<?= base_url('user/index/unset'); ?>" class="btn btn-outline-danger mr-3">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" width="3%">#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Stock</th>
                            <th>Add Product</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Stock</th>
                            <th width='15%'>Add Product</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $content) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i; ?>.</th>
                                <td><?= $content->name; ?></td>
                                <td>Rp.<?= $content->price; ?></td>
                                <td><img src="<?= base_url('assets/img/items/') . $content->image; ?>" class="img-fluid img-thumbnail" width="100" alt="<?= $content->image; ?>"></td>
                                <td><?= $content->stock; ?></td>
                                <td><a href="<?= base_url('user/index/') . $content->item_id; ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus-square"></i><?php echo "  "; ?>Add</a></td>
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