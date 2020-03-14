<?php
require 'init.php';
?>
<html dir="ltr" lang="br">

<!-- Head area -->
<?php Layout\Draw::component('main/Head') ?>

<body data-page="<?= Layout\Get::current_page() ?>">
    <main>
        <?php Http\Router::route(); ?>
    </main>
    <!-- Footer area -->
<?php Layout\Draw::component('main/Footer') ?>

</body>
</html>
