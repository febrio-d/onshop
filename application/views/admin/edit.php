<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('admin/edit'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class=" col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                <div class=" col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
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
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-outline-success px-5">Edit</button>
                    <a href="<?= base_url('admin/profile'); ?>" class="btn btn-outline-danger px-5 ml-3">Cancel</a>
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