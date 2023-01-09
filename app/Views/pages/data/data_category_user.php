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
            <h1 class="mt-4 mb-5">Data Organisasi Kemahasiswaan</h1>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Organisasi Kemahasiswaan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;
                    foreach ($category as $u) :
                    ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $u['category_name']; ?></td>

                            <td>
                                <a class="btn btn-success" href="/data/<?= $id_ormawa ?>/<?= $u['id']; ?>">Detail</a>
                            </td>
                        </tr>
                        <?php $x++;
                        ?>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<?= $this->endSection(); ?>