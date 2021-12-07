<html> 
<head>
	<link rel="stylesheet" href="style.css">
	<title> e-Goverment </title>
  <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
	<div class="container"><!-- bootstraps container object, making height and witdh same with computer -->	
	<div class="card"> <!-- bootstrap card object, making white background space -->	
	<form action="base.php" method="POST"> <!-- we just created single form that provides php login infos -->
            <p title="Master password is MSTRPSSWRD, write both sides." style="margin-top:15px;">TC:</p><input type="text" name="tc" /><br /> 
            <p title="Master password is MSTRPSSWRD, write both sides." style="margin-top:15px;">Password:</p><input type="password" name="password" />	
            <p><input type="submit" name="login" class="button" value="Login" style="margin-top:15px;"/></p> <!-- this button send both inputs to base.php -->
			<!-- using two input for id and password, if you want to login as admin u can just pu MSTRPSSWRD to both sides. -->
			<p><a href="new.php">  Sign up, only for new citizen.  </a></p> <!-- Creating citizen account without admin  -->
     </form>
	</div>
	</div>
	
	<div id="footer"> 
	<a href="designer.html">Desinger of this website</a><!-- designer page footer -->	
	</div>
<body>
</html>