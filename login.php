
<style>
button
{

	
	border: 1px solid #759dc0;
	padding: 2px 4px 4px 4px;
	color: #000000;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);
	-moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);
	background-color: #bcd8f4;
	background-image: url("form/images/buttonEnabled.png");
	background-repeat: repeat-x;
	background-image: -moz-linear-gradient(#ffffff 0px, rgba(255, 255, 255, 0) 3px, rgba(255, 255, 255, 0.75) 100%);
	background-image: -webkit-linear-gradient(#ffffff 0px, rgba(255, 255, 255, 0) 3px, rgba(255, 255, 255, 0.75) 100%);
	background-image: -o-linear-gradient(#ffffff 0px, rgba(255, 255, 255, 0) 3px, rgba(255, 255, 255, 0.75) 100%);
	background-image: -ms-linear-gradient(#ffffff 0px, rgba(255, 255, 255, 0) 3px, rgba(255, 255, 255, 0.75) 100%);
	_background-image: none;
	
	width: 175px;
	height: 40px;
	border-radius: 25px;
}
button:hover
{
	border: 1px solid gray;
	background-color: #86bdf2;
    color: #000000;
    -webkit-transition-duration: 0.2s;
    -moz-transition-duration: 0.2s;
    transition-duration: 0.2s;
}
</style>

<script>
function show_keyboard() // show keyboard
{
	document.getElementById("keyboard").style.display="block";
}
function clicked_button(val)
{
	document.getElementById("pass_field").value = document.getElementById("pass_field").value + val;
}
function clear_data()
{
	document.getElementById("pass_field").value = "";
}

</script>
<form name="input" action="check_login.php" method="post">
<table name="login" border ="0"><tr>
<tr><td colspan="2">
<?php
	if($status == "ok")
		echo "<span style=color:green>Passwords changed!</span>";
	if($status == "wrong")
		echo "<span style=color:red>Wrong username or password!</span>";
	if($status == "mysql_err")
		echo "<span style=color:red>Mysql connection error!</span>";
?>
</td></tr>
<td>Username: </td><td>
<select name="user" style="height: 35px;width: 200px;">
		<option value="Operator">Operator</option>
		<option value="Importer">Importer</option>
		<option value="TM">TM</option>
		<option value="Chain">Chain</option> 
		<option value="Admin">Admin</option>
	<!--	<option value="Wap">Wap</option> -->
</select> </tr>
<tr><td>Password: </td><td><input id="pass_field" type="password" name="login_password" value="" onclick="show_keyboard()" style="height: 35px;width: 196px;"/></td></tr>
 <td colspan="2"><button type="submit" name="submit" value="login" style="margin-top: 15px"/>Login</td>
</table>
	<div id="keyboard" class="keyboard" style="display:none;">
		<div class="keyboard_button" onclick="clicked_button(1)"><span class="text_">1</span></div>
		<div class="keyboard_button" onclick="clicked_button(2)"><span class="text_">2</span></div>
		<div class="keyboard_button" onclick="clicked_button(3)"><span class="text_">3</span></div>
		<div class="clearBoth"></div>
		<div class="keyboard_button" onclick="clicked_button(4)"><span class="text_">4</span></div>
		<div class="keyboard_button" onclick="clicked_button(5)"><span class="text_">5</span></div>
		<div class="keyboard_button" onclick="clicked_button(6)"><span class="text_">6</span></div>
		<div class="clearBoth"></div>
		<div class="keyboard_button" onclick="clicked_button(7)"><span class="text_">7</span></div>
		<div class="keyboard_button" onclick="clicked_button(8)"><span class="text_">8</span></div>
		<div class="keyboard_button" onclick="clicked_button(9)"><span class="text_">9</span></div>
		<div class="clearBoth"></div>
		<div class="keyboard_button" onclick="clicked_button(0)"><span class="text_">0</span></div>
		<div class="keyboard_button_clr" onclick="clear_data()"><span class="text_">Clear</span></div>
	</div>
</form> 
					

