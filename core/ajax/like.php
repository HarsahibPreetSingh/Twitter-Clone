<!--FileName: like.php(ajax)
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 
-->

<!--code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content-->

<?php
	include '../init.php'; 

// this is the ajax file attached to like.js by Julia Embrett
    if(isset($_POST['like']) && !empty($_POST['like'])){
    	$user_id  = $_SESSION['user_id'];
    	$tweet_id = $_POST['like'];
    	$get_id   = $_POST['user_id'];
    	$getFromT->addLike($user_id, $tweet_id, $get_id);
    }

    if(isset($_POST['unlike']) && !empty($_POST['unlike'])){
    	$user_id  = $_SESSION['user_id'];
    	$tweet_id = $_POST['unlike'];
    	$get_id   = $_POST['user_id'];
    	$getFromT->unLike($user_id, $tweet_id, $get_id);
    }

     


?>