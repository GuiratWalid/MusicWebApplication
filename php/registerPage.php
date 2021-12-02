<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/signup.css">
    <title>S'inscrire</title>
</head>

<body>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="../images/music1.png" alt="" />
                <h3>Bienvenue</h3>
                <p>Vous êtes à 30 secondes de créer votre playlist !</p>
                <form action="loginPage.php">
                    <input type="submit" name="connexion" value="Connexion" /><br />
                </form>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Créer un compte</h3>
                        <form class="row register-form" action="register.php" method="POST">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fullname"
                                        placeholder="Nom et prénom *" value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email *" value=""
                                        required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Mot de passe *" value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password2"
                                        placeholder="Confirmer le mot de passe *" value="" required />
                                </div>
                                <div class="form-group">
                                    <div class="maxl">
                                        <label class="radio inline">
                                            <input type="radio" name="genre" value="homme" checked>
                                            <span>Homme</span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="genre" value="femme">
                                            <span>Femme</span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="genre" value="autre">
                                            <span>Autre</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username *"
                                        value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="date" name="datenais" class="form-control" placeholder="Your Phone *"
                                        value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lieu" placeholder="Lieu *" value=""
                                        required />
                                </div>
                                <div class="form-group">
                                    <input type="button" class="form-control"
                                        onclick="document.getElementById('img').click()" value="Importer une image" />
                                    <input type="file" id="img" name="image" style="display:none"
                                        accept="image/png, image/jpeg" class="form-control" />
                                </div>
                                <input type="submit" class="btnRegister" name="register" value="S'inscrire" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>