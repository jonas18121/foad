<?php

//  pre_var_dump($_POST, null, true);

?>
<?php ob_start() ?>

    <div id="container">
        <h1>Ajouter un devoir</h1>

        <div id="error"><span></span></div>

        <form action="" method="post" id="form_add_devoir">
            <div>
                <input type="text" name="titre" id="titre" placeholder="Titre du devoir" required>
            </div>
            
            <div>
                <textarea name="contenu" id="contenu" cols="30" rows="10"  placeholder="Contenu du devoir" required></textarea>
            </div>

            <div>
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require_once 'www/layout/layout_view.php'; ?>