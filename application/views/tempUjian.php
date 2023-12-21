<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logo.png" type="image/x-icon" />
    <title>TJAKRINDO MAS - UJIAN</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/pace/pace-theme-flash.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bubble.css">

    <script src="<?= base_url() ?>assets/bower_components/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        var base_url = '<?= base_url() ?>';
    </script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <div class="bubble-holder two">
                            <div class="bubble-rotate-offset">
                                <figure class="ball bubble"></figure>
                            </div>
                        </div>
                        <a href="<?= base_url() ?>" class="navbar-brand"><i class="fa fa-laptop"></i> <b>PT Tjakrindo Mas</b></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><?= $this->session->userdata('nama') ?></a></li>
                        </ul>
                    </div>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li><a href="#" onclick="simpan_akhir()">Selesai Ujian</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <?= $this->session->userdata('nama') ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?= site_url('auth/logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>

        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Ujian
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <!-- <li><a href="<?= base_url() ?>ujian/list"><?= $ujian->judul ?></a></li> -->
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <?= $contents ?>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <?= strftime('%A, %d %B %Y') ?>, <span class="live-clock"><?= date('H:i:s') ?></span>
               
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/pace/pace.min.js"></script>

    <script type="text/javascript">
        function sisawaktu(t) {
            var time = new Date(t);
            var n = new Date();
            var x = setInterval(function() {
                var now = new Date().getTime();
                var dis = time.getTime() - now;
                var h = Math.floor((dis % (1000 * 60 * 60 * 60)) / (1000 * 60 * 60));
                var m = Math.floor((dis % (1000 * 60 * 60)) / (1000 * 60));
                var s = Math.floor((dis % (1000 * 60)) / (1000));
                h = ("0" + h).slice(-2);
                m = ("0" + m).slice(-2);
                s = ("0" + s).slice(-2);
                var cd = h + ":" + m + ":" + s;
                $('.sisawaktu').html(cd);
            }, 100);
            setTimeout(function() {
                waktuHabis();
            }, (time.getTime() - n.getTime()));
        }

        function countdown(t) {
            var time = new Date(t);
            var n = new Date();
            var x = setInterval(function() {
                var now = new Date().getTime();
                var dis = time.getTime() - now;
                var d = Math.floor(dis / (1000 * 60 * 60 * 24));
                var h = Math.floor((dis % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var m = Math.floor((dis % (1000 * 60 * 60)) / (1000 * 60));
                var s = Math.floor((dis % (1000 * 60)) / (1000));
                d = ("0" + d).slice(-2);
                h = ("0" + h).slice(-2);
                m = ("0" + m).slice(-2);
                s = ("0" + s).slice(-2);
                var cd = d + " Hari, " + h + " Jam, " + m + " Menit, " + s + " Detik ";
                $('.countdown').html(cd);

                setTimeout(function() {
                    location.reload()
                }, dis);
            }, 1000);
        }

        function ajaxcsrf() {
            var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
            var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
            var csrf = {};
            csrf[csrfname] = csrfhash;
            $.ajaxSetup({
                "data": csrf
            });
        }

        $(document).ready(function() {
            setInterval(function() {
                var date = new Date();
                var h = date.getHours(),
                    m = date.getMinutes(),
                    s = date.getSeconds();
                h = ("0" + h).slice(-2);
                m = ("0" + m).slice(-2);
                s = ("0" + s).slice(-2);

                var time = h + ":" + m + ":" + s;
                $('.live-clock').html(time);
            }, 1000);
        });
    </script>

</body>

</html>