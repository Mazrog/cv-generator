<?php

    $header = $data['header'];

?>

<page name="a4">
    <header class="flex-col">
        <div class="title">
            <?php echo $header['last_name'] ?> <span class="text-caps"><?php echo $header['first_name'] ?></span>
        </div>
        <div><?php echo $header['role'] ?></div>
        <div><?php echo $header['info'] ?></div>
    </header>
    <div class="bar"></div>
</page>