<?php


//  pre_var_dump('l 47 update_eleve.php', $one_devoir );
?>

<?php ob_start() ?>
<div id="container">

    <h2>Affiché un devoir</h2>
    
    <div>
        <p>titre                 : <?= $one_devoir->getTitre() ?> </p>
        <p>contenu               : <?= $one_devoir->getContenu() ?> </p>
        <p>date de publication   : <?= $one_devoir->getDate_publication()->format('d/m/Y')  ?> </p>
    </div>
    <form action="" method="post">
        
        <div>
            <label for="note">Choisir note d'un élève</label>
            <select name="note" id="">
                <?php for ($i = 0; $i <= 20 ; $i++) : ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
    
            <label for="id_eleve">Choisir un élève</label>
            <select name="id_eleve" id="">
                <?php foreach ($all_eleves as  $one_eleve) : ?>
                    <option value="<?= $one_eleve->getId() ?>"><?= $one_eleve->getPrenom() . ' ' . $one_eleve->getNom() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <input type="hidden" name="id_devoir" value="<?= $one_devoir->getId() ?>">
        </div>

        <div>
            <input type="submit" value="Noter l'élève">
        </div>
    </form>
    
    <h2>Modifier le devoir</h2>

    <div id="error"><span></span></div>

    <form action="" method="post" id="form_add_devoir">
        <div>
            <div>
                <label for="titre">Titre : </label>
            </div>
            <input type="text" name="titre" id="titre" value="<?= $one_devoir->getTitre() ?>">
        </div>
        <div>
            <div>
                <label for="contenu">Contenu : </label>
            </div>
            <textarea name="contenu" id="contenu" cols="30" rows="10"><?= $one_devoir->getContenu() ?></textarea>
        </div>
        
        <div>
            <input type="hidden" name="id" value="<?= $one_devoir->getId() ?>">
        </div>
    
        <div>
            <input type="submit" value="Modifier">
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require_once 'www/layout/layout_view.php'; ?>