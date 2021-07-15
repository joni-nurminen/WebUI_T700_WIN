<?php
include "mysql_connect_data.php";
$username = $_POST['username'];
$password = $_POST['password'];
$fail = 0;

function AddNewAccount($username, $password, $link2)
{
	$username = mysqli_real_escape_string($link2,$username);
	$password = mysqli_real_escape_string($link2,$password);
	
	$result = mysqli_query($link2, "INSERT INTO Users (username, password) VALUES ('$username', SHA1('$password')) ") 
	if (!$result) 
    {
		die('Invalid query: ' . mysqli_error($link2));
    }
}

if($username == null || $password == null ) // jos joku kentistä tyhjä
{
	header('Location: index.php?state=new_account&status=empty');
}
else
{
	$result = mysqli_query($link2, "SELECT * FROM Users");
	if (!$result) 
    {
    die('Invalid query: ' . mysqli_error($link2));
    }
	
	while($row = mysqli_fetch_array( $result ))
	{
		if($row['username'] == $username) // jos tietokannasta löytyy sama nimi
		{
			header("Location: index.php?state=new_account&status=used");
			$fail = 1;
		}	
	}
	if(!$fail)
	{
		AddNewAccount($username, $password, $link2); // lisätään tiedot tietokantaan
		header("Location: index.php?status=ok");
	}
}
?>
 


