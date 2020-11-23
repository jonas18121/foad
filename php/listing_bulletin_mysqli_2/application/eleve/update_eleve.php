<?php

require_once '../tools/tools.php';
require_once '../config/Database.php';
require_once '../Entity/Eleve.php';
require_once '../Model/EleveModel.php';

$bdd = new Database();
$bdd = $bdd->connect_bdd(); 

$eleve_model = new EleveModel();
$id = (int) $_GET['id_eleve'];

// selectionner un eleve
$one_eleve = $eleve_model->get_one_eleve($id);

// modifier un eleve
if ($_POST) {
    if (isset($_POST['nom']) && !empty($_POST['nom'])) {
        if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
            if (isset($_POST['date_naissance']) && !empty($_POST['date_naissance'])) {
                if (isset($_POST['moyenne']) && !empty($_POST['moyenne'])) {
                    if (isset($_POST['appreciation']) && !empty($_POST['appreciation'])) {
                        if (isset($_POST['id']) && !empty($_POST['id'])) { 
                        
                            $id             = (int) addslashes(trim(strip_tags($_POST['id'])));
                            $nom            = addslashes(trim(strip_tags($_POST['nom'])));
                            $prenom         = addslashes(trim(strip_tags($_POST['prenom'])));
                            $date_naissance = addslashes(trim(strip_tags($_POST['date_naissance'])));
                            $moyenne        = addslashes(trim(strip_tags($_POST['moyenne'])));
                            $appreciation   = addslashes(trim(strip_tags($_POST['appreciation'])));
                            
                            $eleve_model->update_eleve($nom, $prenom, $date_naissance, $moyenne, $appreciation, $id);

                            header_location('../index.php');
                         }

                    }
                }
            }
        }
    } 
}

?>
<h1>Modifier un élève</h1>
<form action="" method="post">
    <div>
        <div>
            <label for="nom">nom : </label>
        </div>
        <input type="text" name="nom" value="<?= $one_eleve->getNom() ?>">
    </div>
    <div>
        <div>
            <label for="prenom">prenom : </label>
        </div>
        <input type="text" name="prenom" value="<?= $one_eleve->getPrenom() ?>">
    </div>
    <div>
        <div>
            <label for="date_naissance">date de naissance (réécrire la date) : </label>
        </div>
        <input type="date" name="date_naissance" value="<?= $one_eleve->getDate_naissance()->format('d/m/Y') ?>">
        <span><?= $one_eleve->getDate_naissance()->format('d/m/Y') ?></span>
    </div>
    <div>
        <div>
            <label for="moyenne">moyenne : </label>
        </div>
        <input type="text" name="moyenne" value="<?= $one_eleve->getMoyenne() ?>">
    </div>
    <div>
        <div>
            <label for="appreciation">appreciation : </label>
        </div>
        <textarea name="appreciation" id="" cols="30" rows="10" ><?= $one_eleve->getAppreciation() ?></textarea>
    </div>
    <div>
        <input type="hidden" name="id" value="<?= $one_eleve->getId() ?>">
    </div>

    <div>
        <input type="submit" value="Modifier">
    </div>
</form>