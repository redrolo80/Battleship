<?php
session_start();
include_once("connectToDB.php");
	
if (isset($_POST['username'])) {	
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$sql = $conn->query("SELECT * FROM users WHERE UserName='$username' AND UserPassword='$password' LIMIT 1"); // query the person

	

// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
	$existCount = $sql->num_rows; // count the row nums
	if ($existCount == 0) { // evaluate the count
		 $_SESSION['username'] = false;
		 $output = "User not found, returning to the login page";
		 header( "refresh:5;url=login.html" );
	}

	else if ($existCount > 0) {
	    while($row = $sql->fetch_assoc()){ 
             $id = $row["UserId"];
			 $uname = $row["UserName"];
			 $pword = $row["UserPassword"]; 
        }
	$_SESSION['username'] = $uname;
	$_SESSION['id'] = $id;
	$_SESSION['userpassword'] =$pword;
	$_SESSION['loggedin'] = true;
		$output = "Hello $uname!, you are now logged in. Returning to the main page" ;

	
		
	$sql2 = $conn->query("SELECT * FROM game WHERE UserName='$username' AND UserId=$id LIMIT 1"); // query the person
	$existCount = $sql2->num_rows; // count the row nums
	if ($existCount == 0) { // evaluate the count
		$sql2 = $conn->query("INSERT INTO game (UserName,UserId,GameOpponent,GameId,CurrentTurn,PlayerAction,OpponentAction,GameState,ChatMessage) 
		VALUES ('$username', $id, NULL,NULL,NULL,NULL,NULL,NULL)"); // query the person
   }
   		header( "refresh:5;url=index.html" );




	}

	echo json_encode($output);
}
?>