<!--FileName: retweet.php(ajax)
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 
-->

<!--this file is attached to the retweet.js, basically this file is for  showing retweeting pop up-->

<!-- code html template retrieved from and code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content-->

<?php 
	include '../init.php';
	$user_id = $_SESSION['user_id'];
	
	if(isset($_POST['retweet']) && !empty($_POST['retweet'])){
		$tweet_id  = $_POST['retweet'];
		$get_id    = $_POST['user_id'];
		$comment   = $getFromU->checkInput($_POST['comment']);
		$getFromT->retweet($tweet_id, $user_id, $get_id, $comment);
	}
	if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
		$tweet_id   = $_POST['showPopup'];
		$user       = $getFromU->userData($user_id);
		$tweet      = $getFromT->getPopupTweet($tweet_id);
	
?>
<div class="retweet-popup">
<div class="wrap5">
	<div class="retweet-popup-body-wrap">
		<div class="retweet-popup-heading">
			<h3>Share your comment or question on this?</h3>
			<span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
		</div>
		<div class="retweet-popup-input">
			<div class="retweet-popup-input-inner">
				<input class="retweetMsg" type="text" placeholder="Type here"/>
			</div>
		</div>
		<div class="retweet-popup-inner-body">
			<div class="retweet-popup-inner-body-inner">
				<div class="retweet-popup-comment-wrap">
					 <div class="retweet-popup-comment-head">
					 	
					 </div>
					 <div class="retweet-popup-comment-right-wrap">
						 <div class="retweet-popup-comment-headline">
						 	<a><?php echo $tweet->screenName;?> </a><span>‏@<?php echo $tweet->username;?> <?php echo $tweet->postedOn;?></span>
						 </div>
						 <div class="retweet-popup-comment-body">
						 	<?php echo $tweet->status;?>  
						 </div>
					 </div>
				</div>
			</div>
		</div>
		<div class="retweet-popup-footer"> 
			<div class="retweet-popup-footer-right">
				<button class="retweet-it" data-tweet="<?php echo $tweet->tweetID;?>" data-user="<?php echo $tweet->user_id;?>" type="submit"><i class="fa fa-share" aria-hidden="true"></i>Share </button>
			</div>
		</div>
	</div>
</div>
</div><!-- Retweet PopUp ends-->
<?php }?>
