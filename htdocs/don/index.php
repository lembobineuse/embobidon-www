<?php

require_once __DIR__.'/../../don/src/bootstrap.php';

?>
<!DOCTYPE html>
<html lang="<?php echo $LANG ?>">
<head>
	<meta charset="UTF-8">
	<title>Appel à dons | L'Embobineuse</title>

    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    -->
    <link rel="stylesheet" href="http://bootswatch.com/cyborg/bootstrap.min.css">

    <!-- jQuery.fancybox -->
    <link rel="stylesheet" href="js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="js/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="js/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
	
<nav class="navbar navbar-default navbar-static-top">
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

<main>

<section id="<?php echo $current_route ?>" class="container">
<?php require_once $current_page ?>
</section>

</main>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Bootstraop Javascript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- jQuery.fancybox -->
<script type="text/javascript" src="js/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="js/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="js/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="js/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
$(document).ready(function()
{
    $(".fancybox").fancybox();
    $(".fancy_vimeo").click(function() {
        $.fancybox({
            padding: 0,
            autoScale: false,
            transitionIn: 'none',
            transitionOut: 'none',
            title: this.title,
            width: 800,
            height: 500,
            href: 'http://player.vimeo.com/video/'+this.getAttribute("data-video-id")+"?autoplay=1",
            type: 'iframe'
        });
        return false;
    });
});
</script>
						
</body>
</html>
