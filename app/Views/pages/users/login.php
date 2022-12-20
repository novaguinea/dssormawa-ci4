<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    html {
        background-color: hsl(0, 0%, 96%);
    }
</style>

<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        SISPEMAWA <br />
                        <span class="text-warning">UPNVJ</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Persiapkan ORMAWA-mu untuk menjadi yang terbaik di <br> Universitas Pembangunan Nasional Veteran Jakarta!
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form action="/login/validate" method="post">
                                <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
                                ?>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Username</label>
                                    <input type="text" id="inputUsernameLogin" name="inputUsernameLogin" class="form-control" />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" id="inputPwdLogin" name="inputPwdLogin" class="form-control" />
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4" id="submitLogin">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->

<?= $this->endSection(); ?>