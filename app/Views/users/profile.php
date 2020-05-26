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
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="
                                 <?php if ($usersData->profile_picture !='' || $usersData->profile_picture !=null):?>
                                     <?=base_url()?>/<?= $usersData->profile_picture?>
                                 <?php else: ?>
                                    <?=base_url()?>/uploads/default/profiles/profile.png
                                 <?php endif; ?>
                                   "
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $usersData->username?></h3>

                        <p class="text-muted text-center"><?= $usersData->email?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Status:</b> <a class="float-right"><?= ($usersData->status ==1)?'Active':'Block'?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone no:</b> <a class="float-right">(+975)-<?= $usersData->phone?></a>
                            </li>
                        </ul>
                        <a href="<?=base_url()?>/users/edit/<?= $usersData->id?>" class="btn btn-info btn-sm btn-block"> <span class="fas fa-pen">&nbsp;</span>Update Info</a>
                        <button type="button" class="btn btn-secondary btn-sm btn-block" data-toggle="modal" data-target="#change_pwd"><span class="fas fa-lock">&nbsp;</span>Change Password</button>
                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#change_photo"><span class="fas fa-image">&nbsp;</span>Change Photo</button>
                        <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#reset_pwd"><span class="fas fa-key">&nbsp;</span>Reset Password</button>
                        <a href="mailto:<?= $usersData->email?>" target="_blank" class="btn btn-warning btn-sm btn-block"><span class="fas fa-mail-bulk">&nbsp;</span>Send Email</a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"> User Activity</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="usersTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DateTime</th>
                                            <th>Process</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!--    /.content -->
<!--change password model -->
<div class="modal fade" id="change_pwd">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- form start -->
            <form role="form" action="<?=base_url()?>/users/changepwd" method="post" >
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-lock">&nbsp;</span>Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="<?= $usersData->id?>">
                        <div class="form-group ">
                            <label for="old_password">Old Password</label>
                            <input type="password"   autocomplete="old_password" class="form-control" name="old_password" id="old_password" placeholder=" Enter Old Password">
                        </div>
                        <div class="form-group ">
                            <label for="new_password">New Password</label>
                            <input type="password"   autocomplete="new_password" class="form-control" name="new_password" id="new_password" placeholder=" Enter New Password">
                        </div>
                        <div class="form-group ">
                            <label for="comfirm_password">Confirm Password</label>
                            <input type="password" autocomplete="comfirm_password"  class="form-control" name="comfirm_password" id="comfirm_password" placeholder=" Confirm Password">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Update</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--change photo model -->
<div class="modal fade" id="change_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- form start -->
            <form role="form" action="<?=base_url()?>/users/changephoto" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-image">&nbsp;</span>Change Profile Picture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="<?= $usersData->id?>">
                        <div class="form-group ">
                            <label for="new_profile_pic">Upload Profile Picture</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="new_profile_pic" id="new_profile_pic">
                                    <label class="custom-file-label" for="new_profile_pic">Choose Profile Picture</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal change photo-->
    <!--reset password model -->
    <div class="modal fade" id="reset_pwd">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- form start -->
                <form role="form" action="<?=base_url()?>/users/resetpwd" method="post" >
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="fas fa-key">&nbsp;</span>Reset Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <input type="hidden" name="user_id" value="<?= $usersData->id?>">
                            <p>Are you sure you want to rest this user password</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal change photo-->

    <!-- page script -->
    <script>
        $(function () {
            $("#usersTable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
<?= $this->endSection() ?>