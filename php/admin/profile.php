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
    $fullname = null;
    $email = null;
    $image = null;
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

// Mise à jour du profil
    global $error;
    $error=NULL;
    global $success;
    $success = NULL;
    if(isset($_POST['update'])){
        //upload image initialization
        $filename = md5(time());
        if(isset($_FILES["image"])){
            $filename .= $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
        }    
        $folder = "../../images/uploads/".$filename;

        $Champs = 0;

        $query2 = "UPDATE users SET ";
        if(isset($_POST['fullname']) && $_POST['fullname'] !== $user->fullname){
            $query2 .= " fullname = '".$_POST['fullname']."' ";
            $Champs++;
        }
        if(isset($_POST['email']) && $_POST['email'] !== $user->email){
            $query="SELECT * FROM users WHERE email='".$_POST['email']."' LIMIT 1";
            $result = $connexion->query($query); 
            if($result->num_rows==1){
                $error="L'email doit être unique !";
            }
            else{
                if($Champs >= 1){
                    $Champs++;
                    $query2 .= ", ";
                }
                $query2 .= " email = '".$_POST['email'] ."' ";
            }
        }
        if(isset($_POST['password']) && $_POST['password'] !== ""){
            if($_POST['password'] !== $_POST['password2']){
                $error="Mot de passe incorrect !";
            }
            else {
                if($Champs >= 1){
                    $Champs++;
                    $query2 .= ", ";
                }
                $query2 .= " password = '".md5($_POST['password'])."' ";
            }
        }
        if(isset($_POST['genre']) && $_POST['genre'] !== $user->genre){
            if($Champs >= 1){
                $Champs++;
                $query2 .= ", ";
            }
            $query2 .= " genre = '".$_POST['genre']."' ";
        }
        if(isset($_POST['username']) && $_POST['username'] !== $user->username){
            $query="SELECT * FROM users WHERE username=\'".$_POST['username']."' LIMIT 1";
            if($connexion->query($query)){
                $error="Username doit être unique !";
            }
            else{
                if($Champs >= 1){
                    $Champs++;
                    $query2 .= ", ";
                }
                $query2 .= " username = '".$_POST['username']."' ";
            }
        }
        if(isset($_POST['datenais']) && $_POST['datenais'] !== $user->datenais){
            if($Champs >= 1){
                $Champs++;
                $query2 .= ", ";
            }
            $query2 .= " datenais = '".$_POST['datenais']."' ";
        }
        if(isset($_POST['lieu']) && $_POST['lieu'] !== $user->lieu){
            if($Champs >= 1){
                $Champs++;
                $query2 .= ", ";
            }
            $query2 .= " lieu = '".$_POST['lieu']."' ";
        }
        if(isset($_FILES["image"]["name"])){
            if (move_uploaded_file($tempname, $folder))  {
                if($Champs >= 1){
                    $Champs++;
                    $query2 .= ", ";
                }
                $query2 .= " image = '".$filename."' ";
                unlink('../../images/uploads/'.$user->image);
            }
        }
        $query2 .= " WHERE userid = ".$userid;
        if($connexion->query($query2)){
            $success = "Profil mis à jour avec succès !";
        }
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
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <?php 
                                    if(!($error == null)){
                                        echo "<div class=\"m-0 alert alert-danger text-center\">$error</div>";
                                    }
                                    else if(!($success == null)){
                                        echo "<div class=\"m-0 alert alert-success text-center\">$success</div>";
                                    }
                                ?>
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
                                        <a href="javascript:void(0)"><img src="../../images/uploads/<?php echo $user->image; ?>"
                                                class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $user->fullname; ?></h4>
                                        <h5 class="text-white mt-2"><?php echo $user->email; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1>ID :</h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1><?php echo $user->userid; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Nom et prénom</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $user->fullname; ?>" required
                                                class="form-control p-0 border-0" name="fullname"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" value="<?php echo $user->email; ?>" required
                                                class="form-control p-0 border-0" name="email"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Mot de passe</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" name="password" placeholder="Saisir un nouveau mot de passe" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Confirmer le mot de passe</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" name="password2" placeholder="Confimer le nouveau mot de passe" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Genre</label>
                                        <div class="col-sm-12 border-bottom">
                                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="genre">
                                                <option <?php if($user->genre === "homme") echo "selected";?>>homme</option>
                                                <option <?php if($user->genre === "femme") echo "selected";?>>femme</option>
                                                <option <?php if($user->genre === "autre") echo "selected";?>>autre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-username" class="col-md-12 p-0">Username</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $user->username; ?>" required
                                                class="form-control p-0 border-0" name="username"
                                                id="example-username">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-datenais" class="col-md-12 p-0">Date de naissance</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="date" value="<?php echo $user->datenais; ?>" required
                                                class="form-control p-0 border-0" name="datenais"
                                                id="example-datenais">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-lieu" class="col-md-12 p-0">Lieu</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $user->lieu; ?>" required
                                                class="form-control p-0 border-0" name="lieu"
                                                id="example-lieu">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="img" class="col-md-12 p-0">Photo de profil</label>
                                        <input type="button" class="form-control"
                                            onclick="document.getElementById('img').click()" value="Importer une image" />
                                        <input type="file" id="img" name="image" style="display:none"
                                            accept="image/png, image/jpeg" class="form-control" />
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <input type="submit" name="update" class="btn btn-success" value="Modifier mon profil" />
                                        </div>
                                    </div>
                                </form>
                            </div>
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