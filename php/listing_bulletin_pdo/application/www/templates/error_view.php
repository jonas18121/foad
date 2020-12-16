<?php ob_start(); ?>

<?php if ($errorMessage) : ?>
    <p> <?= $errorMessage ?> </p>
<?php endif ?>

<?php $content = ob_get_clean(); ?>

