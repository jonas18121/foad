<?php ob_start() ?>
<div id="">

    <!-- <a href="index.php?controleur=devoir&action=controleur_create_devoir">Ajouter un devoir</a> -->

    <h2>Notes de chaque élèves par devoirs</h2>
    <table class='table'>
        <thead>
            <tr>
                <th>Titre du devoir</th>
                <th>Contenu du devoir</th>
                <th>Nom élève </th>
                <th>Prénom élève</th>
                <th>Note élève</th>
            </tr>
        </thead>
        <tbody class='tbody'>
            <?php for($i=0; $i<count($all_devoir_eleves); $i++) : ?>
                <?php //pre_var_dump($all_devoir_eleves[$i], null); ?>
                <tr>
                    <td><?= $all_devoir_eleves[$i]->{'titre'} ?></td>
                    <td><?= $all_devoir_eleves[$i]->{'contenu'} ?></td>
                    <td><?= $all_devoir_eleves[$i]->{'nom'} ?></td>
                    <td><?= $all_devoir_eleves[$i]->{'prenom'} ?></td>
                    <td><?= $all_devoir_eleves[$i]->getNote() ?></td>
                
                    <!-- <td><a href="index.php?controleur=devoir&action=controleur_update_devoir&id_devoir=<?//= $all_devoirs[$i]->getId() ?>">Afficher et Modifier</a></td>
                    <td>
                        <form action="index.php?controleur=devoir&action=controleur_delete_devoir" method="post">
                            <div>
                                <input type="hidden" name="delete" value="<?//= $all_devoirs[$i]->getId() ?>">
                            </div>

                            <div>
                                <input type="submit" value="Supprimer">
                            </div>
                        </form>
                    </td> -->
                </tr>
            <?php endfor ?>
        </tbody>
    </table>

</div>
<?php $content = ob_get_clean(); ?>
<?php require_once 'www/layout/layout_view.php'; ?>