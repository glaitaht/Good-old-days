<html> 
<head>
	<link rel="stylesheet" href="style.css">
	<title> e-Goverment </title>
  <link rel="stylesheet" href="bootstrap.css">	
</head>
<body>
	<div class="container">
	<div class="card">
	<form action="base.php" method="POST"> <h2>SIGN UP:</h2> <!-- sign up from new php, posting base.php -->	
            <p>User Name:</p><input type="text" name="userName" /><br /> <!-- doing same post function with admins button -->	
            <p>Adress:</p><input type="text" name="address" />	
            <p>Phone Number:</p><input type="text" name="phoneNo" />	
            <p>E-Mail Adress:</p><input type="text" name="mail" />	
            <p>Birthdate(MUST BE LİKE 2020-12-31):</p><input type="text" name="birthday" />	<br \><br \> <!-- taking all the info -->	
			<select name="age">
					  <option value=''>Choose Age</option>
					  <option value='U'>Under 18</option>
					  <option value='O'>Over 18</option>
			</select>
			if Under 18 Father's TC: <input type="text" name="fathers" /><br /> 
			<!-- and sending with 'adding' button name, progress continue in base.php -->	
            <input type="submit" name="adding" class="button" value="Define a New User" style="margin-top:15px;"/>
            <p><input type="submit" name="pp" class="button" value="Go back to main page" style="margin-top:15px;" onclick="location.href='index.php'" /></p>
     </form>
	 
	 
	</div>
	</div>
	
	<div id="footer"> 
	<a href="designer.html">Desinger of this website</a>
	</div>
<body>
</html>