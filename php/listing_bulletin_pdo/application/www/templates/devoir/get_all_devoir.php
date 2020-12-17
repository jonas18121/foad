<?php ob_start() ?>
<div id="">

    <h2>Gestion des devoirs</h2>
    <a href="devoir/controleur_create_devoir">Ajouter un devoir</a>

    <table class='table'>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date </th>
                <th>Afficher et Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class='tbody'>
            <?php for($i=0; $i<count($all_devoirs); $i++) : ?>
                <?php //pre_var_dump($all_eleves[$i], null); ?>
                <tr>
                    <td><?= $all_devoirs[$i]->getTitre() ?></td>
                    <td><?= $all_devoirs[$i]->getContenu() ?></td>
                    <td><?= $all_devoirs[$i]->getDate_publication()->format('d/m/Y') ?></td>
                
                    <td><a href="devoir/controleur_update_devoir/<?= $all_devoirs[$i]->getId() ?>">Afficher et Modifier</a></td>
                    <td>
                        <form action="devoir/controleur_delete_devoir" method="post">
                            <div>
                                <input type="hidden" name="delete" value="<?= $all_devoirs[$i]->getId() ?>">
                            </div>

                            <div>
                                <input type="submit" value="Supprimer">
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>

</div>
<?php $content = ob_get_clean(); ?>
<?php require_once 'www/layout/layout_view.php'; ?>