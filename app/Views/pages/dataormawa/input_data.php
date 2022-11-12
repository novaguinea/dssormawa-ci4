<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>

<!--put your content here-->

<div class="container">
    <div class="row">
        <div class="col-8">
        </div>

        <form action="/rules/saveCriterion" method="post">

            <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
            // dd($category);
            ?>

            <div class="mt-5">
                <div class="mb-4 row">
                    <h4 style="color:dimgray"><b style="color:#0E0E0E">Penilaian kategori:</b> <?= $criterion["criterion_name"]; ?></h4>
                </div>
            </div>
        </form>

        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kriteria</th>
                    <th scope="col">Bobot Kriteria %</th>
                    <th scope="col">Aksi</th>
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
                        </td>
                        <td>
                            <a class="btn btn-success" href="/rules/detail/criterion/<?= $u['id']; ?>">Isi Data</a>

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