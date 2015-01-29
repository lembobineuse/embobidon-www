<?php

require_once __DIR__.'/../../don/src/bootstrap.php';

?>
<!DOCTYPE html>
<html lang="<?php echo $LANG ?>">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Appel à dons | L'Embobineuse</title>

    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <!--
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.2/cyborg/bootstrap.min.css">

    <!-- jQuery.fancybox -->
    <link rel="stylesheet" href="js/vendor/fancybox-2.1.5/source/jquery.fancybox.css" type="text/css" media="screen" />

    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
       <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?p=01-aguicheur">
                L'Embobineuse, la pelle à dons
            </a>
        </div> 
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Histoire de la Bobine (1944 - 2026) <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="?p=02-bateau-cool">
                                I. Embobineuse, le bateau cool
                            </a>
                        </li>
                        <li>
                            <a href="?p=03-errorism">
                                II. Droit à l'erreur & remises en question
                            </a>
                        </li>
                        <li>
                            <a href="?p=04-naufrage">
                                III. Économie d'un naufrage
                            </a>
                        </li>
                        <li>
                            <a href="?p=05-conclusion">
                                IV. Que l'odyssée suive son cours !
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="?p=06-editos">10 Ans d'Editos</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="?lang=fr">
                        <span class="lang-sm" lang="fr"></span>
                        <span class="sr-only">Français / French</span>
                    </a>
                </li>
                <li>
                    <a href="?lang=en">
                        <span class="lang-sm" lang="en"></span>
                        <span class="sr-only">English</span>
                    </a>
                </li>
                <li>
                    <a href="?lang=ja">
                        <span class="lang-sm" lang="ja"></span>
                        <span class="sr-only">日本語 / Japanese</span>

                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="container" id="header">

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <img src="img/logo_big.png" alt="" class="img-responsive center-block"/>
            </div>
            <div class="col-md-6">
                <div class="slogan-container">
                    <img src="img/slogan.png" class="img-responsive center-block"
                        alt="L'Embobineuse, pilier de la patate, sollicite un don pour ne pas perdre la frite !"/>
                    <div class="donate-callout">
                        <a class="btn btn-primary btn-lg btn-donate"
                            href="http://www.helloasso.com/associations/l-embobineuse/collectes/embobidon/faire-un-don" target="_blank">
                            Faire un don !
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<main class="container">

    <section id="<?php echo $current_route ?>">
    <?php require_once $current_page ?>
    </section>

</main>

<footer class="container-fluid" id="footer">

    <div class="row">

        <div class="col-md-4 col-md-push-4">
            <p>
                <strong>L'EMBOBINEUSE A BESOIN DE TOI !</strong>
            </p>
            <p>
                <a href="http://www.helloasso.com/associations/l-embobineuse/collectes/embobidon/faire-un-don" target="_blank"
                    class="btn btn-primary btn-donate" style="width: 100%">
                    Fais un don !
                </a>
            </p>
            <p>
                <strong>Et fais tourner le message:</strong>
            </p>
            <p class="btn-group btn-group-justified">
                <a class="btn btn-social btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://lembobineuse.biz/don" target="_blank">
                    Facebook
                </a>
                <a class="btn btn-social btn-twitter" href="https://twitter.com/home?status=L'Embobineuse,%20pilier%20de%20la%20patate,%20sollicite%20vos%20dons%20pour%20ne%20pas%20perdre%20la%20frite%20!%0Ahttp://lembobineuse.biz/don" target="_blank">
                    Twitter
                </a>
                <a class="btn btn-social btn-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=http://lembobineuse.biz/don&title=L'Embobineuse,%20pilier%20de%20la%20patate,%20sollicite%20vos%20dons%20pour%20ne%20pas%20perdre%20la%20frite%20!" target="_blank">
                    LinkedIn
                </a>
                <a class="btn btn-social btn-google-plus" href="https://plus.google.com/share?url=http://lembobineuse.biz/don" target="_blank">
                    Google +
                </a>
            </p>
            <p>
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                Conformément à la loi du 1er août 2003 relative au mécénat culturel,
                les dons adressés à L'Embobineuse ouvrent droit à une réduction d’impôt
                égale à 66% du montant du don,
                dans la limite annuelle de 20 % du revenu imposable.
                <a href="http://vosdroits.service-public.fr/particuliers/F426.xhtml" target="_blank">
                    Plus d'information ici
                </a>.
            </p>
        </div>

        <div class="col-md-4 col-md-push-4">
            Plan de sauvetage:
            <ul>
                <li>
                    <a href="?p=01-aguicheur">La Pelle à Dons</a>
                </li>
                <li>
                    Histoire de la Bobine
                    <ol>
                        <li>
                            <a href="?p=02-bateau-cool">Embobineuse, le bateau cool</a>
                        </li>
                        <li>
                            <a href="?p=03-errorism">Droit à l'erreur & remises en question</a>
                        </li>
                        <li>
                            <a href="?p=04-naufrage">Économie d'un naufrage</a>
                        </li>
                        <li>
                            <a href="?p=05-conclusion">Que l'odyssée suive son cours !</a>
                        </li>
                    </ol>
                </li>
                <li>
                    <a href="?p=06-editos">10 Ans d'Editos</a>
                </li>
            </ul>
        </div>

        <div class="col-md-4 col-md-pull-8">

            <div class="row">
                <div class="col-md-6 hidden-sm hidden-xs">
                    <img src="img/logo_big.png" alt="" class="img-responsive center-block"/>
                </div>
                <div class="col-md-6">
                    <address>
                        <p>
                            <b>L'Embobineuse</b><br>
                            11 Bd Boués<br/>
                            13001 Marseille<br/>
                            FRANCE
                        </p>
                        <p>
                            <span class="glyphicon glyphicon-phone" aria-hidden="true" aria-label="Phone"></span>
                            <a href="tel:+33-4-91-50-66-09">+33 4 91 50 66 09</a>
                            <br/>
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true" aria-label="Email"></span>
                            <a href="mailto:info@lembobineuse.biz">info@lembobineuse.biz</a>
                            <br/>
                            <span class="glyphicon glyphicon-home" aria-hidden="true" aria-label="Website"></span>
                            <a href="http://lembobineuse.biz">www.lembobineuse.biz</a><br/>
                        </p>
                    </address>
                </div>
            </div>

        </div>
    </div>

</footer>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Bootstraop Javascript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- jQuery.fancybox -->
<script src="js/vendor/fancybox-2.1.5/source/jquery.fancybox.pack.js"></script>
<script src="js/vendor/fancybox-2.1.5/source/helpers/jquery.fancybox-media.js"></script>

<script src="js/main.js"></script>

</body>
</html>
