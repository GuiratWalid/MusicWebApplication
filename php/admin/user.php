<?php
// Importer les données de l'administrateur
    class User{
        public $fullname = null;
        public $datenais = null;
        public $username = null;
        public $genre = null;
        public $password = null;
        public $lieu = null;
        public $email = null;
        public $image = null;
        public $userid = null;
        public function __construct($userid,$fullname,$datenais,$username,$genre,$lieu,$password,$email,$image){
            $this->userid = $userid;
            $this->fullname = $fullname;
            $this->datenais = $datenais;
            $this->username = $username;
            $this->genre = $genre;
            $this->lieu = $lieu;
            $this->password = $password;
            $this->email = $email;
            $this->image = $image;
        }
    }
    include("../tools/checkSession.php");
    if(check("admin")){
        $userid = $_SESSION["userid"];
        $query1 = "SELECT * FROM users WHERE userid = ".$userid." AND role='admin'";
        include("../tools/connexion.php");
        $result1 = $connexion->query($query1);
        if($row = $result1->fetch_assoc()){
            global $user;
            $user = new User($row["userid"],$row["fullname"],$row["datenais"],$row["username"],$row["genre"],$row["lieu"],$row["password"],$row["email"],$row["image"]);
        }
        if(isset($_GET["userid"])){
            $id = $_GET["userid"];
            $query2 = "SELECT * FROM users WHERE userid = ".$id." AND role='user'";
            $result2 = $connexion->query($query2);
            if($row = $result2->fetch_assoc()){
                global $user2;
                $user2 = new User($row["userid"],$row["fullname"],$row["datenais"],$row["username"],$row["genre"],$row["lieu"],$row["password"],$row["email"],$row["image"]);
            }
        }
        
        if(isset($_POST["delete"])){
            unlink('../../images/uploads/'.$user2->image);
            $query3 = "DELETE FROM users WHERE userid = ".$id;
            $connexion->query($query3);
            header("Location: users.php");
        }
    }
    else{
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Profil | Music Hub</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/logo.png">
    <!-- Custom CSS -->
   <link href="../../css/style.min.css" rel="stylesheet">
   <link href="../../css/post.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="home.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="../../plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="../../plugins/images/logo-text.png" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3" method="GET" action="search.php">
                                <input type="text" name="word" placeholder="Rechercher ..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="profile.php">
                                <img src="../../images/uploads/<?php echo $user->image; ?>" alt="user-img" width="40" height="40"
                                    class="img-circle"><span class="text-white font-medium"><?php echo $user->fullname; ?></span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="home.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Statistiques</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profil</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="users.php"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Utilisateurs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="posts.php"
                                aria-expanded="false">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                <span class="hide-menu">Publications</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admins.php"
                                aria-expanded="false">
                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                                <span class="hide-menu">Administrateurs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="addAdmin.php"
                                aria-expanded="false">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                <span class="hide-menu">Ajouter administrateur</span>
                            </a>
                        </li>
                        <li class="sidebar-item my-5">
                        </li>
                        <li class="text-center p-20 upgrade-btn m-3">
                            <form method="POST" action="../tools/logout.php">
                                <input type="submit" class="btn d-grid btn-primary text-white" target="_blank" value="    Se déconnecter    ">
                            </form>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profil de l'administrateur</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <form method="POST" action="" class="d-flex flex-row-reverse m-0">
                                                    <button type="submit" class="btn btn-danger" style="color:white;" name="delete">
                                                        <i class="fa fa-trash-alt"> Supprimer</i>
                                                    </button>
                        </form>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="../../plugins/images/large/img1.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="../../images/uploads/<?php echo $user2->image; ?>"
                                                class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $user2->fullname; ?></h4>
                                        <h5 class="text-white mt-2"><?php echo $user2->email; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1>ID :</h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1><?php echo $user2->userid; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="posts-content">
                            <?php
                                $query4 = "SELECT p.image, p.file, p.titre, p.date FROM users u, posts p WHERE u.userid = p.userid AND u.userid = ".$user2->userid;
                                $result4 = $connexion->query($query4);
                                while($row = $result4->fetch_assoc()){
                            ?>
                            <div class="row">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="media mb-3">
                                        <img src="../../images/uploads/<?php echo $user2->image ?>" class="d-block ui-w-40 rounded-circle" alt="">
                                        <div class="media-body ml-3">
                                            <?php echo $user2->fullname ?>
                                            <div class="text-muted small"><?php echo $row['date']; ?></div>
                                        </div>
                                        </div>
                                        <h4><?php echo $row['titre']; ?></h4>
                                        <img src='../../images/uploads/<?php echo $row['image']; ?>' height="80%" width="100%"/>
                                        <audio controls style="width:100%;position: relative;bottom: 60px;">
                                            <source src="../../audio/uploads/<?php echo $row['file']; ?>"/>
                                        </audio>
                                    </div>
                                    <div class="card-footer">
                                        <a href="javascript:void(0)" class="d-inline-block text-muted">
                                            <strong>123</strong> Likes</small>
                                        </a>
                                        <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">
                                            <strong>12</strong> Comments</small>
                                        </a>
                                        <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">
                                        <small class="align-middle">Repost</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> <?php echo date("Y"); ?> © Music application
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="../../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../js/custom1.js"></script>
</body>

</html>