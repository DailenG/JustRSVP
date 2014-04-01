<?php $code = $_GET['code'] ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sabrina and Dailen are Expecting!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/webflow.css">
  <link rel="stylesheet" type="text/css" href="css/custom.webflow.css">
  <script type="text/javascript" src="js/modernizr.js"></script>

</head>
<body>
  <div class="body">
    <div class="w-container content">
	<!-- ############# CONTENT CONTAINER ############# -->
	
      <h1>Sabrina and Dailen are Expecting!</h1>

		<?php
		if($_GET['view'])
		{

				echo "<h3>RSVP List</h3>";
				if($_GET['filter'])
					echo "<p><a href=\"?view=list\">View the full list</a></p>";
				if(!$_GET['filter'])
					echo "<p><a href=\"?view=list&filter=yes\">View RSVPs who said 'Yes'</a></p>";
				echo "<p>&nbsp;</p>";
		
			if($_GET['view'] == "list")
			{
				$file="sqlite:rsvp.sqlite";
				$db = new PDO($file) or die("Could not open database");

				// generate query string
				$query = "SELECT * FROM rsvp";

				// return PDO Statement object
				$result = $db->query($query);

				echo "<ol>\n";
				foreach($result as $row) {
			
					if($_GET['filter'] == "yes" && $row[5] == "Yes")
					{
						echo "<li>".$row[1]."</li>";
					}
					elseif(!$_GET['filter'])
					{
						echo "<li>".$row[1]."</li>";
							echo "<ul>";
								echo "<li>Address:".$row[2]."</li>";
								echo "<li>Email:".$row[3]."</li>";
								echo "<li>Mobile:".$row[4]."</li>";
								echo "<li>Response:".$row[5]."</li>";
								echo "<li>Note:".$row[6]."</li>";
							echo "</ul>";
					}
						
						}
				echo "</ol>\n";
				$db=NULL;
			}
			
		}
		elseif($_POST['qualify'])
		{
			if($_POST['qualify_code'] == "706")
			{
				echo "<form method=\"post\" style=\"margin:0px;padding:0px;\">";
				echo "<p>Thanks for your interest! We hope you can come but if not please just let us know too! We'll certainly miss you!</p><p>&nbsp;</p>";
				
				echo "<table align=\"center\" style=\"width: 240px;\">";
				echo "<tr><td>Full Name*</td><td>&nbsp;&nbsp;&nbsp;</td><td><input name=\"form_name\"></td></tr>";
				echo "<tr><td>Address</td><td>&nbsp;&nbsp;&nbsp;</td><td><input name=\"form_address\"></td></tr>";
				echo "<tr><td>Email</td><td>&nbsp;&nbsp;&nbsp;</td><td><input name=\"form_email\"></td></tr>";
				echo "<tr><td>Mobile*</td><td>&nbsp;&nbsp;&nbsp;</td><td><input name=\"form_mobile\"></td></tr>";
				echo "<tr><td>Response</td><td>&nbsp;&nbsp;&nbsp;</td><td><select name=\"form_response\"><option>Select One</option><option value=\"Yes\">Yes</option><option value=\"No\">No</option></select></td></tr>";
				echo "<tr><td colspan=\"3\">Note</td></tr><tr><td colspan=\"3\"><textarea name=\"form_note\" style=\"width: 240px;\"></textarea></td></tr>";
				echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
				echo "<tr><td colspan=\"3\" align=\"right\"><input type=\"submit\" name=\"update\"></td></tr>";
				echo "</table>";
				echo "</form>";
			}
			else
			{
				echo "Sorry! <a href=\"\">Go back</a> and try again!";
			}		

		}
		elseif($_POST['update'])
		{

			$form_name = trim($_POST['form_name']);
			$form_address = trim($_POST['form_address']);
			$form_email = trim($_POST['form_email']);
			$form_mobile = trim($_POST['form_mobile']);
			$form_response = trim($_POST['form_response']);
			$form_note = trim($_POST['form_note']);


			$file="sqlite:rsvp.sqlite";
			$db = new PDO($file) or die("Could not open database");

			// generate query string
			$query = "INSERT INTO 'RSVP' ('rsvp_id','rsvp_name','rsvp_address','rsvp_email','rsvp_mobile','rsvp_response','rsvp_note') VALUES (NULL,'$form_name','$form_address','$form_email','$form_mobile','$form_response','$form_note')";

			// return PDO Statement object
			$result = $db->query($query);

			if($result->rowCount() > 0)
			   echo "Thanks for letting us know! We'll be in touch!";
			else
			   echo "Something went wrong :-(";

			$db=NULL;
		}
		else
		{
		?>

		<p>Please join us as we celebrate Sabrina and Dailen's new arrival on April 13, 2014 @ 2:30pm! To RSVP just enter the RSVP code you were given below and follow the instructions!</p>
			  <p>&nbsp;</p>
			  <div class="rsvp_qualify" align="center">
				<form method="post" style="margin:0px; padding:0px;">
				<?php
				if($_GET['code'])
				{
					?>
					RSVP Code:
					<input type="text" name="qualify_code" value="<?php echo "$code"; ?>" onfocus="if(this.value == '<?php echo "$code"; ?>') {this.value=''}" onblur="if(this.value == ''){this.value ='<?php echo "$code"; ?>'}" />
					<?
				}
				else
				{
					?>
					<input type="text" name="qualify_code" value="RSVP Code" onfocus="if(this.value == 'RSVP Code') {this.value=''}" onblur="if(this.value == ''){this.value ='RSVP Code'}" />
					<?
				}
				?>

				<input type="submit" name="qualify">
				</form>
			  </div>
			  <p>&nbsp;</p>
			  <p>They're registered at Babies R Us, if you need other options please let <a href="mailto:me@dailen.net">Dailen</a> know! Please see the link below to check their registry!</p>

		<?
		}
		?>	    

			  <div class="registries">
				&nbsp;<br/><a href="http://www.toysrus.com/registry/link/index.jsp?overrideStore=TRUS&registryNumber=52516550#.UzoW98AZ10A.email"><img src="images/babiesrus_logo.png" alt="5338b5dcec4fad1e47000af2_babiesrus_logo.png"/></a>
			  </div>
	  
	<!-- ############# CONTENT CONTAINER ############# -->
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="js/webflow.js"></script>
</body>
</html>


