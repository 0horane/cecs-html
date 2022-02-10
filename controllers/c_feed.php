<?php
//$url = strpos($_SERVER['REQUEST_URI'], "?")===false ? $_SERVER['REQUEST_URI'] :  strstr($_SERVER['REQUEST_URI'],"?",true);
require_once 'assets/database.php';
$headertags='<link href="/css/feed.css" rel="stylesheet">';

if (isset($feedname)){
    $query="SELECT * FROM categories WHERE urlname = '${feedname}' AND parents & $allow = $allow";
    $result=qq($link, $query);
    if ($result->num_rows==1){
        $categoryassoc = $result->fetch_assoc();
        $category = 2**$categoryassoc['id'];
        $title=$categoryassoc['name'];
    } else {
        $_SESSION["msg"]="Esta secretaria/comison/club no se encontro (o se encontro mas de 1). Asegurese de que haya escrito bien el url  ".$query."   ".$feedname; 
        $_SESSION["icon"]="error";
        header('Location: /404');
        exit();
    }
}
if (isset($feedid)){
    $category = 2**$feedid;
    $query="SELECT * FROM categories WHERE id = ${feedid}";
    $categoryassoc = qq($link, $query)->fetch_assoc();
    $title=$categoryassoc['name'];
}

$cols=getcols($link);
$staticcategory = $category+2**2+$categoryassoc['parents'];
$notcategory = 2**2+2**5;
$votecategory = $category+2**4;    
$alertcategory = $category+2**5;
$query=$posts_data_query."WHERE textupdates.replaced_at IS NULL AND posts.category ";
$result=qq($link, $query."= ${staticcategory}");
$content = $result->fetch_assoc();    

function decodeRequiredHtml($array){
    $array['t_css']=htmlspecialchars_decode($array['t_css']);
    $array['t_content']=htmlspecialchars_decode($array['t_content']);
    return $array;
}

$alerts = array_map('decodeRequiredHtml',  entries($link, $query."& ${alertcategory} = ${alertcategory}"));
$votes  = array_map('decodeRequiredHtml',   entries($link, $query."& ${votecategory} = ${votecategory} AND posts.end_date > NOW()"));
$posts  = array_map('decodeRequiredHtml',   entries($link, $query."& ${notcategory} = 0 AND ( posts.end_date < NOW() OR posts.end_date IS NULL)"));

require_once 'assets/session_start.php';

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/feed.php';
include_once 'partials/footer.php';


