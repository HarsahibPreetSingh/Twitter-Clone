<!--FileName: follow.php(ajax)
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 
-->


<!-- code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content-->

<?php

include '../init.php';


// if unfollow button is set then pass all the id's through unfollow function
if (isset($_POST['unfollow']) && !empty($_POST['unfollow'])) {
  $user_id = $_SESSION['user_id'];
  $followID = $_POST['unfollow'];
  $profileID = $_POST['profile'];
  $getFromF->unfollow($followID, $user_id, $profileID);
}

// if follow button is set then pass all the id's through follow function
if (isset($_POST['follow']) && !empty($_POST['follow'])) {
  $user_id = $_SESSION['user_id'];
  $followID = $_POST['follow'];
  $profileID = $_POST['profile'];
  $getFromF->follow($followID, $user_id, $profileID);
}

?>

