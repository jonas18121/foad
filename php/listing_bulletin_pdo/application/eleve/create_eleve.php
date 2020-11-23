<?php

require_once '../tools/tools.php';
require_once '../config/Database.php';
require_once '../Model/Model.php';
require_once '../Model/EleveModel.php';

$bdd = new Database();
$bdd = $bdd->connect_bdd();

$eleve_model = new EleveModel();

// ajouter un eleve
if ($_POST) {
    if (isset($_POST['nom']) && !empty($_POST['nom'])) {
        if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
            if (isset($_POST['date_naissance']) && !empty($_POST['date_naissance'])) {
                if (isset($_POST['moyenne']) && !empty($_POST['moyenne'])) {
                    if (isset($_POST['appreciation']) && !empty($_POST['appreciation'])) {
                        
                        $id             = null;
                        $nom            = addslashes(trim(strip_tags($_POST['nom'])));
                        $prenom         = addslashes(trim(strip_tags($_POST['prenom'])));
                        $date_naissance = addslashes(trim(strip_tags($_POST['date_naissance'])));
                        $moyenne        = addslashes(trim(strip_tags($_POST['moyenne'])));
                        $appreciation   = addslashes(trim(strip_tags($_POST['appreciation'])));

                        $eleve_model->add_eleve($id, $nom, $prenom, $date_naissance, $moyenne, $appreciation);

                        header_location('../index.php');
                    }
                }
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet/less" type="text/css" href="../css/styles.less" />
    <script src="../librairie/less.js"></script>
    <script src="../librairie/jquery-3.5.1.min.js"></script>
    <script src="../librairie/jquery.validate.min.js" ></script>
    <script src="../js/jq_validation.js" async></script>
</head>
<body>
    <div id="container">
        <h1>Ajouter un élève</h1>

        <div id="error"><span></span></div>

        <form action="" method="post" id="form_add_eleve">
            <div>
                <input type="text" name="nom" id="nom" placeholder="Nom de l'élève" required>
            </div>
            <div>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom de l'élève" required>
            </div>
            <div>
                <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance de l'élève" required>
            </div>
            <div>
                <input type="text" name="moyenne" id="moyenne" placeholder="Moyenne de l'élève" required>
            </div>
            <div>
                <textarea name="appreciation" id="appreciation" cols="30" rows="10" placeholder=" Commentaire sur l'élève" required></textarea>
            </div>

            <div>
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</body>
</html>
