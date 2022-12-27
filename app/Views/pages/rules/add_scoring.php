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
        <div class="col-8 mt-4">
            <h2>
                Tambah Indikator Penilaian
            </h2>
        </div>
        <form action="/rules/saveScoringIndicator" method="post">

            <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
            ?>

            <div class="mt-3">
                <div class="mb-3 row">
                    <label for="inputIndicatorDesc" class="col-sm-2 col-form-label">Deskripsi Indikator Penilaian</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputIndicatorDesc" name="inputIndicatorDesc" placeholder="Cth: Tingkat Nasional">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputIndicatorScore" class="col-sm-2 col-form-label">Nilai Indikator</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputIndicatorScore" name="inputIndicatorScore">
                    </div>
                </div>
                <input type="hidden" id="hiddenCategoryId" name="hiddenCriterionId" value="<?= $criterionId; ?>">
                <div class="mt-5 mb-3 row">
                    <div class="col-sm-3">
                        <button type="submit" class="form-control btn btn-success" id="submitNewCriterion">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--content end here-->
<?= $this->endSection(); ?>