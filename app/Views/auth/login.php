<section class="vh-100 gradient-custom">
    <div class="container-fluid py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card" style="border-radius: 1rem">
                    <div class="m-3 m-md-4">
                        <h4>Sign In</h4>
                        <hr>
                        <?php if (session()->get('success')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->get('success') ?>
                            </div>
                        <?php endif; ?>
                        <form action="/" method="post" class="form">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">

                                <input type="password" class="form-control mb-2" name="password" placeholder="Password" value="">

                                <?php if (isset($validation)) : ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <input type="submit" class="btn btn-info mt-2" value="Sign in">

                                <div class="col-12 col-sm-8 text-right">
                                    <br>
                                    <a href="/register">Create a new account.</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>