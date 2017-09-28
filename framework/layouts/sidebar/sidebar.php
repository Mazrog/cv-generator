<?php

    $header = $data['header'];
    $sidebar = $data['sidebar'];
    $main_panel = $data['main_panel'];

    function make_chart($type, $nb){
        switch($type){
            case 'star':
            default: $code = '&#9733;';
        }
        return str_repeat($code, $nb);
    }

    function disp_q_list($item){
        echo "<table>";
        foreach($item['values'] as $val){
            $ct = "";
            echo "<tr>";
            $ct .= "<td class='${item['t-class']}'>${val['title']}</td>";

            $lvl = make_chart($item['q-type'], $val['lvl']);
            $ct .= "<td>${lvl}</td>";
            echo "${ct}\n</tr>";
        }
        echo "</table>";
    }

    function disp_block_list($item){
        echo "<ul>";
        foreach($item['values'] as $val){
            echo "<li>";
            $tmp = array(
                "<div class='flex-between'>",
                "<span class='${item['t-class']}'>${val['title']}</span>",
                "<span class='${item['d-class']}'>${val['date']}</span>",
                "</div>"
            );

            if(isset($val['text'])){ array_push($tmp, "<div>${val['text']}</div>"); }
            if(isset($val['NB'])){ array_push($tmp, "<div class='NB'>${val['NB']}</div>"); }
            if(isset($val['place'])){ array_push($tmp, "<div class='place'>${val['place']}</div>"); }
            if(isset($val['technos'])){
                $tmp_str = array();
                foreach($val['technos'] as $techno){
                    array_push($tmp_str, $techno);
                }
                array_push($tmp, "<div class='technos'>(". join(', ', $tmp_str) .")</div>");
            }

            $ct = join('', $tmp);

            echo "${ct}\n</li>";
        }
        echo "</ul>";
    }

    function disp_list($item){
        $type = explode("-", $item['type']);
        echo "<ul>";
        foreach($item['values'] as $val){
            $ct = "";
            echo "<li>";
            if(in_array('icon', $type)){
                $ct = "<div class='icon'>";
                if(!is_null($val['icon'])){
                    $ct .= ("<img src='${val['icon']}'/>");
                }
                $ct .= "</div>";
            }
            if(in_array('link', $type)){
                $ct .= "<a href='${val['href']}' target='_blank'>";
                $ct .= "<span class='${item['t-class']}'>${val['title']}</span> ";
                $ct .= "<span class='${item['d-class']}'>${val['desc']}</span>";
                $ct .= "</a>";
            } else {
                $ct .= "<span class='${item['t-class']}'>${val['title']}</span> ";
                $ct .= "<span class='${item['d-class']}'>${val['desc']}</span>";
            }

            echo "${ct}\n</li>";
        }
        echo "</ul>";
    }

    function disp_item($item){
        switch($item['type']){
            case 'q-list': disp_q_list($item);
                break;
            case 'block-list': disp_block_list($item);
                break;
            default: disp_list($item);
                break;
        }
    }

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
                    <h2><?php echo $item['title']; ?></h2>
                    <?php
                        disp_item($item);
                    ?>
                </div>
                <?php
                }
            ?>
        </div>
        <div class="main-panel">
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