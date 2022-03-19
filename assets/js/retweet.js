//  FileName: retweet.js
//    
//  Author/Customized: 	
//  Amit Lalani (B00858413) - am326342@dal.ca
//	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
//	Julia Embrett (B00790841) - jl315162@dal.ca 
//	Jason Nguyen (B00830592) - ng839815@dal.ca 
//	Mustafa Ali (B00636362)- ms801525@dal.ca 
//
// code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content

$(function(){
	$(document).on('click','.retweet', function(){
		$tweet_id    = $(this).data('tweet');
		$user_id     = $(this).data('user');
	    $counter        = $(this).find(".retweetsCount");
	    $count          = $counter.text();
	    $button         = $(this);


		// code to hide the pop function
		$.post('http://localhost/twitter/core/ajax/retweet.php', {showPopup:$tweet_id,user_id:$user_id}, function(data){
			$('.popupTweet').html(data);
			$('.close-retweet-popup').click(function(){
				$('.retweet-popup').hide();
			})
		});
	});
	
	// here what we are doing is, we are checking we the function is retweeted then we remove the retweet class and  add class retweeted by Jason

	$(document).on('click', '.retweet-it', function(){
		var tweet_id   = $(this).data('tweet');
		var user_id    = $(this).data('user');
	    var comment    = $('.retweetMsg').val();


	    $.post('http://localhost/twitter/core/ajax/retweet.php', {retweet:$tweet_id,user_id:$user_id,comment:comment}, function(){
	    	$('.retweet-popup').hide();
	    	$count++;
	    	$counter.text($count);
	    	$button.removeClass('retweet').addClass('retweeted');
	    });

	});
});