<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if ($role_id == 2) : ?>
    <?= $this->include('layout/sidebar_admin'); ?>
<?php else : ?>
    <?= $this->include('layout/sidebar_ormawa'); ?>
<?php endif; ?>

<!--put your content here-->

<div class="container">
    <div class="row">
        <div class="col-8 mt-5">
            <h2>
                Detail Kriteria (Indikator Penilaian)
            </h2>
        </div>

        <form action="/rules/saveCriterion" method="post">

            <?php csrf_field();  //only can be input here, prohibited input data outside of this form 
            // dd($criterion);
            ?>

            <div class="mt-3">
                <div class="mb-3 row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Nama Kriteria</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputUsername" name="inputUsername" value="<?= $criterion['criterion_name']; ?>" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Deskripsi Kriteria</label>
                    <div class="col-sm-8">
                        <p><?= $criterion['description']; ?></p>
                    </div>
                </div>

            </div>
        </form>

        <div class="align-end mb-3 mt-4">
            <a class="btn btn-primary" href="/rules/addScoringIndicator/<?= $criterion['id']; ?>">Tambah Indikator Penilaian</a>
        </div>


        <?php
        if (!empty($scoring)) :
        ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kriteria</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;
                    // dd($criterion['id']);
                    foreach ($scoring as $u) :  ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $u['description']; ?></td>
                            <td><?= $u['score']; ?></td>
                            <td>
                                <a class="btn btn-danger" href="/rules/deleteScoringIndicator/<?= $u['id']; ?>/<?= $criterion['id']; ?>">Delete</a>

                            </td>
                        </tr>
                        <?php $x++; ?>

                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php
        else :
            echo ('<div class="mt-3"><h3>Data indikator penilaian masih kosong</h3></div>');

        endif;

        ?>

    </div>
</div>

<!--content end here-->
<?= $this->endSection(); ?>