<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Register a New Admin Account!</h1>
                        </div>
                        <form class="user" method="POST" action="<?= base_url('admin/registration'); ?>">
                            <div class="form-group">
                                <input type="name" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name') ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5 mb-2 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="password1" id="InputPassword" placeholder="Password">
                                </div>
                                <div class="col-sm-5 mb-2">
                                    <input type="password" class="form-control form-control-user" name="password2" id="RepaeatPassword" placeholder="Repeat Password">
                                </div>
                                <div class="col-sm-2 btn-group-lg">
                                    <a class="btn btn-invert btn-outline-dark" onclick="ShowPassword()"><i id="show" class="fa text-primary fa-eye"></i></a>
                                </div>
                                <?= form_error('password1', '<small class="text-danger pl-4">', '</small>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function ShowPassword() {
        let inp = $('#InputPassword').attr('type')
        if (inp == 'password') {
            $('#InputPassword').attr({
                'type': 'text'
            })
            $('#RepaeatPassword').attr({
                'type': 'text'
            })
            $('#show').addClass('fa-eye-slash')
        } else {
            $('#InputPassword').attr({
                'type': 'password'
            })
            $('#RepaeatPassword').attr({
                'type': 'password'
            })
            $('#show').removeClass('fa-eye-slash')
        }
    }
</script>