
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo isset($title) ? $title : 'SPK Supplier Dengan SAW'; ?></title>

    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@4.1.3/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        .vertical-center { vertical-align: middle; line-height: 20px; }
        .bg-dark-mode { background-color: #1e1e2f; color: #fff; }
        .bg-custom { background-color: #b2b2b2; }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- INCLUDE SIDEBAR -->
        <?php include 'app/views/partials/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column bg-dark-mode">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top" style="box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw"></i> Logout
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['alert-type']; ?> alert-dismissible fade show">
                            <?php echo $_SESSION['message']; ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                        <?php unset($_SESSION['message']); unset($_SESSION['alert-type']); ?>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- CONTENT -->
                    <?php echo $content; ?>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto text-center text-black">
                    <span style="color: black;">&copy; Sistem Pendukung Keputusan Supplier Terbaik</span>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari sistem? Pilih <strong class="text-danger">Logout</strong> untuk melanjutkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="/spk-saw-supplier/auth/logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/natural.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@4.1.3/js/sb-admin-2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var inputs = document.querySelectorAll('input[type="number"], input[data-allow-decimal="true"]');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9.]/g, '');
                    var parts = this.value.split('.');
                    if (parts.length > 2) this.value = parts[0] + '.' + parts[1];
                    if (this.value.charAt(0) === '.') this.value = '0' + this.value;
                });
            }
        });
    </script>

    <!-- Optional Custom Script -->
    <?php if (!empty($scripts)) echo $scripts; ?>
</body>
</html>
