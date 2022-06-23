<?php
$kode = '';
$api = 'https://api.pertanian.go.id/api/simantap/dashboard/list?&api-key=f13914d292b53b10936b7a7d1d6f2406&kode=x' . $kode;
$result = file_get_contents($api, false);
$json = json_decode($result, true);
$data = $json[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png'); ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico'); ?>">
    <title>
        Login
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url('assets/css/nucleo-icons.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/nucleo-svg.css'); ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('assets/css/nucleo-svg.css'); ?>" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets/css/soft-ui-dashboard.css?v=1.0.3'); ?>" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-2 " href="<?= base_url(); ?>" style="font-size:25px">
                            <img src="<?= base_url('assets/img/logo.png'); ?>" alt="" width="50%" style="max-width:50px"> Sistem Informasi Manajemen Penyuluhan Pertanian
                        </a>


                    </div>

                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">

                                <li class="nav-item ">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default">
                                        <span>Informasi</span>
                                        <span class="badge badge-md badge-circle badge-floating badge-danger border-white"><?= $dtjuminfo; ?></span>
                                    </button>
                                </li>


                            </ul>

                        </div>
                    </div>
                </nav>

                <!-- End Navbar -->
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Informasi</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Hari ini</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                <?php foreach ($dtinfo as $row) {
                                ?>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-3 text-sm"><?= $row['judul_info']; ?></h6>
                                            <span class="mb-2 text-xs">Tanggal: <span class="text-dark font-weight-bold ms-sm-2"><?php echo longdate_indo(substr($row['tgl_info'], 0, 10)); ?></span></span>
                                            <span class="mb-2 text-xs">Isi: <span class="text-dark font-weight-bold ms-sm-2"><?= $row['deskripsi_info']; ?></span></span>
                                            <span class="mb-2 text-xs">File : <span class="text-dark ms-sm-2 font-weight-bold"><a href="<?= base_url('assets/dok/info/' . $row['file_info']) ?>">Download</a></span></span>

                                        </div>
                                        <!-- <div class="ms-auto text-end">
                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                        </div> -->
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>




                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <main class="main-content  mt-0">

        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang</h3>
                                    <p class="mb-0">Masukkan akun anda untuk login</p>
                                </div>
                                <div class="card-body">
                                    <?php if (session()->getFlashdata('msg')) : ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                    <?php endif; ?>
                                    <form class="user" method="post" action="<?= base_url('auth/login/proses'); ?>">
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Email" aria-describedby="email-addon">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">

                                        </div>
                                        <!--
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                        </div>
										-->
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <!-- <p class="mb-4 text-sm mx-auto">
                                        Tidak punya akun ?
                                        <a href="javascript:;" class="text-info text-gradient font-weight-bold">Cek Data</a>
                                    </p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('<?= base_url(); ?>/assets/img/2035.jpg')"></div>
                            </div>
                        </div>
                    </div>


                    <!-- Page Heading -->
                    <div class="row mt-3 mb-4">

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah BPP</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumbpp']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="far fa-building"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Poktan</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpoktan']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Gapoktan</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumgapoktan']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh PNS</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpenyuluhpns']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBN</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpenyuluhthlapbn']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBD</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpenyuluhthlapbd']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swadaya</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpenyuluhswadaya']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swasta</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpenyuluhswasta']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh P3K</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpenyuluhp3k']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah KEP</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumkep']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Gapoktan Bersama</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumgapoktanbersama']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Kelembagaan Lainnya</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpenyuluhswasta']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah P2L</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    <?= number_format($data['jumpoktanp2l']); ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->

    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/core/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/chartjs.min.js'); ?>"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets/js/soft-ui-dashboard.min.js?v=1.0.3'); ?>"></script>
</body>

</html>