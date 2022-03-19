//  FileName: like.js
//    
//  Author/Customized: 	
//  Amit Lalani (B00858413) - am326342@dal.ca
//	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
//	Julia Embrett (B00790841) - jl315162@dal.ca 
//	Jason Nguyen (B00830592) - ng839815@dal.ca 
//	Mustafa Ali (B00636362)- ms801525@dal.ca 
//
//code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content

$(function(){
	
	//so, we are writing a code here is like when we click on like button, then we add  unlike claas and remove add class by Julia Embrett
	$(document).on('click','.like-btn', function(){
 		var tweet_id  = $(this).data('tweet');
		var user_id   = $(this).data('user');
		var counter   = $(this).find('.likesCounter');
		var count     = counter.text();
		var button    = $(this);

		$.post('http://localhost/twitter/core/ajax/like.php', {like:tweet_id, user_id:user_id}, function(){
 			counter.show();
 			button.addClass('unlike-btn');
			button.removeClass('like-btn');
			count++;
			counter.text(count);
			button.find('.fa-heart-o').addClass('fa-heart');
			button.find('.fa-heart').removeClass('fa-heart-o');
		}); 
	});

	//so, we are writing a code here is like when we click on unlike button, then we add  like class and remove unlike class by Julia Embrett
	$(document).on('click','.unlike-btn', function(){
 		var tweet_id  = $(this).data('tweet');
		var user_id   = $(this).data('user');
		var counter   = $(this).find('.likesCounter');
		var count     = counter.text();
		var button    = $(this);

		$.post('http://localhost/twitter/core/ajax/like.php', {unlike:tweet_id, user_id:user_id}, function(){
 			counter.show();
 			button.addClass('like-btn');
			button.removeClass('unlike-btn');
			count--;
			if(count === 0){
				counter.hide();
			}else{
			  counter.text(count);
			}
   		    counter.text(count);
			button.find('.fa-heart').addClass('fa-heart-o');
			button.find('.fa-heart-o').removeClass('fa-heart');
		}); 
	});
});