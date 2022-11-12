<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3">Daftar Kategori</h1>

            <form class="mb-5" action="/rules/addCategory" method="post">

                <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
                ?>

                <div class="mt-5">
                    <div class="mb-3 row">
                        <label for="inputCategory" class="col-sm-2 col-form-label">Nama Kategory</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCategory" name="inputCategory">
                        </div>
                    </div>

                    <div class="mt-3 mb-3 row">
                        <div class="col-sm-2">
                            <button type="submit" class="form-control btn btn-primary" id="submitUserData" onclick="clearform()">
                                Tambah Kategori
                            </button>
                        </div>
                    </div>
                </div>
            </form>

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