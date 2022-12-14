<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>

<?php //dd($scoring); 

?>

<style>
    /* .dropdown-verification {
        width: 300px !important;
        height: 200px !important;
    } */
    tr {
        height: 50px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="row mt-5 mb-5">
                <h2 class="col-sm-5 col-md-6"><?= $criterion['criterion_name']; ?></h2>

            </div>
            <table cellspacing="2">
                <tr>
                    <th class="col-4">Judul</th>
                    <td class="col-2">:</td>
                    <td><?= $data['title']; ?></td>
                </tr>
                <tr>
                    <th class="col-4">Deskripsi</th>
                    <td class="col-2">:</td>
                    <td><?= $data['description']; ?></td>
                </tr>
                <tr class="spaceUnder">
                    <th class="col-4">Tingkat</th>
                    <td class="col-2">:</td>
                    <td><?= $data['scope']; ?></td>
                </tr>
                <tr>
                    <th class="col-4">Status</th>
                    <td class="col-2">:</td>
                    <td>
                        <div class="dropdown dropdown-verification" style="height: 50%;">
                            <form action="/data/updateStatusData" id="updateStatus" method="post" onchange="">
                                <input name="idForDataOrmawaStatus" type="hidden" value="<?= $data['id']; ?>">
                                <select name="dataOrmawaStatus" id="" onchange="this.form.submit()">
                                    <?php foreach ($status as $s) :
                                        if ($data['id_is_verified'] == $s['id']) : ?>
                                            <option value="<?= $s['id']; ?>" selected="<?= "selected"; ?>">
                                                <?= $s['name']; ?>
                                            </option>
                                        <?php else : ?>
                                            <option value="<?= $s['id']; ?>">
                                                <?= $s['name']; ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <script>
                                    // var oldData = document.getElementsByName('dataOrmawaStatus');
                                </script>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- showing PDF -->
            <h2>ini buat pdf</h2>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>