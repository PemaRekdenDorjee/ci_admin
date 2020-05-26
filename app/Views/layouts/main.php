<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?=base_url()?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?=base_url()?>/plugins/toastr/toastr.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url()?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url()?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?=base_url()?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?=base_url()?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?=base_url()?>/plugins/toastr/toastr.min.js"></script>
    <!-- DataTables -->
    <script src="<?=base_url()?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>/dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition sidebar-mini accent-primary">
<!-- Site wrapper -->
<div class="wrapper">
    <?= $this->include('partials/navbar-top')?>
    <?= $this->include('partials/navbar-side')?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?= $this->include('partials/flashmessage')?>
        <?= $this->renderSection('content')?>
    </div>
    <!-- /.content-wrapper -->
     <?= $this->include('partials/footer')?>
</div>
<!-- ./wrapper -->
</body>
</html>
