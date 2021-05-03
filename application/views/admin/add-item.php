<!-- Begin Page Content -->
<div class="container-fluid row">
    <!-- Page Heading -->
    <div class="card ml-2 col-lg-9 col-xl-7 shadow-lg">
        <div class="card-body">
            <h2>New Item</h2>
            <hr class="mb-3 mt-n1">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('admin/add_item', 'class="user mt-4"'); ?>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Input Item Name...">
                </div>
                <?= form_error('name', '<small class="text-danger ml-4">', '</small>') ?>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-9 input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="number" id="price" name="price" class="form-control" placeholder="Input Item Price...">
                </div>
                <?= form_error('price', '<small class="text-danger ml-4">', '</small>') ?>
            </div>
            <div class="form-group row">
                <label for="Stock" class="col-sm-3 col-form-label">Stock</label>
                <div class="col-sm-9 input-group">
                    <div class="input-group-append">
                        <a class="input-group-text btn btn-danger" onclick="reduce($('#Stock').val())"><i class="fas fa-minus"></i></a>
                    </div>
                    <input type="number" value="1" id="Stock" name="stock" class="form-control" placeholder="Input Stock Item...">
                    <div class="input-group-append">
                        <a class="input-group-text btn btn-success" onclick="add($('#Stock').val())"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <?= form_error('stock', '<small class="text-danger ml-4">', '</small>') ?>
            </div>
            <div class="form-group row">
                <label for="customFile" class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" onchange="upload($('#image').val())">
                        <label class="custom-file-label" for="image">Choose file</label>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            The image is invalid!
                        </div>
                    </div>
                    <div class="badge badge-danger">File: jpeg, jpg, png. Max Size: 1 MB</div>
                </div>
                <?= form_error('image', '<small class="text-danger ml-4">', '</small>') ?>
            </div>
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-outline-primary">Save</button>
                </div>
                <div class="col"></div>
                <div class="col-3 text-right">
                    <a href="<?= base_url('admin/index'); ?>" class="btn btn-outline-danger">Cancel</a>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>

<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script>
    function add(s) {
        var stock = parseInt(s);
        $('#Stock').val(stock + 1);
    }

    function reduce(s) {
        if (parseInt(s) > 1) {
            var stock = parseInt(s);
            $('#Stock').val(stock - 1);
        }
    }

    function upload(path) {
        if (path != "") {
            var name = path.split('.');
            var l = name.length;
            name = name[l - 1].toLowerCase();
            if (name != 'jpg' && name != 'png' && name != 'jpeg') {
                $('#image').removeClass('is-valid');
                $('#image').addClass('is-invalid');
            } else {
                $('#image').removeClass('is-invalid');
                $('#image').addClass('is-valid');
            }
        }
    }
</script>