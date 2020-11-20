<?php

require_once '../tools/tools.php';
require_once '../config/Database.php';
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
<h1>Ajouter un élève</h1>
<form action="" method="post">
    <div>
        <input type="text" name="nom" placeholder="Nom de l'élève">
    </div>
    <div>
        <input type="text" name="prenom" placeholder="Prénom de l'élève">
    </div>
    <div>
        <input type="date" name="date_naissance" placeholder="Date de naissance de l'élève">
    </div>
    <div>
        <input type="text" name="moyenne" placeholder="Moyenne de l'élève">
    </div>
    <div>
        <textarea name="appreciation" id="" cols="30" rows="10" placeholder=" Commentaire sur l'élève"></textarea>
    </div>

    <div>
        <input type="submit" value="Envoyer">
    </div>
</form>