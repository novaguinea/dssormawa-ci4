<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if ($role_id == 2) : ?>
    <?= $this->include('layout/sidebar_admin'); ?>
<?php else : ?>
    <?= $this->include('layout/sidebar_ormawa'); ?>
<?php endif; ?>

<!--put your content here-->

<div class="container">
    <div class="row">
        <div class="col-8 mt-4">
            <h2>
                Add new account
            </h2>
        </div>
        <form action="/users/saveUser" method="post">

            <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
            ?>

            <div class="mt-3">
                <div class="mb-3 row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="inputUsername" pattern="[A-Za-z0-9]+" onkeydown="if(['Space'].includes(arguments[0].code)){return false;}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputNama" name="inputNama">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword">
                    </div>
                </div>
                <div class="mt-5 mb-3 row">
                    <div class="col-sm-3">
                        <button type="submit" class="form-control btn btn-success" id="submitUserData">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--content end here-->
<?= $this->endSection(); ?>