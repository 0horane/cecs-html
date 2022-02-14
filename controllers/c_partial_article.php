<?php


$category = gmp_init($content["p_category"]) & 0b111100;
$title=$content['p_title'];
$margins=0;
$redback=0;
$showauthor=0;
$articleborder=0;
$dates=1;
$canedit   = $loggedin && ((gmp_init($_SESSION['perms']) & gmp_init($content['p_category'])) != 0) ;
$isdeleted = (gmp_init($content['p_category']) & 512) != 0;
$isreplaced = $content['t_replaced_at'];
$restore=0;
$viewhist=1;

$content['t_content']=htmlspecialchars_decode($content['t_content']);
$content['t_css']=htmlspecialchars_decode($content['t_css']);

if ($displayas=="fullpage"){
    switch ($category){
        case 4:  //estatico
            $title=0;
            $dates=0;
            break;
        case 8: //post
            $margins=1;
            break;
        case 16: //voto
            $margins=1;
            break;
        case 32: //alerta
            $margins=1;
            $redback=1;
            $articleborder=1;
            break;
    }
} else if ($displayas=="infeed") {
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            break;
    }
} else if ($displayas=="inhist") {
    $showauthor=1;
    $margins=1;
    $articleborder=1;
    $restore=$canedit;
    $canedit=0;
    $viewhist=0;
    
    switch ($category){
        case 4: //post
            break;
        case 8: //post
            break;
        case 16: //voto
            break;
        case 32: //alerta
            $redback=1;
            break;
    }
}

include 'partials/post.php';


