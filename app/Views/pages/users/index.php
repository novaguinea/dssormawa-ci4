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

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-5">Daftar User</h1>
            <div class="align-end mb-3">
                <a class="mt-3 btn btn-primary" href="/users/add">Tambah Akun</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;
                    foreach ($users as $u) : ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $u['username']; ?></td>
                            <td><?= $u['nama']; ?></td>
                            <?php foreach ($user_role as $ur) : ?>
                                <?php if ($u['role_id'] == $ur['id']) : ?>
                                    <td><?= $ur['name']; ?></td>
                            <?php
                                endif;
                            endforeach;
                            ?>

                            <td>
                                <!-- <a class="btn btn-warning" href="users/edit/<?= $u['id']; ?>">Edit</a> -->
                                <a class="btn btn-danger" href="users/delete/<?= $u['id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php $x++; ?>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>