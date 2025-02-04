<?php //Copyright (c) 2021 <info@phprouter.com> MIT licence

session_start();
function prdebug(){echo "<br><br><pre>";var_dump($_SESSION);echo "</pre><br><br><pre>";var_dump($_POST);}
function get($route, $path_to_include, $variables=[]){
  if( $_SERVER['REQUEST_METHOD'] == 'GET' ){ route($route, $path_to_include, $variables); }  
}
function post($route, $path_to_include, $variables=[]){
  if( $_SERVER['REQUEST_METHOD'] == 'POST' ){ route($route, $path_to_include, $variables); }    
}
function put($route, $path_to_include, $variables=[]){
  if( $_SERVER['REQUEST_METHOD'] == 'PUT' ){ route($route, $path_to_include, $variables); }    
}
function patch($route, $path_to_include, $variables=[]){
  if( $_SERVER['REQUEST_METHOD'] == 'PATCH' ){ route($route, $path_to_include, $variables); }    
}
function delete($route, $path_to_include, $variables=[]){
  if( $_SERVER['REQUEST_METHOD'] == 'DELETE' ){ route($route, $path_to_include, $variables); }    
}
function any($route, $path_to_include, $variables=[]){ route($route, $path_to_include, $variables); }
function route($route, $path_to_include, $variables=[]){
  $ROOT = $_SERVER['DOCUMENT_ROOT'];
  if($route == "/404"){
    include_once("$ROOT/$path_to_include");
    if (debug){prdebug();}
    exit();
  }  
  $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
  $request_url = rtrim($request_url, '/');
  $request_url = strtok($request_url, '?');
  $route_parts = explode('/', $route);
  $request_url_parts = explode('/', $request_url);
  array_shift($route_parts);
  array_shift($request_url_parts);
  foreach($variables as $varname=>$varval){
    $$varname=$varval;
  }
  if( $route_parts[0] == '' && count($request_url_parts) == 0 ){
    include_once("$ROOT/$path_to_include");
    if (debug){prdebug();}
    exit();
  }
  if( count($route_parts) != count($request_url_parts) ){ return; }  
  $parameters = [];
  for( $__i__ = 0; $__i__ < count($route_parts); $__i__++ ){
    $route_part = $route_parts[$__i__];
    if( preg_match("/^[$]/", $route_part) ){
      $route_part = ltrim($route_part, '$');
      array_push($parameters, $request_url_parts[$__i__]);
      $$route_part=$request_url_parts[$__i__];
    }
    else if( $route_parts[$__i__] != $request_url_parts[$__i__] ){
      return;
    } 
  }
  include_once("$ROOT/$path_to_include");
  if (debug){prdebug();}
  exit();
}
function out($text){echo htmlspecialchars($text);}
function set_csrf(){
  if( ! isset($_SESSION["csrf"]) ){ $_SESSION["csrf"] = bin2hex(random_bytes(50)); }
  echo '<input type="hidden" name="csrf" value="'.$_SESSION["csrf"].'">';
}
function is_csrf_valid(){
  if( ! isset($_SESSION['csrf']) || ! isset($_POST['csrf'])){ return false; }
  if( $_SESSION['csrf'] != $_POST['csrf']){ return false; }
  return true;
  
}
