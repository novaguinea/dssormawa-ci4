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
                    <td><?= $scoring[0]['description']; ?></td>
                </tr>
                <tr>
                    <th class="col-4">Status</th>
                    <td class="col-2">:</td>
                    <td>
                        <div class="dropdown dropdown-verification" style="height: 50%;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- showing PDF -->

        </div>
    </div>
</div>

<?= $this->endSection(); ?>