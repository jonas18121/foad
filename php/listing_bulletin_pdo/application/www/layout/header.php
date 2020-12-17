<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://127.0.0.1:8888/afpa_developpement/foad_afpa/php/listing_bulletin_pdo/application/">
    <link rel="stylesheet/less" type="text/css" href="www/css/styles.less"/>
    <link rel="stylesheet" type="text/css" href="www/css/normalize.css"/>
    
    <script type="text/javascript" src="librairie/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="librairie/less.js"></script>
    <script type="text/javascript" src="librairie/jquery.validate.min.js"></script>
    <script type="text/javascript" src="www/js/jq_validation.js"></script>

</head>
<body>
    <header>
        <nav>
            <ul> <!-- "index.php?controleur=eleve&action=controleur_get_all_eleve" -->
                <li><a href="eleve/controleur_get_all_eleve"> Accueil</a></li>
                <li><a href="devoir/controleur_get_all_devoir"> Gestion devoir</a></li>
                <li><a href="devoirEleve/controleur_get_all_devoir_eleve">Notes des élèves/devoirs</a></li>
            </ul>
        </nav>
    </header>

    