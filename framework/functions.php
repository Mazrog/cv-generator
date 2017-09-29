<?php

function make_chart($options, $val){
    $nb = $val['lvl'];
    switch($options['type']){
        case 'bar':
            $percent = ($nb / $options['lvl_max']) * 100;
            $background_color = (isset($val['color'])) ? $val['color'] : "red";
            $code = join('', array(
                "<div class='q-bar' style='width: ${options['lvl_max']}em'>",
                "<div class='q-fill' style='width: ${percent}%; background-color: ${background_color}'></div>",
                "</div>"
            ));
            break;
        case 'star':
        default: $code = str_repeat('&#9733;', $nb);
    }
    return $code;
}

function disp_q_list($item){
    echo "<table>";
    foreach($item['values'] as $val){
        $ct = "";
        echo "<tr>";
        $ct .= "<td class='${item['t-class']}'>${val['title']}</td>";

        $lvl = make_chart($item['q-options'], $val);
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
            "&nbsp;",
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
            $ct .= join('', array(
                "<a href='${val['href']}' target='_blank'>",
                "<span class='${item['t-class']}'>${val['title']}</span> ",
                "<span class='${item['d-class']}'>${val['desc']}</span>",
                "</a>"
            ));
        } else {
            $ct .= "<span class='${item['t-class']}'>${val['title']}</span> ";
            $ct .= "<span class='${item['d-class']}'>${val['desc']}</span>";
        }

        echo "${ct}\n</li>";
    }
    echo "</ul>";
}

/* Parent function for the bloc display */
/* Takes a standard item and call proper function */
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