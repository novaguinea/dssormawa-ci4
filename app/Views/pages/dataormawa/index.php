<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if ($role_id == 2) : ?>
    <?= $this->include('layout/sidebar_admin'); ?>
<?php else : ?>
    <?= $this->include('layout/sidebar_ormawa'); ?>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-5 mb-3">Kategori Penilaian</h1>
            <p class="mb-4">Tiap kategori memiliki kriteria penilaian tersendiri yang perlu diisi sebagai syarat penilaian ORMAWA terbaik!🥳</p>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori Penilaian</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;
                    foreach ($category as $u) : ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $u['category_name']; ?></td>

                            <td>
                                <a class="btn btn-success" href="/ormawa/category/<?= $u['id']; ?>">Detail</a>
                            </td>
                        </tr>
                        <?php $x++; ?>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function clearform() {
        document.getElementById("firstname").value = ""; //don't forget to set the textbox id
        document.getElementById("lastname").value = "";
    }
</script>

<?= $this->endSection(); ?>