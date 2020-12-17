<?php ob_start() ?>

    <div>
        <h2>Gestion des élèves</h2>
        <a href="eleve/controleur_create_eleve">Ajouter un élève</a>

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
                        <td><a href="eleve/controleur_update_eleve/<?= $all_eleves[$i]->getId() ?>">Afficher et Modifier</a></td>
                        <td>
                            <form action="index.php?controleur=eleve&action=controleur_delete_eleve" method="post">
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
                <td colspan="3">nombres d'élèves : <?= $count_eleve->get_nb_eleve()  ?></td>
                <td> <?= $moyenne_classe->get_moyenne_classe() . ' / 20' ?></td>
            </tfoot>
        </table>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require_once 'www/layout/layout_view.php'; ?>
