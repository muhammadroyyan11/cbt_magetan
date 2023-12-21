<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="text-center mt-0 mb-4">
            <b>L</b>ogin
        </h3>
        <?= $this->session->flashdata('pesan'); ?>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="email" placeholder="Email">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>