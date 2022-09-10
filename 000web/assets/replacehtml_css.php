<?php
if (!isset($replacecss)){
  $replacecss=function ($matches){
      if (strtoupper($matches[1])=="DEFAULT"){
          return <<<EOF
.center{ text-align: center; } .articlebody{ max-width: max(70vw, min(90%,350px)); font-family: Arial, Helvetica, sans-serif; margin:2rem 5vw; } h1{ font-size: 2.6em; } h2{ font-size: 2.3em; } h3{ font-size: 2em; } h4{ font-size: 1.6em; } h5{ font-size: 1.3em; } h6{ font-size: 1em; } h1, h2, h3, h4, h5, h6{ font-weight:bold; }
EOF;
      } else if (ctype_digit($matches[1])){
          $query="SELECT css FROM textupdates WHERE id = ${matches[1]}";
          if ($fcss=qq($query)->fetch_assoc() ){
              return $fcss['css'];
          } 
      } 
      
      return "";
  };
  $replacehtml=function ($matches){
      if (ctype_digit($matches[1])){
          $query="SELECT content FROM textupdates WHERE id = ${matches[1]}";
          if ($fcss=qq($query)->fetch_assoc() ){
              return $fcss['content'];
          } 
      }
      return "";
  };
}
