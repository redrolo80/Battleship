<?php
session_start();
include_once("connectToDB.php");
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true){
    $uname = $_SESSION['username'];
    $uid = $_SESSION['id'];
    $sql = $conn->query("SELECT * FROM users WHERE UserName= '$uname' AND UserId = $uid LIMIT 1"); // query the person
    $row = $sql->fetch_assoc();
    $losses = $row['NumLoses'] + 1;
    $games = $row['NumGames'] + 1;
    $sql = $conn->query("UPDATE users SET NumLosses = $losses, NumGames = $games WHERE UserName = '$uname' AND UserId = $uid;");

}
else{
    echo "Player Not Logged In";
}

	
?>