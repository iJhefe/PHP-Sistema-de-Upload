<?php
require 'init.php';
?>
<html dir="ltr" lang="br">

<!-- Head area -->
<?php Layout\Draw::component('main/Head') ?>

<noscript>
    <h3>Você precisa ter JavaScript ativo para usar o site.</h3>
</noscript>

<body data-page="<?= Layout\Get::current_page() ?>">
    <main>
        <?php Http\Router::route(); ?>
    </main>
    <!-- Footer area -->
<?php Layout\Draw::component('main/Footer') ?>

    <?= Layout\Draw::static_url('main', 'js', true) ?>

</body>
</html>
