<?php
include("../tools/checkSession.php");
include("../tools/connexion.php");
if (!check("user")) {

    session_start();
    $useridd = $_SESSION["userid"];
    echo "Page d'accueil de l'utilisateur " . $_SESSION["userid"];
    $rq = "select * from users where userid='$useridd'";
    $result = $connexion->query($rq);
    while ($row = $result->fetch_assoc()) {
        $image = $row['image'];
        $filename = $image;
        $folder = "../../images/uploads/" . $filename;
        $username = $row['username'];
        $mail = $row['email'];
        $fullname = $row['fullname'];
        $daten = $row['datenais'];
        $genre = $row['genre'];
        $lieu = $row['lieu'];
        $pass = $row['password'];
    }
    if (isset($_POST['update'])) {


        //upload image initialization
        $filename = md5(time());
        $filename .= $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../../images/uploads/" . $filename;

        //Get form data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $genre = $_POST['genre'];
        $username = $_POST['username'];
        $datenais = $_POST['datenais'];
        $lieu = $_POST['lieu'];

        //Generate Vkey
        $Vkey = md5(time() . $username);

        //update and account
        if ($password !== $password2) {
            $error = "Mot de passe incorrect !";
            header("location:home.php");
        } else {
            $query = "UPDATE users SET username ='$username', fullname ='$fullname', password='$password', email ='$email',  WHERE userid = '$useridd'";
            //upload image
            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
            if (mysqli_query($connexion, $query)) {
                $success = "Compte modifié avec succès ";
            }
        }
        header("Location:home.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>account setting or edit profile - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="<?php echo $folder; ?>" alt="Maxwell Admin">
                                </div>
                                <h5 class="user-name"><?php echo $username; ?></h5>
                                <h6 class="user-email"><?php echo $mail; ?></h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <form method="POST">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Personal Details</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Username</label>
                                        <input type="text" class="form-control" name="fullName" placeholder="<?php echo $username; ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="ciTy">Full Name</label>
                                        <input type="name" class="form-control" name="fullname" placeholder="<?php echo $fullname; ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="<?php echo $mail; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Type your new ">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="website">Confirm Password</label>
                                        <input type="password" class="form-control" name="password2" placeholder="Website url">
                                    </div>
                                </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">Date Naissance</label>
                                    <input type="date" name="datenais" class="form-control" placeholder="Your Phone *" value="<?php echo $daten; ?>" />
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">Lieu</label>
                                    <input type="name" class="form-control" name="lieu" placeholder="<?php echo $lieu; ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="sTate">Genre</label>
                                    <input type="text" class="form-control" name="genre" placeholder="<?php echo $genre; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zIp">Update Picture</label>
                                    <input type="button" class="form-control" onclick="document.getElementById('img').click()" value="Importer une image" />
                                    <input type="file" id="img" name="image" style="display:none" accept="image/png, image/jpeg" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <input type="submit" name="update" class="btn btn-primary" value="update">
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style type="text/css">
        body {
            margin: 0;
            padding-top: 40px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }

        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
    </style>

    <script type="text/javascript">

    </script>
</body>

</html>