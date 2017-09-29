<?php

    require_once 'framework/functions.php';

    $header = $data['header'];
    $sidebar = $data['sidebar'];
    $main_panel = $data['main_panel'];

?>

<page name="a4">
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
    <div class="bar"></div>

    <div class="content flex">
        <div class="sidebar flex-col-between">
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