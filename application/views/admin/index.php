<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold col-md text-primary">List of Items</h6>
                <?= $this->session->flashdata('message'); ?>
                <a class="text-primary col-md text-right" href="<?= base_url('admin/add_item'); ?>"><i class="fas fa-fw fa-plus-square pr-3"></i>Add Item</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($list_item as $item) : ?>
                            <tr>
                                <td class="text-center"><img src="<?= base_url('assets/img/items/') . $item->image; ?>" class="rounded border" width="100"></td>
                                <td><?= $item->name; ?></td>
                                <td><?= $item->price; ?></td>
                                <td><?= $item->stock; ?></td>
                                <td class="text-white text-center">
                                    <a class="btn badge badge-danger" href="#" data-toggle="modal" data-target="#deletemodal" data-id="<?= $item->item_id ?>" data-itm="<?= $item->name ?>"><i class="fas fa-fw fa-trash"></i> Delete</a>
                                    <a class="btn badge badge-warning" href="#" data-toggle="modal" data-target="#editmodal" data-dt="<?= $item->name . ";" . $item->price . ";" . $item->item_id; ?>"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                    <a class="btn badge badge-success" href="#" data-toggle="modal" data-target="#addmodal" data-dt="<?= $item->name . ";" . $item->stock . ";" . $item->item_id; ?>"><i class="fas fa-fw fa-plus"></i> Stock</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- delete Modal-->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Select "Delete" below if you are ready to Delete Item</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="delete" href="<?= base_url('admin/delete_item/') ?>">Delete</a>
            </div>
        </div>
    </div>
</div>


<!-- edit modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart(base_url('admin/change_item'), 'class="user ml-2"'); ?>
                <input type="hidden" id="code" name="id" value="">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-user" name="name" id="name" value="" placeholder="Item Name">
                    </div>
                    <?= form_error('name', '<small class="text-danger ml-4">', '</small>') ?>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control form-control-user" name="price" id="price" value="" placeholder="Item Price">
                    </div>
                    <?= form_error('email', '<small class="text-danger ml-4">', '</small>') ?>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image" onchange="upload($('#image').val())">
                            <label class="custom-file-label" id="hai" for="image">Choose file</label>
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
                <button id="sub" type="submit" name="btn_send" hidden></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="clickbtnsub()" id="sendedit" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<!-- stock modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Stock Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open(base_url('admin/stock_item'), 'class="user"'); ?>
                <input type="hidden" id="codeadd" name="id" value="">
                <div class="form-group">
                    <label for="stock" class="col-form-label">Add or Reduce Item Stock By</label>
                    <div class="row text-white m-2">
                        <a class="col-sm-2 btn btn-danger" onclick="reduce($('#stock').val())"><i class="fas fa-minus"></i></a>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="item" id="stock" value="" placeholder="Item Stock">
                        </div>
                        <a class="col-sm-2 btn btn-success" onclick="add($('#stock').val())"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <button id="click" type="submit" name="btn_send" hidden></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="clickbtnclick()" id="sendstock" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<script>
    function clickbtnclick() {
        $('#click').click();
    }

    function clickbtnsub() {
        $('#sub').click();
    }

    function add(s) {
        var stock = parseInt(s);
        $('#stock').val(stock + 1);
    }

    function reduce(s) {
        var stock = parseInt(s);
        $('#stock').val(stock - 1);
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

    $(document).ready(function() {
        // delete modal
        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var itm = button.data('itm') // Extract info from data-* attributes
            var id = button.data('id') // Extract info from data-* attributes
            console.log(id);
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var item = `Delete Item ${itm}.`
            var href = "admin/delete_item/" + id
            modal.find('.modal-body p').text(item)
            modal.find('#delete').attr('href', href)
        })

        // edit modal
        $('#editmodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var data = button.data('dt').split(";")
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var item = `Change Item ${data[0]}.`
            modal.find('.modal-title').text(item)
            modal.find('#code').val(data[2])
            modal.find('#name').val(data[0])
            modal.find('#price').val(data[1])
        })
        // edit modal
        $('#addmodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var data = button.data('dt').split(";")
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var item = `Add Stock Item ${data[0]}.`
            modal.find('.modal-title').text(item)
            modal.find('#codeadd').val(data[2])
            modal.find('#stock').val(data[1])
        })
    })
</script>