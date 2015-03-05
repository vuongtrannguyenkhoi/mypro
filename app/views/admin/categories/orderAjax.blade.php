<?php


echo renderTree( $categories );

function renderTree($tree, $currDepth = -1) {
    $currNode = (array)array_shift($tree);
    $result = '';
    // Going down?
    if ($currNode['depth'] > $currDepth) {
        // Yes, prepend <ol>
        $result .= $currDepth == -1 ? '<ol class="sortable">': '<ol>';
    }
    // Going up?
    if ($currNode['depth'] < $currDepth) {
        // Yes, close n open <ol>
        $result .= str_repeat('</ol>', $currDepth - $currNode['depth']);
    }
    // Always add the node
    $result .= '<li id="list_'.$currNode['id'].'"">';
    $result.= '<div>'.$currNode['name'].'</div>';

    // Anything left?
    if (!empty($tree)) {
        // Yes, recurse
        $result .=  renderTree($tree, $currNode['depth']);
    }
    else {
        // No, close remaining <ol>
        $result.='</li>';
        $result .= str_repeat('</ol>', $currNode['depth'] + 1);
    }
    return $result;
}
?>
<script>
    $(document).ready(function(){

        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            maxLevels: 3
        });

    });
</script>
