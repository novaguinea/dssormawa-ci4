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
                Tambah Kriteria
            </h2>
        </div>
        <form action="/rules/saveCriterion" method="post">

            <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
            ?>

            <div class="mt-3">
                <div class="mb-3 row">
                    <label for="inputCriterion" class="col-sm-2 col-form-label">Nama Kriteria</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputCriterion" name="inputCriterion">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputCriterionWeight" class="col-sm-2 col-form-label">Bobot Kriteria</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputCriterionWeight" name="inputCriterionWeight">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputCriterionDescription" class="col-sm-2 col-form-label">Deskripsi Kriteria</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="inputCriterionDescription" id="inputCriterionDescription" cols="80" rows="10"></textarea>
                    </div>
                </div>
                <input type="hidden" id="hiddenCategoryId" name="hiddenCategoryId" value="<?= $category['id']; ?>">
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