<?php

$userdata= authenticate($link, true);
$userid=$userdata[0];
$userperms=$userdata[1];

assertExitCode( !isset($_POST['id']) || !isset($_POST['vote']), "400 Bad Request");
$query="SELECT * FROM posts WHERE id = ${_POST['id']}";
$votepostobj=qq($link, $query);
$votepost=$votepostobj->fetch_assoc();
assertExitCode( !($votepostobj->num_rows==1) || ( ($votepost['category'] & 16 ) == 0 ), "400 Bad Request");

assertExitCode( new dateTime($votepost['end_date']) < new dateTime(), "403 Forbidden");


$hasvoted=qq($link, "SELECT * FROM votescast WHERE post_id = ${_POST['id']} AND user_id = ${_SESSION['id']}")->num_rows;
assertExitCode( $hasvoted, "403 Forbidden");

$query="INSERT INTO votescast VALUES (${_SESSION['id']}, ${_POST['id']})";
qq($link, $query);
$query="INSERT INTO votesresults VALUES (null, ${_POST['id']}, ${_POST['vote']})";
qq($link, $query);

echo 1;