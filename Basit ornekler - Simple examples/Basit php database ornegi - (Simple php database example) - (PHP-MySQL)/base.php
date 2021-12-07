<?php
session_start(); //starting sessions from the begginig 
?>
<html> 
<head>
	<link rel="stylesheet" href="style.css">
	<title> e-Goverment </title> 
  <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
	<div class="container"><!-- same objects from index.php -->	
	<div class="card">
		
	<?php
		if(isset($_POST['base']))header("Location: base.php");// if button 'BACK' pressed this if block making back to base.php
		define('DB_SERVER', '127.0.0.1:3306');// localhost connection ip and port
		define('DB_USERNAME', 'root'); // mysql db username 
		define('DB_PASSWORD', '');// mysql db password
		define('DB_DATABASE', 'egoverment'); // mysql database witch we are going to use
		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); // we are making single connection string, so we can use rest of the code
		if($db === false){ // incase db cant connect
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		if(isset($_POST['socialSupporting']) && !empty($_POST['houseMembers']) && !empty($_POST['totalEarnings']) && !empty($_POST['explanation']) ){
			// if APPEAL named button pressed from socialSupport block that means rest of this code will progress.
			$sqlin = "INSERT INTO socialsupport(TC,houseMembers,totalEarnings,explanation)  
			VALUES(".$_SESSION['tc']." , ".$_POST['houseMembers']." ,".$_POST['totalEarnings'].",'".$_POST['explanation']."' )";//sql query inserting variables to socialsupport table
			if ($db->query($sqlin) === TRUE) { // if query goes well 
			echo "Social support application successfully sended. <br/>";//it will write that down to base.php
			}
		}
		if(isset($_POST['complainting'])&&!empty($_POST['title'])&&!empty($_POST['complaintText'])){
			//if SEND named button pressed from complaint block that means rest of this code will progress (of course inputs cant be empty)
			$sql = "INSERT INTO complaints (TC,title,complaintText)  
			VALUES ('".$_SESSION['tc']."', '".$_POST['title']."' ,'".$_POST['complaintText']."')";// sql query that inserting complaints to table
			if ($db->query($sql) === TRUE) { // if query goes well 
			echo "Complaint successfully sended. <br/>";//it will write that down to base.php
			}
			
		}
		if(isset($_POST['updating']) && !empty($_POST['password']) && !empty($_POST['address']) &&!empty($_POST['phoneNo']) ){
			//if UPDATE named button pressed from updateUser block that means rest of this block will progress
			$sql = "update citizeninfos SET phoneNo=".$_POST['phoneNo'].", adress='".$_POST['address']."', password='".$_POST['password']." '
					WHERE TC = ".$_SESSION['tc']."";// sql query string 
			
			if ($db->query($sql) === TRUE) { // query will progress if returns true 
			  echo "<script type='text/javascript'>alert('YOUR INFO HAS BEEN CHANGED YOU ARE EXITING');</script>"; // user password will be changed, so it will quit
			} else {
			  echo " Something gone wrong. " ;//if dont it will write this
			}
		}
		if(isset($_POST['adding']) && !empty($_POST['userName']) && !empty($_POST['address']) && !empty($_POST['phoneNo']) && !empty($_POST['mail']) && !empty($_POST['birthday']) ){
			// if ADD named button pressed from addUser block or new.php page that means rest of this block will progress
			$father_son = 0; // incase user under 18 year old, we are going to take his/her fathers TC
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // for the password string we are creating 
			$charactersLength = strlen($characters);// complicate string, 
			$randomString = '';// with for loop
			for ($i = 0; $i < 10; $i++) { // while strings lenght became 10 it randomly adding chars from long string. 
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$sql = "INSERT INTO citizeninfos (userName, adress, phoneNo,mail,birthdate,password) 
			VALUES ('".$_POST['userName']."', '".$_POST['address']."', '".$_POST['phoneNo']."', '".$_POST['mail']."', '".$_POST['birthday']."', '".$randomString."')";
			// insert query string for adding new user
			if ($db->query($sql) === TRUE) { // if query finish successfully 
			  echo "New citizen created successfully<br/>"; //this block will write 
			  $select = "select TC, password from citizeninfos where phoneNo = ".$_POST['phoneNo'].""; // but first we have to get last added row
			  $result = mysqli_query($db, $select);// witch we can get from its phone number
			  $rower = mysqli_fetch_array($result); // becouse like TC its unique 
			  echo "<script type='text/javascript'>alert('There is your info : TC: " . $rower["TC"]. "  Password: " . $rower["password"]. "');</script>";
			  // when we get TC and password those became session becouse new account cant see password without login
			  if($_SESSION['tc']==null){ // if session is not null (that contains if admin isnt adding this person)
				$_POST['tc'] =  $rower["TC"]; // adding post and session infos
				$_POST['password'] = $rower["password"];
				$_SESSION['tc'] = $rower["TC"];
				$_SESSION['password'] =$rower["password"];
			  }
			  $father_son = $rower['TC']; // incase user under 18 holding variables
			} else {
			  echo "Error: " . $sql . "<br>" . $db->error;
			}
			if(isset($_POST['fathers']) || !empty($_POST['fathers'])){ // if fathers input not came empty that means there should be father
			 $sqlfather = "INSERT INTO father_son(fathersTC, kidsTC) VALUES(".$_POST['fathers'].",".$father_son.")"; // we are inserting both TC's to father_son table
			 $db->query($sqlfather); // added without error
			}
		}
		if(isset($_POST['deleting']) && isset($_POST['TC'])  && !empty($_POST['TC']) ){
			//if DELETE named button pressed delete block, that means rest of this block will progress
		$sql = " delete from citizeninfos where TC=".$_POST['TC'].""; // delete sql query string
		if ($db->query($sql) === TRUE) {//if query goes well.
			echo "Citizen successfully deleted from database."; //it will write in base.php
		}
		else {
				echo "Error: there is no matching TC <br />"; // if cant find in table
			}
		}
		if(isset($_POST['exit'])) { $_SESSION['tc']=null; $_SESSION['password']=null; header("Location: index.php"); } // if exit button pressed it clearin the session and going back to index.php
		if (isset($_POST['newUser']) || isset($_POST['listOfUsers']) || isset($_POST['deleteUser']) || isset($_POST['updateUser']) || isset($_POST['seeOffspring'])|| isset($_POST['complaint'])|| isset($_POST['socialSupport'])) {
		// if any of buttons didnt get pressed up there that means buttons whos show info pressed
			if(isset($_POST['newUser'])){
				// if admin pressed Add new user button, this block will progress
				echo "Adding new citizen:"; 
				echo "<form action='' method='post'>Name: <input type='text' name='userName' /><br />";// action tag empty forms mean posts going this page again
				echo "Address: <input type='text' name='address' /><br />"; 
				echo "Telephone Number: <input type='text' name='phoneNo' min='10000000000' max='99999999999' /><br />";//telephone number must be 11 digit
				echo "Email: <input type='text' name='mail' /><br />";
				echo "Birthday(YYYY-MM-DD): <input type='text' name='birthday' /><br />";
				echo "<select name='age'>
					  <option value=''>Choose Age</option>
					  <option value='U'>Under 18</option>
					  <option value='O'>Over 18</option>
					</select>";
				echo " if Under 18 Father's TC: <input type='text' name='fathers' /><br />";
				echo "<input type='submit' name='adding' class='button' value='ADD' style='margin-top:15px' /><br/></form>";
				// when ADD button clicked this page loading again and posting variables in inputs.
			}
			if(isset($_POST['listOfUsers'])){
				// if admin clicked list of users button that block will progress
				echo "User list:<br/>"; 
					$sql = "SELECT TC, userName, adress, phoneNo,mail,birthdate,password FROM citizeninfos order by TC";
					$result = $db->query($sql);// sql query string 
					$i=0;//user count 
					if ($result->num_rows > 0) { // if there is more than 0 user it will progress
					  while($row = $result->fetch_assoc()) { //
						echo "".$i+1 .". citizen  TC: " . $row['TC']. " User Name: " . $row['userName']. " Address: " . $row['adress']. "  Telephone Number: " . $row['phoneNo']. " 
						<br/>E-Mail address: " . $row['mail']. " BirthDate: " . $row['birthdate']. " Password: " . $row['password']. " <br>"; $i++;
						// we writing in html page, without <p> tag or anything.
					  }
					} else {
					  echo "0 results"; // if not that means is no user
					}
			}
			if(isset($_POST['deleteUser'])){
				// when user deleted from citizeninfos trigger will add it to inactive users, automatically
				echo "Deleting user:<br />"; 
				echo "<form action='' method='post'>TC: <input type='text' name='TC' /><br />";
				echo "<input type='submit' name='deleting' class='button' value='DELETE' style='margin-top:15px' /><br/></form>";
				//we are sending TC with deleting button.
			}
			if(isset($_POST['updateUser'])){
				//we are collecting info from user 
				echo "Updating infos : ";
				echo "<form action='' method='post'>";
				echo "Address: <input type='text' name='address' /><br />";
				echo "Telephone Number: <input type='text' name='phoneNo' min='10000000000' max='99999999999'/><br />";
				echo "Password: <input type='text' name='password' /><br />";
				echo "<input type='submit' name='updating' class='button' value='UPDATE' style='margin-top:15px' /><br/></form>";
				//and sending up again
			}
			if(isset($_POST['seeOffspring'])){
				// if user wants to see offsprings this block will progress
				$offspr = "select * from father_son where fathersTC = ".$_SESSION['tc'].""; // sql query string to find kidsTC from fathers
				$i=0; // count of offsprings
				if($resultofspr = $db->query($offspr)){ // if there is any 
					while($rowofspr = $resultofspr->fetch_assoc()){ // work for each
						$sql = "SELECT TC, userName, adress, phoneNo,mail,birthdate FROM citizeninfos where TC = ".$rowofspr['kidsTC']." order by TC";
						// sql query string to find users where its TC matches kidsTC 
						$re = mysqli_query($db, $sql);//  // it works
						$rowofkid = mysqli_fetch_array($re);  // and gets 
							echo "".$i+1 .". citizen  TC: " . $rowofkid['TC']. " User Name: " . $rowofkid['userName']. " Address: " . $rowofkid['adress']. "  Telephone Number: " . $rowofkid['phoneNo']. " 
							<br/>E-Mail address: " . $rowofkid['mail']. " BirthDate: " . $rowofkid['birthdate']. " <br>"; $i++;
							// we are writing that.
						}
				}
				else {
				  echo "There is no offsprings"; // incase there is no match
				}
			}
			if(isset($_POST['complaint'])){ // if user clicked complaint button, this inputs what user going to see
				echo "<h2>Complaint :</h2><br />";
				echo "<form action='' method='post'>";
				echo "Title: <input type='text' name='title' /><br />";
				echo "Your complaint:<br /> <textarea cols='35' rows='5' name='complaintText'></textarea><br />";
				echo "<input type='submit' name='complainting' class='button' value='SEND' style='margin-top:15px' /><br/></form>";
				//when user click send all inputs goes with _POST variables
			}
			if(isset($_POST['socialSupport'])){ 
				// same, when user click this button will see inputs
				echo "<h2>Social support application :</h2><br />";
				echo "<form action='' method='post'>";
				echo "House Members: <input type='number' name='houseMembers'  min='1' max='99999'/><br />";
				echo "Total Earnings: <input type='number' name='totalEarnings' min='1' max='9999999999'/><br />";
				echo "Your explanation:<br /> <textarea cols='35' rows='5' name='explanation' ></textarea><br />";
				echo "<input type='submit' name='socialSupporting' class='button' value='APPEAL' style='margin-top:15px' /><br/></form>";
				// and inputs goes with _POST variables
		}}
		else{ // if user or admin didnt click any of buttons, first block that witch going to progress is this.
			if (isset($_POST['tc']) && isset($_POST['password']) && !empty($_POST['password'])&& !empty($_POST['tc'])) {
				// if tc and password came from main, it will pass to session.
				$_SESSION['tc']=$_POST['tc'];
				$_SESSION['password']=$_POST['password'];
			}
			if ($_SESSION['tc']=='MSTRPSSWRD' && $_SESSION['password']=='MSTRPSSWRD'){
				//if session tc and password equal to MSTRPSSWRD that means admin logged ing
				echo "<br/>Administrative login successful.";//admin will se 3 button: add new user, list of all users, delete a user.
				echo "<form action='' method='post'> 
					  <input type='submit' name='newUser' class='button' value='Add New User' style='margin-top:15px;' /><br/>
					  </form>";
				echo "<form action='' method='post'>
					  <input type='submit' name='listOfUsers' class='button' value='List Of All Users' style='' /><br/>
					  </form>";	  
				echo "<form action='' method='post'>
					  <input type='submit' name='deleteUser' class='button' value='Delete a User' style='' /><br/>
					  </form>";
			}
			else{ // if its not admin thats mean user tryin to login
				if (isset($_SESSION['tc']) && !empty($_SESSION['tc']) && isset($_SESSION['password']) && !empty($_SESSION['password'])) {
					// if sessions not empty or sended
					  $selecta = "select * from citizeninfos where TC = ".$_SESSION['tc']." AND password = '".$_SESSION['password']."'"; 
					  //sql query string for selecting row witch tc and password same with session
					  $res = mysqli_query($db, $selecta) ;
					  $row = mysqli_fetch_array($res); // request progress
					  if ($row['userName'] != null){// if rows username not empty that means successfully logged in.
						  echo "Welcome ".$row['userName']."
						  your informations: TC : ".$row['TC']."  address: ".$row['adress']." <br /> 
						  Telephone Number : ".$row['phoneNo']."  E-Mail Adress : ".$row['mail']." 
						  BirthDate : ".$row['birthdate']." "; // writing down users infos
						  
							  echo "<form action='' method='post'>
						  <input type='submit' name='updateUser' class='button' value='Update your information' style='margin-top:15px;' /><br/>
						  </form>";
							echo "<form action='' method='post'>
						  <input type='submit' name='seeOffspring' class='button' value='List of Offsprings' style='' /><br/>
						  </form>";	  
							echo "<form action='' method='post'>
						  <input type='submit' name='socialSupport' class='button' value='Social Support Appeal' style='' /><br/>
						  </form>";	  
							echo "<form action='' method='post'>
						  <input type='submit' name='complaint' class='button' value='Write a complaint' style='' /><br/>
						  </form>";	   // user going to see 4 buttons: update information, list of offsprings, social support appeal and complaint page
						  //any of buttons clicked it goes with name to this page again. 
						} 
						else {
							$_SESSION['tc']=null; // if there is no finded username 
							$_SESSION['password']=null; // sessions getting clear 
							header("Location: index.php"); // and goes index.php
						}
					  
					  
					  }
				else{
							header("Location: index.php"); // if someone tryin to sneek in without login return to index.php
				}
			}
		}
		// admin or user will see atleasy 2 buttons,
		echo		"<form action='' method='post'>
					<input type='submit' name='base' class='button' value='GOBACK' style='margin-top:15px' />
					</form>"; // one contains goback to base.php 
		echo		"<form action='' method='post'>
					<input type='submit' name='exit' class='button' value='EXIT' style='' /><br/>
					</form>"; // other one is exit the session and go back index.php
		$db->close(); // closing the database
		?>
		
	</div>
	</div>
	
	<div id="footer"> 
	<a href="designer.html">Desinger of this website</a>
	</div>
<body>
</html>