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
                <div class="col-12">
                    <a class="btn btn-primary mb-2 float-right" href="<?=base_url()?>/users/create"><span class="fas fa-plus">&nbsp;</span>Add</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="usersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $row):?>
                                    <tr>
                                        <td><?= $row['username']?></td>
                                        <td><?= $row['email']?></td>
                                        <td><?= $row['phone']?></td>
                                        <td>
                                            <?php if ($row['status'] ==1):?>
                                                <button type="button" class="btn btn-sm btn-success">
                                                    Active
                                                </button>
                                            <?php else:?>
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    Blocked
                                                </button>
                                            <?php endif;?>
                                        </td>
                                        <td><a href="<?=base_url()?>/users/profile/<?=$row['id'] ?>" data-toggle="tooltip" data-placement="top" title="View User Profile"class="btn btn-xs btn-primary"><span class="fas fa-eye"></span></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                     <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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