<section class="vh-100 gradient-custom" id = "login">
    <div class="container-fluid py-5 h-100" style="text-align: center;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card" style="border-radius: 1rem">
                    <div class="m-4 m-md-5 pb-1">
                        <h4>Sign Up</h4>
                        <hr>
                        <form action="/register" 
                            method="post"
                            class="form"> 
                            <div class="form-group">

                                <input type="text" 
                                class="form-control mb-2"
                                name="first_name"
                                placeholder="First Name"
                                value="<?= set_value('first_name') ?>">

                                <input type="text" 
                                class="form-control mb-2"
                                name="last_name"
                                placeholder="Last Name"
                                value="<?= set_value('last_name')?>">

                                <input type="text" 
                                class="form-control mb-2"
                                name="email"
                                placeholder="Email Address"
                                value="<?= set_value('email')?>">

                                <input type="password" 
                                class="form-control mb-2"
                                name="password"
                                placeholder="Password"
                                value="">
                                
                                <input type="password" 
                                class="form-control mb-2"
                                name="confirmPassword"
                                placeholder="Confrim Password">

                                <?php if (isset($validation)): ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <input type="submit" class="btn btn-info btn-green mt-2" value="Sign Up">
                                <button type="button" class="btn btn-info btn-green mt-2" onclick="location.href='/login'">
                                   Login to Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>