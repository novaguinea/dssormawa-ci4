<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if ($role_id == 2) : ?>
    <?= $this->include('layout/sidebar_admin'); ?>
<?php else : ?>
    <?= $this->include('layout/sidebar_ormawa'); ?>
<?php endif; ?>

<?php 
// dd($data);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4 mb-5">Data Organisasi Kemahasiswaan</h1>

            <?php
            // dd($criterion);
            foreach ($criterion as $c) : ?>

                <h3> <?= $c['criterion_name']; ?> </h3>

                <table class="table table-hover mb-5">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        foreach ($data as $u) :
                            if ($u['criterion_id'] == $c['id']) :
                        ?>
                                <tr>
                                    <th scope="row"><?= $x; ?></th>
                                    <td><?= $u['title']; ?></td>
                                    <td><?= $u['description']; ?></td>
                                    <td><?= $u['scope']; ?></td>
                                    <?php foreach ($status as $s) {
                                        if ($s['id'] == $u['id_is_verified']) {
                                            echo '<td>' . $s['name'] . '</td>';
                                        }
                                    } ?>
                                    <td>
                                        <a class="btn btn-success" href="/data/detail/<?= $u['criterion_id']; ?>/<?= $u['id']; ?>">Detail</a>
                                    </td>
                                </tr>
                            <?php $x++;
                            endif;
                            ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>