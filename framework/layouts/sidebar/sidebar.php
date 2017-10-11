<?php

    require_once 'framework/functions.php';

    $header = $data['header'];
    $sidebar = $data['sidebar'];
    $main_panel = $data['main_panel'];

?>

<page name="a4">
    <div class="content flex">
        <div class="sidebar flex-col">
            <?php
                foreach($sidebar as $item){
                ?>
                <div class="bloc">
                    <h2><?php echo $item['title']; ?></h2>
                    <?php
                        disp_item($item);
                    ?>
                </div>
                <?php
                }
            ?>
        </div>
        <div class="main-panel flex-col">
            <header class="flex-end">
                <?php
                    foreach($header as $item){
                    ?>
                    <div class="bloc">
                    <?php
                        disp_item($item);
                    ?>
                    </div>
                    <?php
                    }
                ?>
            </header>
            <?php
                foreach($main_panel as $item){
                ?>
                <div class="bloc">
                    <h2><?php echo $item['title']; ?></h2>
                    <?php
                        disp_item($item);
                    ?>
                </div>
                <?php
                }
            ?>
        </div>
    </div>
</page>