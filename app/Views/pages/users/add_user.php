<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php

switch ($role_id) {
    case 1:
        echo $this->include('layout/sidebar_ormawa');
        break;
    case 2:
        echo $this->include('layout/sidebar_admin');
        break;
    case 3:
        echo $this->include('layout/sidebar_juri');
        break;
    default:
        echo $this->include('layout/sidebar_pembina');
}

?>

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
                        <input type="text" class="form-control" id="inputUsername" name="inputUsername"">
                    </div>
                </div>
                <div class=" mb-3 row">
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
                    <div class="mb-3 row"">
                    <label for=" userRoleId" class="col-sm-2 col-form-label">Akses akun</label>
                        <div class="dropdown dropdown-verification col-sm-10" style="height: 50%;">
                            <select class="btn btn-primary" name="userRoleId" id="">
                                <option value="0" selected="selected">-- Pilih Akses --</option>
                                <?php foreach ($user_role as $s) : ?>
                                    <option value="<?= $s['id']; ?>">
                                        <?= $s['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row"">
                    <label for=" ormawaRelatedId" class="col-sm-2 col-form-label">ORMAWA Binaan</label>
                        <div class="dropdown dropdown-verification col-sm-10" style="height: 50%;">
                            <select class="btn btn-success" name="ormawaRelatedId" id="">
                                <option value="" selected="selected">-- Pilih ORMAWA --</option>
                                <?php foreach ($ormawa_data as $s) : ?>
                                    <option value="<?= $s['id']; ?>">
                                        <?= $s['nama']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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