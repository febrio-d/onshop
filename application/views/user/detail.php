<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .invoice-title h2,
        .invoice-title h3 {
            display: inline-block;
        }

        .table>tbody>tr>.no-line {
            border-top: none;
        }

        .table>thead>tr>.no-line {
            border-bottom: none;
        }

        .table>tbody>tr>.thick-line {
            border-top: 2px solid;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="container">
            <div class="row">
                <?php foreach ($record as $r) : ?>
                    <div class="col-md-12">
                        <div class="invoice-title">
                            <img class="rounded-circle img-profile mx-auto" src="<?= base_url('assets/img/') ?>logo.png" width="45" />
                            <h3 class="ml-3">Onshop</h3>
                            <h3 class="float-right">Order # <?= $r->history_id; ?></h3>
                            <h3 class="float-right mr-2">Invoice</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md text-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    <?= date("l jS \of F Y h:i:s A", $r->date); ?><br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Order Summary</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="3%">#</th>
                                            <td class="text-center"><strong>Item</strong></td>
                                            <td class="text-center"><strong>Price</strong></td>
                                            <td class="text-center"><strong>Quantity</strong></td>
                                            <td class="text-right"><strong>Totals</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($history as $content) : ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $i; ?>.</th>
                                                <td class="text-center"><?= $content->item_name; ?></td>
                                                <td class="text-center">Rp. <?= $content->price; ?></td>
                                                <td class="text-center"><?= $content->quantity; ?></td>
                                                <td class="text-right">Rp. <?= $content->price * $content->quantity; ?> </td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                        <?php foreach ($record as $r) : ?>
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Total</strong></td>
                                                <td class="thick-line text-right">Rp. <?= $r->total; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Paid</strong></td>
                                                <td class="no-line text-right">Rp. <?= $r->paid; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Change</strong></td>
                                                <td class="no-line text-right">Rp. <?= $r->paid - $r->total; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

</body>

</html>