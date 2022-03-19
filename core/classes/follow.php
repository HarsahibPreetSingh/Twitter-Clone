<!--FileName: index.php
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 
-->

<!-- code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content-->

<?php
class Follow extends User {


function __construct($pdo) {
    $this->pdo = $pdo;
  }
	
	public function checkFollow($followerID, $user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `follow` WHERE `sender` = :user_id  AND `receiver` = :followerID");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":followerID", $followerID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}
	
	// method for displaying follow button on profile page only if user id of that page , is not similar to the user id of the login user by Harsahib Preet Singh
	public function followBtn($profileID, $user_id, $followID){
		$data = $this->checkFollow($profileID, $user_id);
		
			if($profileID != $user_id){
				if(isset($data['receiver']) && $data['receiver'] === $profileID){
					//Following btn
					return "<button class='f-btn following-btn follow-btn' data-follow='".$profileID."' data-profile='".$followID."'>Following</button>";
				}else{
					//Follow button
					return "<button class='f-btn follow-btn' data-follow='".$profileID."' data-profile='".$followID."'><i class='fa fa-user-plus'></i>Follow</button>";
				}
			}
	}
	
	//  method to add follow user data in the table through create method which we created in the user class by Harsahib Preet Singh
	public function follow($followID, $user_id, $profileID){
		$date = date("Y-m-d H:i:s");
		$this->create('follow', array('sender' => $user_id, 'receiver' => $followID, 'followOn' => $date));
		$this->addFollowCount($followID, $user_id);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = :user_id AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profileID');
		$stmt->execute(array("user_id" => $user_id,"profileID" => $profileID));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		
		// we are passing the data through json  to ajax file
		echo json_encode($data);
		
 
  	}

	// method to delete the specific row from the table which we  craeted in the user class  by Hasahib Preet Singh
	public function unfollow($followID, $user_id, $profileID){
		$this->delete('follow', array('sender' => $user_id, 'receiver' => $followID));
		$this->removeFollowCount($followID, $user_id);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = :user_id AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profileID');
		$stmt->execute(array("user_id" => $user_id,"profileID" => $profileID));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		echo json_encode($data);
	}
	
	//method to increment the follow and following count in users table by Harsahib Preet Singh
	public function addFollowCount( $followID, $user_id){
		$stmt = $this->pdo->prepare("UPDATE `users` SET `following` = `following` + 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` + 1 WHERE `user_id` = :followID");
		$stmt->execute(array("user_id" => $user_id, "followID" => $followID));
	}
	
	//method to decrement the follow and following count in users table by Harsahib Preet Singh
	public function removeFollowCount( $followID, $user_id){
		$stmt = $this->pdo->prepare("UPDATE `users` SET `following` = `following` - 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` - 1 WHERE `user_id` = :followID");
		$stmt->execute(array("user_id" => $user_id, "followID" => $followID));
	}
	
	// method to show the following list by Harsahib Pree Singh
	public function followingList($profileID, $user_id, $followID){
		//getting the user information who's following the user
		$stmt = $this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `follow` ON `receiver` = `user_id` AND CASE WHEN `sender` = :user_id THEN `receiver` = `user_id` END WHERE `sender` IS NOT NULL ");
		$stmt->bindParam(":user_id", $profileID, PDO::PARAM_INT);
		$stmt->execute();
		$followings = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		//displaying the information of following users through for each loop
		foreach ($followings as $following) {
			echo '<div class="follow-unfollow-box">
					<div class="follow-unfollow-inner">
						<div class="follow-background">
							<img src="'.BASE_URL.$following->profileCover.'"/>
						</div>
						<div class="follow-person-button-img">
							<div class="follow-person-img"> 
							 	<img src="'.BASE_URL.$following->profileImage.'"/>
							</div>
							<div class="follow-person-button">
								 '.$this->followBtn($following->user_id, $user_id, $followID).'
						    </div>
						</div>
						<div class="follow-person-bio">
							<div class="follow-person-name">
								
							    <div><a href="profile.php?username='.$following->username.'">'.$following->screenName.'</a></div>
													
							</div>
							<div class="follow-person-tname">
								<a href="'.BASE_URL.$following->username.'">@'.$following->username.'</a>
							</div>
							<div class="follow-person-dis">
								
							</div>
						</div>
					</div>
				</div>';
		}
	}
	
	// method to show the followers list by Harsahib Pree Singh
	public function followersList($profileID, $user_id, $followID){
		//getting the user information who's following the user
		$stmt = $this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `follow` ON `sender` = `user_id` AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `receiver` IS NOT NULL ");
		$stmt->bindParam(":user_id", $profileID, PDO::PARAM_INT);
		$stmt->execute();
		$followings = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach ($followings as $following) {
			echo '<div class="follow-unfollow-box">
					<div class="follow-unfollow-inner">
						<div class="follow-background">
							<img src="'.BASE_URL.$following->profileCover.'"/>
						</div>
						<div class="follow-person-button-img">
							<div class="follow-person-img"> 
							 	<img src="'.BASE_URL.$following->profileImage.'"/>
							</div>
							<div class="follow-person-button">
								 '.$this->followBtn($following->user_id, $user_id, $followID).'
						    </div>
						</div>
						<div class="follow-person-bio">
							<div class="follow-person-name">
								 <div><a href="profile.php?username='.$following->username.'">'.$following->screenName.'</a></div>
							</div>
							<div class="follow-person-tname">
								<a href="'.BASE_URL.$following->username.'">@'.$following->username.'</a>
							</div>
							<div class="follow-person-dis">
								
							</div>
						</div>
					</div>
				</div>';
		}
	}
	
	//// method to show eho to follow users  by Harsahib Pree Singh
	public function whoToFollow($user_id, $profileID){
		//here wer are writing a query to check like the user_id is already not present in the follow table like if are already not following the user
		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` != :user_id AND `user_id` NOT IN (SELECT `receiver` FROM `follow` WHERE `sender` = :user_id) ORDER BY rand() LIMIT 10");
		$stmt->execute(array("user_id" => $user_id));
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		echo '<div class="follow-wrap"><div class="follow-inner"><div class="follow-title"><h3>People you might know</h3></div>';
		foreach ($users as $user) {
			echo '<div class="follow-body">
					<div class="follow-img">
					  <img src="'.BASE_URL.$user->profileImage.'"/>
				    </div>
					<div class="follow-content">
						<div class="fo-co-head">
							<div><a href="profile.php?username='.$user->username.'">'.$user->screenName.'</a></div>
							
							<span>@'.$user->username.'</span>
						</div>
						<!-- FOLLOW BUTTON -->
						'.$this->followBtn($user->user_id, $user_id, $profileID).'
					</div>
				</div>';
		}
		echo '</div></div>';
	}
}
?>