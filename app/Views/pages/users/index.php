<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3">Daftar User</h1>
            <div class="align-end mb-3">
                <a class="btn btn-primary" href="/users/add">Add Account</a>
            </div>
            <table class="table table-dark table-hover">
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
                            <?php if ($u['role_id'] == 1 ? $isOrmawa = "ORMAWA" : $isOrmawa = "Admin"); ?>
                            <td><?= $isOrmawa; ?></td>
                            <td>
                                <a class="btn btn-warning" href="users/edit/<?= $u['id']; ?>">Edit</a>
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