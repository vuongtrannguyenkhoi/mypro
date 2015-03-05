<?php

if (!function_exists('dump')) {
    /**
     * @param $var
     * @param string $label
     * @param bool $echo
     * @return mixed|string
     */
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}

global $slug;
global $controller;
function renderTreeMenu($tree, $prev_node_depth = -1) {
    global $slug;
    global $controller;
    $currNode = (array)array_shift($tree);
    $active = Request::segment(2) == $currNode['slug'] ? true: false;
    $next_node = isset($tree[0]) ? (array)$tree[0]: null;
    $result = ''. PHP_EOL;
    // Going down?
    if ($currNode['depth'] > $prev_node_depth) {
        // Yes, prepend <ul>
        $result .= $prev_node_depth == -1 ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
    }else{

    }
    // Going up?
    if ($currNode['depth'] < $prev_node_depth) {
        // Yes, close n open <ul>
        $result .= str_repeat('</ul>' . PHP_EOL, $prev_node_depth - $currNode['depth']);

        //check the next li has class dropdown or dropdown-menu
        $dropdown = true;
    }else{
        $dropdown = false;
    }
    // Always add the node
    if ($next_node['depth']=='' || $next_node['depth']==$currNode['depth']) {

        $result .= $active ? '<li class="active">'. PHP_EOL : '<li>'. PHP_EOL;
    }else{
        if (($currNode['depth']!=1 && isset( $next_node['depth']) && $currNode['depth'] < $next_node['depth'])) {
            $result .= '<li class="dropdown-submenu">'. PHP_EOL;
        }else{
            $result .= $active ? '<li class="dropdown active">'. PHP_EOL : '<li class="dropdown">'. PHP_EOL;
        }
    }
    if ($currNode['depth'] == 1) {
        $slug = e($currNode['slug']);
        $controller = e($currNode['controller']);
    }

    $result.= '<a target="'.$currNode['target'].'" href="';
    $result .=url().'/';
    if($currNode['depth']==1){
            if($currNode['controller']){
        $result .="{$currNode['controller']}/";//avoid duplicating category name in url li product/product when we go depth inside subcategory
        $result.=e($currNode['slug']);//link;
        }else{
        $result .='#';
        }
    }else
        $result .="{$controller}/{$slug}/{$currNode['slug']}";


    $result .='"';
    if(!$currNode['controller']){
        $result .='class="dropdown-toggle" data-toggle="dropdown" role="button"';
    }
    $result .= '>';
    $result .= $currNode['name'];
    $result.='</a>'
        . PHP_EOL;

    // Anything left?
    if (!empty($tree)) {
        // Yes, recourse

        $result .=  renderTreeMenu($tree, $currNode['depth']);
    }
    else {
        // No, close remaining <ul>
        $result.='</li>' . PHP_EOL;
        $result .= str_repeat('</ul>'. PHP_EOL, $currNode['depth'] + 1);
    }
    return $result;
}

function human_filesize($bytes, $decimals = 2) {
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}