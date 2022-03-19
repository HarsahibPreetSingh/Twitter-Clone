//  FileName: follow.php
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
  $('.follow-btn').click(function(){
    var followID = $(this).data('follow');
	var profile = $(this).data('profile');
    $button = $(this);

	  // so, basically we are writing code like when button has class following and we want  to unfollow the user then we remove the unfollow class and following class and display the follow button Harsahib Preet Singh
    if ($button.hasClass('following-btn')) {
      $.post('http://localhost/twitter/core/ajax/follow.php', {unfollow:followID, profile:profile}, function(data){
        data = JSON.parse(data);
        $button.removeClass('following-btn');
        $button.removeClass('unfollow-btn');
        $button.html('<i class="fa fa-user-plus"></i>Follow');
        $('.count-following').text(data.following);
        $('.count-followers').text(data.followers);
      });
    }else{
      $.post('http://localhost/twitter/core/ajax/follow.php', {follow:followID, profile:profile}, function(data){
        data = JSON.parse(data);
        $button.removeClass('follow-btn');
        $button.addClass('following-btn');
        $button.text('Following');
        $('.count-following').text(data.following);
        $('.count-followers').text(data.followers);
      });
    }
  });

	//basicaaly we are making the hover function here like when the id is following and text is following then we display the unfollow button while hover Harsahib Preet Singh
  $('.follow-btn').hover(function(){
    $button = $(this);

    if($button.hasClass('following-btn')) {
      $button.addClass('unfollow-btn');
      $button.text('Unfollow');
    }
  }, function(){
    if($button.hasClass('following-btn')) {
      $button.removeClass('unfollow-btn');
      $button.text('Following');
    }
  });
});
