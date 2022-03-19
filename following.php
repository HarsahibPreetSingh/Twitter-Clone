<!--FileName: following.php
    
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
if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
	$username = $getFromU->checkInput($_GET['username']);
	$profileId = $getFromU->userIdByUsername($username);
	$profileData = $getFromU->userData($profileId);
	$user_id = $_SESSION['user_id'];
	$user = $getFromU->userData($user_id);

	echo ($profileId);


	if (!$profileData) {
		header('Location: index.php');
	}
}

?>

<!doctype html>
<html>
	<head>
		<title>Jedi Tweep</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
		<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style-complete.css"/>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	</head>
	<!--Helvetica Neue-->
	<body>
		<div class="wrapper">
			<!-- header wrapper -->
			<div class="header-wrapper">	
				<div class="nav-container">
					<div class="nav">
						<div class="nav-left">
							<ul>
								<li><a href="<?php echo BASE_URL;?>"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>

							</ul>
						</div><!-- nav left ends-->
						<div class="nav-right">
							<ul>
								<li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i>
									<div class="search-result"> 			
									</div>
								</li>

								<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profileImage;?>"/></label>
									<input type="checkbox" id="drop-wrap1">
									<div class="drop-wrap">
										<div class="drop-inner">
											<ul>
												<li><a href="<?php echo BASE_URL.$user->username;?>"><?php echo $user->username;?></a></li>
												<li><a href="<?php echo BASE_URL;?>settings/account">Settings</a></li>
												<li><a href="<?php echo BASE_URL;?>includes/logout.php">Log out</a></li>
											</ul>
										</div>
									</div>
								</li>
								<li><label class="addTweetBtn" for="pop-up-tweet">Tweet</label></li>

							</ul>
						</div><!-- nav right ends-->
					</div><!-- nav ends -->
				</div><!-- nav container ends -->
			</div><!-- header wrapper end -->
			<!--Profile cover-->
			<div class="profile-cover-wrap"> 
				<div class="profile-cover-inner">
					<div class="profile-cover-img">
						<img src="<?php echo BASE_URL.$profileData->profileCover;?>"/>
					</div>
				</div>
				<div class="profile-nav">
					<div class="profile-navigation">
						<ul>
							
							<li>
								
								<?php
									echo "<a href=\"following.php?username=".$user->username."\">";
								?>
								
									<div class="n-head">
										FOLLOWING
									</div>
									<div class="n-bottom">
										<span class="count-following"><?php echo $profileData->following;?></span>
									</div>
								<?php
								  echo "</a>";
								?>
								
							</li>
							<li>
								
								<?php
									echo "<a href=\"followers.php?username=".$user->username."\">";
								?>
								
									<div class="n-head">
										FOLLOWERS
									</div>
									<div class="n-bottom">
										<span class="count-followers"><?php echo $profileData->followers;?></span>
									</div>
								<?php
								  echo "</a>";
								?>
								
							</li>
							
						</ul>
						<div class="edit-button">
							<span>
								<?php echo $getFromF->followBtn($profileId, $user_id, $profileData->user_id);?>
							</span>
						</div>
					</div>
				</div>
			</div><!--Profile Cover End-->

			<!---Inner wrapper-->
			<div class="in-wrapper"> 
				<div class="in-full-wrap">
					<div class="in-left">
						<div class="in-left-wrap">
							<!--PROFILE INFO WRAPPER END-->
							<div class="profile-info-wrap">
								<div class="profile-info-inner">

									<div class="profile-img">
										<img src="<?php echo BASE_URL.$profileData->profileImage;?>"/>
									</div>	

									<div class="profile-name-wrap">
										<div class="profile-name">
											<a href="<?php echo BASE_URL.$profileData->username;?>"><?php echo $profileData->screenName;?></a>
										</div>
										<div class="profile-tname">
											@<span class="username"><?php echo $profileData->username;?></span>
										</div>
									</div>

									<div class="profile-bio-wrap">
										<div class="profile-bio-inner">
											<?php echo $profileData->bio;?>
										</div>
									</div>

									<div class="profile-extra-info">
										<div class="profile-extra-inner">
											<ul>
												<li>
													<div class="profile-ex-location-i">
														<i class="fa fa-map-marker" aria-hidden="true"></i>
													</div>
													<div class="profile-ex-location">
														<?php echo $profileData->country;?>
													</div>
												</li>
												<li>
													<div class="profile-ex-location-i">
														<i class="fa fa-link" aria-hidden="true"></i>
													</div>
													<div class="profile-ex-location">
														<a href="#"><?php echo $profileData->website;?></a>
													</div>
												</li>
												<li>
													<div class="profile-ex-location-i">
														<!-- <i class="fa fa-calendar-o" aria-hidden="true"></i> -->
													</div>
													<div class="profile-ex-location">
													</div>
												</li>
												<li>
													<div class="profile-ex-location-i">
														<!-- <i class="fa fa-tint" aria-hidden="true"></i> -->
													</div>
													<div class="profile-ex-location">
													</div>
												</li>
											</ul>						
										</div>
									</div>

									<div class="profile-extra-footer">
										<div class="profile-extra-footer-head">
											<div class="profile-extra-info">
												<ul>
													<li>
														<div class="profile-ex-location-i">
															<i class="fa fa-camera" aria-hidden="true"></i>
														</div>
														<div class="profile-ex-location">
															<a href="#">0 Photos and videos </a>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="profile-extra-footer-body">
											<ul>
												<!-- <li><img src="#"/></li> -->
											</ul>		
										</div>

										<?php ?>

									</div>

								</div>
								<!--PROFILE INFO INNER END-->

							</div>
							<!--PROFILE INFO WRAPPER END-->
							<div class="popupTweet"></div>
						</div>
						<!-- in left wrap-->

					</div>
					<!-- in left end-->
					<!--FOLLOWING OR FOLLOWER FULL WRAPPER-->
					<div class="wrapper-following">
						<div class="wrap-follow-inner">
							<?php $getFromF->followingList($profileId, $user_id, $profileData->user_id);?>		
						</div><!-- wrap follo inner end-->
					</div><!--FOLLOWING OR FOLLOWER FULL WRAPPER END-->
					<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/follow.js"></script>

				</div><!--in full wrap end-->
			</div>
			<!-- in wrappper ends-->

		</div><!-- ends wrapper -->
	</body>
</html>
