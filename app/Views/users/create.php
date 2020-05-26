
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
                    <form role="form" action="<?=base_url()?>/users/create" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="username">User Name</label>
                                    <input type="text" name="username" class="form-control"  value="<?= set_value('username')?>" id="username" placeholder="Enter username">
                                </div>
                                <div class="form-group col-4">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" value="<?= set_value('email')?>" id="email" placeholder="Enter email">
                                </div>
                                <div class="form-group col-4">
                                    <label for="phone">Phone No.</label>
                                    <input type="text" class="form-control" name="phone" value="<?= set_value('phone')?>" id="phone" placeholder="Enter Phone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="password">Password</label>
                                    <input type="password"   autocomplete="password" class="form-control" name="password" id="password" placeholder=" Enter Password">
                                </div>
                                <div class="form-group col-4">
                                    <label for="comfirm_password">Confirm Password</label>
                                    <input type="password" autocomplete="comfirm_password"  class="form-control" name="comfirm_password" id="comfirm_password" placeholder=" Confirm Password">
                                </div>
                                <div class="form-group col-4">
                                    <label for="profile_pic">Upload Profile Picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="profile_pic" id="profile_pic">
                                            <label class="custom-file-label" for="profile_pic">Choose Profile Picture</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
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
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

