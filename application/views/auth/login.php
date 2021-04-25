    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?= $this->session->flashdata('message'); ?>
                                    <form class="user" method="POST" action="<?= base_url('auth') ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="password" name="password" class="form-control form-control-user" id="InputPassword" placeholder="Password">
                                                <div class="input-group-append">
                                                    <a onclick="ShowPass()" class="btn btn-outline-dark">
                                                        <i id="show" class="text-primary m-2 fas fa-fw fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function ShowPass() {
            var inp = $('#InputPassword').attr('type')
            if (inp == 'password') {
                $('#show').addClass('fa-eye-slash')
                $('#InputPassword').attr({
                    'type': 'text'
                })
            } else {
                $('#show').removeClass('fa-eye-slash')
                $('#InputPassword').attr({
                    'type': 'password'
                })
            }
        }

        function showError() {
            $('#errormodal').modal('show');
        }
    </script>