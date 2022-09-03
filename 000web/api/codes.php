<?php
use BCMathExtended\BC;
//Creates a new code and corresponding user. 
//Inputs: name: new user name
//        perms: a json list of all permissions
//Reurns: 1 if success. 
//
//TODO: make it return a json of the new code as so to not have to refresh the codes page.


$userdata= authenticate(true);
$userid=$userdata[0];
$userperms=$userdata[1];

assertExitCode( BC::comp(BC::bitAnd($userperms , 1024 ) , 0) , "403 Forbidden");


if (isset($_POST['id'])){
  if (isset($_POST['delete'])){
    $query= "DELETE FROM users WHERE id = ${_POST['id']} AND password IS NULL";
    $result=qq($query, "500 Internal Server Error");
    assertExitCode( !$result , "400 Bad Request");

    echo $_POST['id'];
  } else {
    assertExitCode( !(isset($_POST['perms']) && isset($_POST['name'])), "400 Bad Request");

    $oldrowobj = $link->query("SELECT * FROM users WHERE id = ${_POST['id']} AND password IS NULL");
    assertExitCode( !$oldrowobj || !$oldrowobj->num_rows, "400 Bad Request");
    $oldrow=$oldrowobj->fetch_assoc();
    $changedperms=  BC::bitXor( $_POST['perms'], $oldrow['perms']);
    assertExitCode( !( BC::comp( BC::bitAnd($userperms, $changedperms), $changedperms)), "403 Forbidden");

    $query= "UPDATE users SET name = '${_POST['name']}' , perms = ${_POST['perms']} WHERE id = ${_POST['id']} AND password IS NULL";
    qq($query, "500 Internal Server Error");
    echo $_POST['id'];
  }

} else {
  $globalPerms=entries( "SELECT * FROM categories", false, "id", "500 Internal Server Error");
    
  $submittedPerms='0'; //this one verifies if the user has all the required categories

  foreach ($_POST['perms'] as $category){
    $submittedPerms = BC::bitOr($submittedPerms, BC::pow('2'**$category));   
  }

  assertExitCode(!(BC::comp($submittedPerms == BC::bitAnd($userperms, $submittedPerms))), "403 Forbidden");
  assertExitCode(!(isset($_POST['name']) && $_POST['name']!=""), "400 Bad Request");

  $code= substr(md5(rand()),0,8);
  while (qq("SELECT code FROM users WHERE code = '${code}'", "500 Internal Server Error")->num_rows !=0){
    $code=substr(md5(rand()),0,8);
  }

  $query="INSERT INTO users VALUES(null, '${_POST['name']}', null, "+intval($submittedPerms)+", null, null, null, null, NOW(), '${code}')";
  $result=qq($query, "500 Internal Server Error");
  echo true;

}
