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
        <div class="col-8">
            <h2 class="mt-4 mb-3">
                Detail Kategori
            </h2>
        </div>

        <form action="/rules/saveCriterion" method="post">

            <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
            ?>

            <div class="mt-3">
                <div class="mb-2 row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Nama Kategori</label>

                    <div class="col-sm-8">
                        <input type="" class="form-control" id="inputUsername" name="inputUsername" value="<?= $category["category_name"]; ?>" readonly>
                    </div>

                </div>
            </div>

        </form>

        <div class="align-end mt-5 mb-3">
            <a class="btn btn-primary" href="/rules/addCriterion/<?= $category['id']; ?>">Tambah Kriteria</a>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kriteria</th>
                    <th scope="col">Bobot Kriteria %</th>
                    <th scope="col">Aktif?</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $x = 1;
                // dd($criterion);
                foreach ($criterion as $u) : ?>
                    <tr>
                        <th scope="row"><?= $x; ?></th>
                        <td><?= $u['criterion_name']; ?></td>
                        <td><?= $u['criterion_weight']; ?></td>
                        <td> <?php $u['is_active'] ==  1 ? print("Ya") : print("Tidak") ?>
                        </td>
                        <td>
                            <a class="btn btn-success" href="/rules/detail/criterion/<?= $u['id']; ?>">Detail</a>
                            <a class="btn btn-danger" href="/rules/deleteCriterion/<?= $u['id']; ?>">Delete</a>

                        </td>
                    </tr>
                    <?php $x++; ?>

                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<!--content end here-->
<?= $this->endSection(); ?>