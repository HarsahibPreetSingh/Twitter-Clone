<!--FileName: tweet.php
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 
-->

<!-- code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content-->

<?php
class Tweet extends User {

	function __construct($pdo) {
		$this->pdo = $pdo;
	}
	public function tweets($user_id){
		//search function to search specific tweets by the useranem and full name of the user
		if(isset($_SESSION['search'])){
			$search = $_SESSION['search'];
//			echo $search;
			$stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `username` LIKE '%$search%' OR `screenName` LIKE '%$search%'  ");
		
		$stmt->execute();
		$tweets = $stmt->fetchAll(PDO::FETCH_OBJ);

			// dispalying all the tweets through foreach loop by jason
		foreach($tweets as $tweet){
			$likes = $this->likes($user_id, $tweet->tweetID);
			$retweet = $this->checkRetweet($tweet->tweetID, $user_id);
			$user = $this->userData($tweet->retweetBy);
			
			echo '<div class="all-tweet">
					<div class="t-show-wrap">	
					 <div class="t-show-inner">
					 	
						<!-- only show the retweet icon when retweet id >0 -->
						'.(($tweet->retweetID > 0) ? '
							<div class="t-show-banner">
								<div class="t-show-banner-inner">
									<span><i class="fa fa-share" aria-hidden="true"></i></span><span>'.$user->screenName.' Retweeted</span>
								</div>
							</div>'
						   : '').'


						<!-- only show the comment section when comment is not null -->
						'.((empty($tweet->retweetMsg) && $tweet->tweetID === $retweet['tweetID'] || $tweet->retweetID > 0) ? '
							<div class="t-show-head">
								<div class="t-s-head-content">
									<div class="t-h-c-name">
										<span><a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a></span>
										<span>@'.$user->username.'</span>
										<span>'.($tweet->postedOn).'</span>
									</div>
									<div class="t-h-c-dis">
										'.($tweet->retweetMsg).'
									</div>
								</div>
							</div>
							<div class="t-s-b-inner">
								<div class="t-s-b-inner-in">
									<div class="retweet-t-s-b-inner">
										<div class="retweet-t-s-b-inner-left">	
										</div>
										
											<div class="t-h-c-name">
												<span><a href="'.BASE_URL.$tweet->username.'"></a>'.$tweet->screenName.'</span>
												<span>@'.$tweet->username.'</span>
												<span>'.($tweet->postedOn).'</span>
											</div>
											<div class="retweet-t-s-b-inner-right-text">		
												'.($tweet->status).'
											</div>
										
									</div>
								</div>
							</div>' : '
							<div class="t-show-popup">
								<div class="t-show-head">

									<div class="t-s-head-content">
										<div class="t-h-c-name">
											<span><a href="'.$tweet->username.'">'.$tweet->screenName.'</a></span>
											<span>'.$tweet->username.'</span>
											<span>'.$tweet->postedOn.'</span>
										</div>
										<div class="t-h-c-dis tweet-padd">
											'.$tweet->status.'
										</div>
									</div>
								</div>
								<!--tweet show head end-->
								<!--tweet show body end-->
							</div>').'
						
						
						<div class="t-show-footer">
							<div class="t-s-f-right">
								<ul> 
									<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	

									<li>'.((isset($retweet['retweetID']) ? $tweet->tweetID === $retweet['retweetID'] : '') ? 
										   '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>' : 
										   '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>').'
			      				</li>

									<li>'.((isset($likes['likeOn']) ? $likes['likeOn'] === $tweet->tweetID : '') ? 
										   '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '' ).'</span></button>' : 
										   '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '' ).'</span></button>').'
			      				   </li>

										<li>
										<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
										<ul> 
										  <li><label class="deleteTweet">Delete Tweet</label></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					</div>
				</div>';
		}
		}
		
		else{
	    // if serach statement is not set then we display all the twets of the user we follow and retweets to other users, but not to user himself
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` ON `tweetBy` = `user_id` WHERE `tweetBy` = :user_id AND `retweetID` = '0' OR `tweetBy` = `user_id` AND `retweetBy` != :user_id ");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$tweets = $stmt->fetchAll(PDO::FETCH_OBJ);

		foreach($tweets as $tweet){
			$likes = $this->likes($user_id, $tweet->tweetID);
			$retweet = $this->checkRetweet($tweet->tweetID, $user_id);
			$user = $this->userData($tweet->retweetBy);
			
			echo '<div class="all-tweet">
					<div class="t-show-wrap">	
					 <div class="t-show-inner">

						'.(($tweet->retweetID > 0) ? '
							<div class="t-show-banner">
								<div class="t-show-banner-inner">
									<span><i class="fa fa-share" aria-hidden="true"></i></span><span>'.$user->screenName.' Retweeted</span>
								</div>
							</div>'
						   : '').'


						'.((empty($tweet->retweetMsg) && $tweet->tweetID === $retweet['tweetID'] || $tweet->retweetID > 0) ? '
							<div class="t-show-head">
								<div class="t-s-head-content">
									<div class="t-h-c-name">
										<span><a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a></span>
										<span>@'.$user->username.'</span>
										<span>'.($tweet->postedOn).'</span>
									</div>
									<div class="t-h-c-dis">
										'.($tweet->retweetMsg).'
									</div>
								</div>
							</div>
							<div class="t-s-b-inner">
								<div class="t-s-b-inner-in">
									<div class="retweet-t-s-b-inner">
										<div class="retweet-t-s-b-inner-left">	
										</div>
										
											<div class="t-h-c-name">
												<span><a href="'.BASE_URL.$tweet->username.'"></a>'.$tweet->screenName.'</span>
												<span>@'.$tweet->username.'</span>
												<span>'.($tweet->postedOn).'</span>
											</div>
											<div class="retweet-t-s-b-inner-right-text">		
												'.($tweet->status).'
											</div>
										
									</div>
								</div>
							</div>' : '
							<div class="t-show-popup">
								<div class="t-show-head">

									<div class="t-s-head-content">
										<div class="t-h-c-name">
											<span><a href="'.$tweet->username.'">'.$tweet->screenName.'</a></span>
											<span>'.$tweet->username.'</span>
											<span>'.$tweet->postedOn.'</span>
										</div>
										<div class="t-h-c-dis tweet-padd">
											'.$tweet->status.'
										</div>
									</div>
								</div>
								<!--tweet show head end-->
								<!--tweet show body end-->
							</div>').'
						
						
						<div class="t-show-footer">
							<div class="t-s-f-right">
								<ul> 
									

									<li>'.((isset($retweet['retweetID']) ? $tweet->tweetID === $retweet['retweetID'] : '') ? 
										   '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>' : 
										   '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>').'
			      				</li>

									<li>'.((isset($likes['likeOn']) ? $likes['likeOn'] === $tweet->tweetID : '') ? 
										   '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '' ).'</span></button>' : 
										   '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '' ).'</span></button>').'
			      				   </li>

										
								</ul>
							</div>
						</div>
					</div>
					</div>
				</div>';
		}
		}
	}

	//method for incrementing likescount by Julia Embrett
	public function addLike($user_id, $tweet_id, $get_id){
		$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount`+1 WHERE `tweetID` = :tweet_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();

		$this->create('likes', array('likeBy' => $user_id, 'likeOn' => $tweet_id));


	}

	//method for displaying all the data from likes table like who liked the tweet so that we can only show increment like option to those who didn't like the tweet by julia Embrett
	public function likes($user_id, $tweet_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	//method for unliking the tweet and deleting that specific row with the like information from the table by Julia Embrett
	public function unLike($user_id, $tweet_id, $get_id){
		$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount`-1 WHERE `tweetID` = :tweet_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id and `likeOn` = :tweet_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute(); 
	}

	//get pop up tweet comes up, when we click on the retweet button
	public function getPopupTweet($tweet_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetID` = :tweet_id AND `tweetBy` = `user_id`");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	// method for retweeting the tweet by inserting the new row in the table with updated retweet count and updated comments section by Jason
	public function retweet($tweet_id, $user_id, $get_id, $comment){
		$stmt = $this->pdo->prepare("UPDATE `tweets` SET `retweetCount` = `retweetCount`+1 WHERE `tweetID` = :tweet_id AND `tweetBy` = :get_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->bindParam(":get_id", $get_id, PDO::PARAM_INT);
		$stmt->execute();
		
		

		$stmt = $this->pdo->prepare("INSERT INTO `tweets` (`status`,`tweetBy`,`retweetID`,`retweetBy`,`postedOn`,`likesCount`,`retweetCount`,`retweetMsg`, `username`, `screenName`) SELECT `status`,`tweetBy`,`tweetID`,:user_id,CURRENT_TIMESTAMP,`likesCount`,`retweetCount`,:retweetMsg, `username`, `screenName` FROM `tweets` WHERE `tweetID` = :tweet_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":retweetMsg", $comment, PDO::PARAM_STR);
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();
		
		

	}

	// method for checking, if the retweet was successful so that we so the retweet icon and comment on the top of the tweet by Jason
	public function checkRetweet($tweet_id, $user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `retweetID` = :tweet_id AND `retweetBy` = :user_id OR `tweetID` = :tweet_id and `retweetBy` = :user_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
?>