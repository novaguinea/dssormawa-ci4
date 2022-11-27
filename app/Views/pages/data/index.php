<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>

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
                    foreach ($users as $u) :

                        if ($u['is_ormawa']) :
                    ?>
                            <tr>
                                <th scope="row"><?= $x; ?></th>
                                <td><?= $u['nama']; ?></td>

                                <td>
                                    <a class="btn btn-success" href="/data/<?= $u['id']; ?>">Detail</a>
                                </td>
                            </tr>
                        <?php $x++;

                        endif;
                        ?>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>