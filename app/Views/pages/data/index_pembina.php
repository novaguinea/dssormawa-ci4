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

<div id="app" class="container">

    <div class="row">
        <div class="col">
            <h1 class="mt-4 mb-5">Data Organisasi Kemahasiswaan</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Organisasi Binaan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $ormawa_related['nama']; ?></td>
                        <td>
                            <a class="btn btn-success" href="/data/<?= $ormawa_related['id']; ?>">Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h3 class="mt-5 mb-3">Perolehan ORMAWA Terbaik</h3>

            <table class="table table-hover mb-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Organisasi Kemahasiswaan</th>
                        <th scope="col">Total Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // dd($dataormawa);
                    $x = 1;
                    foreach ($dataormawa as $do => $do_value) : ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $do; ?></td>
                            <td><?= (float)round($do_value, 3); ?></td>
                        </tr>
                        <?php $x++;
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>