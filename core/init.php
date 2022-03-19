<!--FileName: init.php
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 
-->

<!-- code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content-->


<?php

session_start();
include 'database/connection.php';
include 'classes/user.php';
include 'classes/tweet.php';
include 'classes/follow.php';

//declaring $pdo in database file global
global $pdo;

//passing data base connectioin by making objects
$getFromU = new User($pdo);
$getFromT = new Tweet($pdo);
$getFromF = new Follow($pdo);


//defining file url once so that we can just use the constant instead of writing whole url
define("BASE_URL", "http://localhost/twitter/");
?>