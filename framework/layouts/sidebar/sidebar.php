<?php

    $header = $data['header'];
    $sidebar = $data['sidebar'];
    $main_panel = $data['main_panel'];

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

    <div class="content flex">
        <div class="sidebar">
            <?php
                foreach($sidebar as $item){
            ?>
            <div class="bloc">
                <h2><?php echo $item['title'] ?></h2>
                <ul>
                    <li></li>
                </ul>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="main-panel">
            <div class="bloc">
                <h2>Formation :</h2>
                <?php
                    foreach($data['formation'] as $item){
                        ?>
                        <ul class="dyn-content">
                            <li>
                                <span class="date"><?php echo $item['date']; ?> : </span>
                                <?php echo $item['title']; ?>
                            </li>
                            <li class="nb">(<?php echo $item['NB']; ?>)</li>
                            <li class="t-right"><?php echo $item['place']; ?></li>
                        </ul>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</page>