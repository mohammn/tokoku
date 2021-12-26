<!DOCTYPE html>
<html lang="en">
<?php $url = current_url(true); ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tokoku :) <?= $url->getSegment(3) ?></title>

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url() ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>/public/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url() ?>/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>/public/vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Tokoku <sup>:)</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if ($url->getSegment(3) == "transaksi") {
                                    echo "active";
                                } ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>/transaksi">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi</span></a>
            </li>
            <li class="nav-item <?php if ($url->getSegment(3) == "stok") {
                                    echo "active";
                                } ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>/stok">
                    <i class="fas fa-layer-group"></i>
                    <span>Stok</span></a>
            </li>
            <li class="nav-item <?php if ($url->getSegment(3) == "laporan") {
                                    echo "active";
                                } ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>/laporan">
                    <i class="far fa-calendar-alt"></i>
                    <span>Laporan</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Management Data
            </div>
            <li class="nav-item <?php if ($url->getSegment(3) == "barang") {
                                    echo "active";
                                } ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>/barang">
                    <i class="fas fa-database"></i>
                    <span>Barang</span></a>
            </li>
            <?php if (session()->get("rule") == 1) : ?>
                <li class="nav-item <?php if ($url->getSegment(3) == "user") {
                                        echo "active";
                                    } ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>/user">
                        <i class="fas fa-user"></i>
                        <span>user</span></a>
                </li>
            <?php endif; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Messages -->

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link" href="<?= base_url() . "/login/logout" ?>" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-sign-out-alt fa-fw"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> Log out</span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get("nama") ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url() ?>/public/img/undraw_profile.svg">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <?php $this->renderSection('content'); ?>




                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Tokoku 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>/public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>/public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url() ?>/public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url() ?>/public/js/demo/datatables-demo.js"></script>

</body>

</html>