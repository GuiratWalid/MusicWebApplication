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
        $query0="delete from users where verifier = 0 and  date < NOW() - INTERVAL 1 DAY";
        $connexion->query($query0);
        $result1 = $connexion->query($query1);
        if($row = $result1->fetch_assoc()){
            global $user;
            $user = new User($row["userid"],$row["fullname"],$row["datenais"],$row["username"],$row["genre"],$row["lieu"],$row["password"],$row["email"],$row["image"]);
        }

        if(isset($_POST["deletepost"])){
            unlink('../../images/uploads/'.$_POST["imagepost"]);
            unlink('../../audio/uploads/'.$_POST["filepost"]);
            $query4 = "DELETE FROM posts WHERE postid = ".$_POST["idpost"];
            $connexion->query($query4);
            header("Location: posts.php");
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
                            <img src="../../images/logo1.png" alt="homepage" width="220"/>
                        </b>
                        <!--End Logo icon -->
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
                        <h4 class="page-title">Statistiques</h4>
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
                <div class="row alert alert-info" role="alert">
                    <h4 class="text-center">Statistiques du 24 dernières heures</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre d'administrateurs</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img1.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query2 = "SELECT count(*) as numadmin from users where role = 'admin' and  date > NOW() - INTERVAL 1 DAY";
                                    $result2 = $connexion->query($query2);
                                    if($row = $result2->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-success"><?php echo $row["numadmin"]; }?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre d'utilisateurs</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img2.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query3 = "SELECT count(*) as numuser from users where role = 'user' and  date > NOW() - INTERVAL 1 DAY";
                                    $result3 = $connexion->query($query3);
                                    if($row = $result3->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-purple"><?php echo $row["numuser"]; }?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre de publications</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img3.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query5 = "SELECT count(*) as numpost from posts where date > NOW() - INTERVAL 1 DAY";
                                    $result5 = $connexion->query($query5);
                                    if($row = $result5->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-info"><?php echo $row["numpost"]; }?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre de j'aime</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img4.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query6 = "SELECT count(*) as numlike from likes where date > NOW() - INTERVAL 1 DAY";
                                    $result6 = $connexion->query($query6);
                                    if($row = $result6->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-danger"><?php echo $row["numlike"]; }?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre de commentaires</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img1.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query7 = "SELECT count(*) as numcomment from comments where date > NOW() - INTERVAL 1 DAY";
                                    $result7 = $connexion->query($query7);
                                    if($row = $result7->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-success"><?php echo $row["numcomment"]; }?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row alert alert-info" role="alert">
                    <h4 class="text-center">Top 10 utilisateurs du 24 dernières heures</h4>
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="white-box">
                        <?php 
                            class Transaction {
                                public $userid = null;
                                public $image = null;
                                public $fullname = null;
                                public $numpost = null;
                                public $numlike = null;
                                public $numcomment = null;
                                public $total = null;
                            }
                            $array = array();
                            $query8 = "SELECT userid, fullname, image FROM users where role = 'user'";
                            $result8 = $connexion->query($query8);
                            while($row0 = $result8->fetch_assoc()){
                                $t = new Transaction();
                                $t->userid = $row0["userid"];
                                $t->image = $row0["image"];
                                $t->fullname = $row0["fullname"];
                                $query9 = "SELECT COUNT(postid) as numpost FROM posts WHERE userid = '".$t->userid."' AND date > NOW() - INTERVAL 1 DAY";
                                $result9 = $connexion->query($query9);
                                if($row1 = $result9->fetch_assoc()){
                                    $t->numpost = $row1["numpost"];
                                }
                                $query9 = "SELECT COUNT(likeid) as numlike FROM likes where userid = '".$t->userid."' AND date > NOW() - INTERVAL 1 DAY";
                                $result9 = $connexion->query($query9);
                                if($row1 = $result9->fetch_assoc()){
                                    $t->numlike = $row1["numlike"];
                                }
                                $query9 = "SELECT COUNT(commentid) as numcomment FROM comments where userid = '".$t->userid."' AND date > NOW() - INTERVAL 1 DAY";
                                $result9 = $connexion->query($query9);
                                if($row1 = $result9->fetch_assoc()){
                                    $t->numcomment = $row1["numcomment"];
                                }
                                $t->total = $t->numpost + $t->numlike + $t->numcomment;
                                array_push($array,$t);
                            }
                            if(count($array) != 0){
                                usort($array,function($first,$second){
                                    return $first->total < $second->total;
                                });
                            ?>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Rang</th>
                                            <th></th>
                                            <th class="border-top-0">Utilisateurs</th>
                                            <th class="border-top-0">Publications</th>
                                            <th class="border-top-0">J'aime</th>
                                            <th class="border-top-0">Commentaires</th>
                                            <th class="border-top-0">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach($array as $key => $value){
                                                if($key >= 10) 
                                                    break;
                                        ?>
                                        <tr>
                                            <td><?php echo $key+1;?></td>
                                            <td class="border-top-0">
                                                <a href="user.php?userid=<?php echo $value->userid;?>">
                                                    <img src="../../images/uploads/<?php echo  $value->image; ?>" alt="user-img" width="50" height="50"
                                                        class="rounded-circle"><span class="text-white font-medium">
                                                </a>
                                            </td>
                                            <td><a href="user.php?userid=<?php echo $value->userid;?>"><?php echo $value->fullname;?></a></td>
                                            <td><?php echo $value->numpost;?></td>
                                            <td><?php echo $value->numlike;?></td>
                                            <td><?php echo $value->numcomment;?></td>
                                            <td><?php echo $value->total;?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php   
                                }
                                else{
                                    echo "<div class=\"m-0 alert alert-danger text-center\">Aucun utilisateur trouvé !</div>";
                                }
                            ?>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row alert alert-info" role="alert">
                    <h4 class="text-center">Statistiques générales</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre d'administrateurs</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img2.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query2 = "SELECT count(*) as numadmin from users where role = 'admin'";
                                    $result2 = $connexion->query($query2);
                                    if($row = $result2->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-purple"><?php echo $row["numadmin"]; }?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre d'utilisateurs</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img3.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query3 = "SELECT count(*) as numuser from users where role = 'user'";
                                    $result3 = $connexion->query($query3);
                                    if($row = $result3->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-info"><?php echo $row["numuser"]; }?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre de publications</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img4.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query5 = "SELECT count(*) as numpost from posts";
                                    $result5 = $connexion->query($query5);
                                    if($row = $result5->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-danger"><?php echo $row["numpost"]; }?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre de j'aime</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img1.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query6 = "SELECT count(*) as numlike from likes";
                                    $result6 = $connexion->query($query6);
                                    if($row = $result6->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-success"><?php echo $row["numlike"]; }?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre de commentaires</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <img src="../../images/img2.png" alt="statistics"/>
                                </li>
                                <?php 
                                    $query7 = "SELECT count(*) as numcomment from comments";
                                    $result7 = $connexion->query($query7);
                                    if($row = $result7->fetch_assoc()){
                                ?>
                                <li class="ms-auto"><span class="counter text-purple"><?php echo $row["numcomment"]; }?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row alert alert-info" role="alert">
                    <h4 class="text-center">Top 10 utilisateurs</h4>
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="white-box">
                        <?php 
                            $array = array();
                            $query8 = "SELECT userid, fullname, image FROM users where role = 'user'";
                            $result8 = $connexion->query($query8);
                            while($row0 = $result8->fetch_assoc()){
                                $t = new Transaction();
                                $t->userid = $row0["userid"];
                                $t->image = $row0["image"];
                                $t->fullname = $row0["fullname"];
                                $query9 = "SELECT COUNT(postid) as numpost FROM posts WHERE userid = '".$t->userid."'";
                                $result9 = $connexion->query($query9);
                                if($row1 = $result9->fetch_assoc()){
                                    $t->numpost = $row1["numpost"];
                                }
                                $query9 = "SELECT COUNT(likeid) as numlike FROM likes where userid = '".$t->userid."'";
                                $result9 = $connexion->query($query9);
                                if($row1 = $result9->fetch_assoc()){
                                    $t->numlike = $row1["numlike"];
                                }
                                $query9 = "SELECT COUNT(commentid) as numcomment FROM comments where userid = '".$t->userid."'";
                                $result9 = $connexion->query($query9);
                                if($row1 = $result9->fetch_assoc()){
                                    $t->numcomment = $row1["numcomment"];
                                }
                                $t->total = $t->numpost + $t->numlike + $t->numcomment;
                                array_push($array,$t);
                            }
                            if(count($array) != 0){
                                usort($array,function($first,$second){
                                    return $first->total < $second->total;
                                });
                            ?>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Rang</th>
                                            <th></th>
                                            <th class="border-top-0">Utilisateurs</th>
                                            <th class="border-top-0">Publications</th>
                                            <th class="border-top-0">J'aime</th>
                                            <th class="border-top-0">Commentaires</th>
                                            <th class="border-top-0">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach($array as $key => $value){
                                                if($key >= 10) 
                                                    break;
                                        ?>
                                        <tr>
                                            <td><?php echo $key+1;?></td>
                                            <td class="border-top-0">
                                                <a href="user.php?userid=<?php echo $value->userid;?>">
                                                    <img src="../../images/uploads/<?php echo  $value->image; ?>" alt="user-img" width="50" height="50"
                                                        class="rounded-circle"><span class="text-white font-medium">
                                                </a>
                                            </td>
                                            <td><a href="user.php?userid=<?php echo $value->userid;?>"><?php echo $value->fullname;?></a></td>
                                            <td><?php echo $value->numpost;?></td>
                                            <td><?php echo $value->numlike;?></td>
                                            <td><?php echo $value->numcomment;?></td>
                                            <td><?php echo $value->total;?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php   
                                }
                                else{
                                    echo "<div class=\"m-0 alert alert-danger text-center\">Aucun utilisateur trouvé !</div>";
                                }
                            ?>
                    </div>
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
            <footer class="footer text-center"> <?php echo date("Y"); ?> © Music Hub
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
    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--chartis chart-->
    <script src="../../plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="../../plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../../js/pages/dashboards/dashboard1.js"></script>
</body>

</html>