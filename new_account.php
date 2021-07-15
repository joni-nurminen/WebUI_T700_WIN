<?php
if($status == "empty")
{
echo "<span class='red_color'>You must fill all the fields!</span>";
}
if($status == "used")
{
echo "<span class='red_color'>Username is used!</span>";
}
?>
<form name="input" action="add_account.php" method="post">
	<table name="login" style="width:400px"><tr>
		<td>Username: </td><td><input type="text" name="username" /></td></tr>
		<tr><td>Password: </td><td><input type="text" name="password" /></td></tr>
		<td><input type="submit" name="Submit" value="Create"/></td></tr>
	</table>
</form>
