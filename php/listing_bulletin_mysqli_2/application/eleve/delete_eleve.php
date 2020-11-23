<?php

require_once '../tools/tools.php';
require_once '../config/Database.php';
require_once '../Model/EleveModel.php';

$bdd = new Database();
$bdd = $bdd->connect_bdd(); 

$eleve_model = new EleveModel();

if ($_POST) {
    if (isset($_POST['delete']) && !empty($_POST['delete']) && ctype_digit($_POST['delete'])&& $_POST['delete'] > 0) {

        $id = (int) strip_tags(trim($_POST['delete']));

        $eleve_model->delete_eleve($id);

        header_location('../index.php');

    }else{
        // $erreur[] = 'erreur lors de la suppréssion';
        echo 'erreur lors de la suppréssion';
    }
}