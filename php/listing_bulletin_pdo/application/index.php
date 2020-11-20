<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/Database.php';
require_once 'tools/tools.php';
require_once 'Entity/Eleve.php';
require_once 'Model/EleveModel.php';

$eleve_model = new EleveModel();

$all_eleves     = $eleve_model->get_all_eleve();
$count_eleve    = $eleve_model->count_nb_eleve();
$moyenne_classe = $eleve_model->calc_classe_sum();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet/less" type="text/css" href="css/styles.less" />
    <script src="librairie/less.js"></script>
    <script src="librairie/jquery-3.5.1.min.js"></script>
    <script src="librairie/jquery.validate.min.js" ></script>
    <script src="js/jq_validation.js" async></script>
</head>
<body>
    <div>
        <a href="eleve/create_eleve.php">Ajouter un élève</a>

        <table class='table'>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Moyenne</th>
                    <th>Appréciation</th>
                    <th>Afficher et Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody class='tbody'>
                <?php for($i=0; $i<count($all_eleves); $i++) : ?>
                    <?php //pre_var_dump($all_eleves[$i], null); ?>
                    <tr>
                        <td><?= $all_eleves[$i]->getNom() ?></td>
                        <td><?= $all_eleves[$i]->getPrenom() ?></td>
                        <td><?= $all_eleves[$i]->getDate_naissance()->format('d/m/Y') ?></td>
                        <td><?= $all_eleves[$i]->getMoyenne() ?></td>
                        <td><?= $all_eleves[$i]->getAppreciation() ?></td>
                        <td><a href="eleve/update_eleve.php?id_eleve=<?= $all_eleves[$i]->getId() ?>">Afficher et Modifier</a></td>
                        <td>
                            <form action="eleve/delete_eleve.php?" method="post">
                                <div>
                                    <input type="hidden" name="delete" value="<?= $all_eleves[$i]->getId() ?>">
                                </div>

                                <div>
                                    <input type="submit" value="Supprimer">
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endfor ?>
            </tbody>
            <tfoot>
                <td colspan="3">nombres d'élèves : <?= $count_eleve->{"nb_eleve"}  ?></td>
                <td> <?= $moyenne_classe->{"moyenne_classe"} . ' / 20' ?></td>
            </tfoot>
        </table>
    </div>
</body>
</html>
