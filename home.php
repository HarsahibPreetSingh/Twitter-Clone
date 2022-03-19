<!--FileName: home.php
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 
-->

<!-- code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content andd html is also retrieved from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content-->



<?php

include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData($user_id);

// we are retrieving the username and full anme from users table to add it into the tweets table so, that we can search the tweets by the useranme and full name of the user
if(isset($_SESSION['username']) && isset($_SESSION['fullName'])){
	$username = $_SESSION['username'];
	$fullName = $_SESSION['fullName'];
	
	
}



// method to post a tweet and the add the tweet in the table by Mustafa Ali
if(isset($_POST['tweet'])){
	$status = $getFromU->checkInput($_POST['status']);
	$tweetImage = '';

	if(!empty($status) ){
		

		if(strlen($status) > 240){
			$error = "Try and keep it less than 240 characters.";
		}
		$tweet_id = $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id,  'postedOn' => date('Y-m-d H:i:s'), 'retweetId' => '0', 'retweetBy' => '0', 'likesCount' => '0', 'retweetCount' => '0', 'retweetMsg' => 'null', 'username' => $username, 'screenName' => $fullName));
		
	}else{
		$error = "Type Something!";
	}
}

if(isset($_GET['search-keywords'])){
	$_SESSION['search'] = $_GET['search-keywords']; 
}




?>

<!--
This template created by Meralesson.com 
This template only use for educational purpose 
-->
<!DOCTYPE HTML> 
<html>
	<head>
		<title>JediTweeps</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>  
		<link rel="stylesheet" href="assets/css/style-complete.css"/> 
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>  	  
	</head>
	<!--Helvetica Neue-->
	<body>
		<div class="wrapper">
			<!-- header wrapper -->
			<div class="header-wrapper">

				<div class="nav-container">
					<!-- Nav -->
					<div class="nav">

						<div class="nav-left">
							<ul>
								<li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
							</ul>
						</div><!-- nav left ends-->

						<div class="nav-right">
							<ul>
								<li>
									<form  method="GET" action="home.php"> 
									<input type="text" placeholder="Search Tweets" name="search-keywords" class="search"/>
									<i class="fa fa-search" aria-hidden="true"></i>
									</form>
									
								</li>

								<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo $user->profileImage;?>"/></label>
									<input type="checkbox" id="drop-wrap1">
									<div class="drop-wrap">
										<div class="drop-inner">
											<ul>
												<li><a href="<?php echo $user->username;?>"><?php echo $user->username;?></a></li>
												<li><a href="includes/logout.php">Log out</a></li>
											</ul>
										</div>
									</div>
								</li>
								
								<?php
								print_r($_SESSION);
								print_r($_GET);
								print_r($_POST);
								echo $username;
								echo $fullName;
								
								?>
							</ul>
						</div><!-- nav right ends-->

					</div><!-- nav ends -->

				</div><!-- nav container ends -->

			</div><!-- header wrapper end -->

			<!---Inner wrapper-->
			<div class="inner-wrapper">
				<div class="in-wrapper">
					<div class="in-full-wrap">
						<div class="in-left">
							<div class="in-left-wrap">
								<div class="info-box">
									<div class="info-inner">
										<div class="info-in-head">
											<!-- PROFILE-COVER-IMAGE -->
											<img src="<?php echo $user->profileCover;?>"/>
										</div><!-- info in head end -->
										<div class="info-in-body">
											<div class="in-b-box">
												<div class="in-b-img">
													<!-- PROFILE-IMAGE -->
													<img src="<?php echo $user->profileImage;?>"/>
												</div>
											</div><!--  in b box end-->
											<div class="info-body-name">
												<div class="in-b-name">
													
											<!-- we are making link in the full name and we are also passing the usrename so, that we can retrieve the username in the profile.php. following .php and followers.php to display more information of the user													-->
													<?php
													echo "<div><a href=\"profile.php?username=".$user->username."\">".$user->screenName."</a></div>";
													?>



													<span><small><a href="<?php echo $user->username;?>">@<?php echo $user->username;?></a></small></span>
												</div><!-- in b name end-->
											</div><!-- info body name end-->
										</div><!-- info in body end-->
										<div class="info-in-footer">
											<div class="number-wrapper">
												<div class="num-box">
													<div class="num-head">
														TWEETS
													</div>
													<div class="num-body">
														10
													</div>
												</div>
												<div class="num-box">
													<div class="num-head">
														FOLLOWING
													</div>
													<div class="num-body">
														<span class="count-following"><?php echo $user->following;?></span>
													</div>
												</div>
												<div class="num-box">
													<div class="num-head">
														FOLLOWERS
													</div>
													<div class="num-body">
														<span class="count-followers"><?php echo $user->followers;?></span>
													</div>
												</div>	
											</div><!-- mumber wrapper-->
										</div><!-- info in footer -->
									</div><!-- info inner end -->
								</div><!-- info box end-->

								<!--==TRENDS==-->
								<!---TRENDS HERE-->
								<!--==TRENDS==-->

							</div><!-- in left wrap-->
						</div><!-- in left end-->
						<div class="in-center">
							<div class="in-center-wrap">
								<!--TWEET WRAPPER-->
								<div class="tweet-wrap">
									<div class="tweet-inner">
										<div class="tweet-h-left">
											<div class="tweet-h-img">
												<!-- PROFILE-IMAGE -->
												<img src="<?php echo $user->profileImage;?>"/>
											</div>
										</div>
										<div class="tweet-body">
											<form method="post" enctype="multipart/form-data">
												<textarea class="status" name="status" placeholder="Type Something here!" rows="4" cols="50"></textarea>
												<div class="hash-box">
													<ul>
													</ul>
												</div>
												</div>
											<div class="tweet-footer">
												<div class="t-fo-left">
													<ul>
														
														
															<span class="tweet-error">
																<?php
																if(isset($error)){
																	echo $error;
																	}
																?>
															</span>
														</li>
													</ul>
												</div>
												<div class="t-fo-right">
													<span id="count">240</span>
													<input type="submit" name="tweet" value="tweet"/>
													</form>
											</div>
										</div>
									</div>
								</div><!--TWEET WRAP END-->


								<!--Tweet SHOW WRAPPER-->
								<div class="tweets">
									<?php $getFromT->tweets($user_id)?>
								</div>
								<!--TWEETS SHOW WRAPPER-->

								<div class="loading-div">
									<img id="loader" src="assets/images/loading.svg" style="display: none;"/> 
								</div>
								<div class="popupTweet"></div>
								<script type="text/javascript" src="assets/js/like.js"></script>
							<script type="text/javascript" src="assets/js/retweet.js"></script>

							</div><!-- in left wrap-->
						</div><!-- in center end -->

						<div class="in-right">
							<div class="in-right-wrap">

								<!--Who To Follow-->
								 <?php $getFromF->whoToFollow($user_id, $user_id); ?>
								<!--Who To Follow-->

							</div><!-- in left wrap-->
							 <script type="text/javascript" src="assets/js/follow.js"></script>

						</div><!-- in right end -->

					</div><!--in full wrap end-->

				</div><!-- in wrappper ends-->
			</div><!-- inner wrapper ends-->
		</div><!-- ends wrapper -->
	</body>

</html>