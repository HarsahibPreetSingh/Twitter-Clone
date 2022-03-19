<!--FileName: user.php (classes file)
    
    Author/Customized: 	
    Amit Lalani (B00858413) - am326342@dal.ca
	Harsahib Preet Singh (B00850322) - hr644654@dal.ca 
	Julia Embrett (B00790841) - jl315162@dal.ca 
	Jason Nguyen (B00830592) - ng839815@dal.ca 
	Mustafa Ali (B00636362)- ms801525@dal.ca 

-->



<?php

//code learned from https://www.udemy.com/course/create-a-high-end-social-network-like-twitter-in-php-mysql/learn/lecture/7427892?start=0#content
class User {
	protected $pdo;

	//passing the database connection to constructor through constructor injection method
	function __construct($pdo) {
		$this->pdo = $pdo;
	}
	
	// input checking method 
	public function checkInput($var){
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripslashes($var);
		return $var;
	}

	// Login method by Julia Embrett
	public function login($email, $password){
		//retrieving usre id if the username and password is correct for futher use like retrieving usrename, full name
		$stmt = $this->pdo->prepare('SELECT `user_id` FROM `users` WHERE `email` = :email AND `password` = :password');
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->execute();
		
		//retrieving all data where data matches
		$query = $this->pdo->prepare('SELECT * FROM `users` WHERE `email` = :email AND `password` = :password');
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->execute();

		$count = $stmt->rowCount();
		$user = $stmt->fetch(PDO::FETCH_OBJ);
		
		$counter = $query->rowCount();
		$result = $query->fetch(PDO::FETCH_OBJ);
		
		
		echo $count;
		echo $email;
		echo $password;
		
		

		if($count > 0){
			$_SESSION['user_id'] = $user->user_id;

			header('Location: home.php');
		}else{
			return false;
		}
		
		if($counter > 0){
			$_SESSION['username'] = $result->username;
			$_SESSION['fullName'] = $result->screenName;
			header('Location: home.php');
		}else{
			return false;
		}
		
								
								
	}

	// method for retrieving user data  where user id matches by Harsahib Preet Singh and Mustafa
	public function userData($user_id){
		$stmt = $this->pdo->prepare('SELECT * FROM `users` WHERE `user_id` = :user_id');
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	//logout function by Amit lalani
	public function logout(){
		$_SESSION = array();
		session_destroy();
		header('Location: ../index.php');
	}
	
	
	//check email function to check if email is already in use by Julia Embrett
	public function checkEmail($email){
		$stmt = $this->pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}
	
	
	// register function by Julia Embrett
	public function register($userName, $email, $screenName,$password ){
	    
	    $stmt = $this->pdo->prepare("INSERT INTO `users` (`username`,`email`, `password`, `screenName`, `profileImage`, `profileCover`,`following`,`followers`,`bio`,`country`,`website`) VALUES (:userName, :email, :password, :screenName, 'assets/images/defaultprofile.png', 'assets/images/defaultCover.png', '0', '0', 'null', 'null', 'null')");
	    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
 	    $stmt->bindParam(":password", $password , PDO::PARAM_STR);
	    $stmt->bindParam(":screenName", $screenName, PDO::PARAM_STR);
		$stmt->bindParam(":userName", $userName, PDO::PARAM_STR);
	    $stmt->execute();

	    $user_id = $this->pdo->lastInsertId();
	    $_SESSION['user_id'] = $user_id;
	  }
	
	// method for retrieving user id by username , so that we retrieve further information of user for displaying info in profile page by Hrasahib Preet Singh and Mustafa Ali
	public function userIdbyUsername($username){
		$stmt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE (`username`  = :username)");
		$stmt->bindParam("username", $username, PDO::PARAM_STR);
		$stmt->execute();
	    $user = $stmt->fetch(PDO::FETCH_OBJ);
	    return $user->user_id;
	}
	
	
	// method fpr creating a new row in a table
	public function create($table, $fields = array()){
		$columns = implode(',', array_keys($fields));
		$values  = ':'.implode(', :', array_keys($fields));
		$sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

		if($stmt = $this->pdo->prepare($sql)){
			foreach ($fields as $key => $data) {
				$stmt->bindValue(':'.$key, $data);
			}
			$stmt->execute();
			return $this->pdo->lastInsertId();
		}
	}
	
	
	// method for delete specific row in a table
	public function delete($table, $array){
		$sql   = "DELETE FROM " . $table;
		$where = " WHERE ";

		foreach($array as $key => $value){
			$sql .= $where . $key . " = '" . $value . "'";
			$where = " AND ";
		}
		$sql .= ";";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
	}
}



	
?>