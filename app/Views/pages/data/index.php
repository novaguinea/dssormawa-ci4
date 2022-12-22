<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>
<div id="app" class="container">
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
                    ?>
                            <tr>
                                <th scope="row"><?= $x; ?></th>
                                <td><?= $u['nama']; ?></td>
                                <td>
                                    <a class="btn btn-success" href="/data/<?= $u['id']; ?>">Detail</a>
                                </td>
                            </tr>
                        <?php $x++;
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <hr class="mt-5">

            <h3 class="mt-5 mb-3">Perolehan ORMAWA Terbaik</h3>

            <table class="table table-hover mb-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Organisasi Kemahasiswaan</th>
                        <th scope="col">Skor</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    $x = 1;
                    foreach ($dataormawa as $do => $do_value) : ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $do; ?></td>
                            <td><?=(int)$do_value; ?></td>
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