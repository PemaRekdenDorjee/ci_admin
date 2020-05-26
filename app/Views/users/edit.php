
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $heading?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <?= $breadcrumb ?>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="<?=base_url()?>/users/update"  method="post">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="user_id" id="user_id" value="<?= $userdata['id']?>">
                                <div class="form-group col-6">
                                    <label for="username">User Name</label>
                                    <input type="text" name="username" class="form-control"  value="<?= $userdata['username']?>" id="username" placeholder="Enter username">
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">Phone No.</label>
                                    <input type="text" class="form-control" name="phone" value="<?= $userdata['phone']?>" id="phone" placeholder="Enter Phone">
                                </div>
                            </div>
                            <?php if (isset($validation)):?>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $validation->listErrors()?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

