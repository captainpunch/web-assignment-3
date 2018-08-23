
<!-- GRANT SCHORGL -->
<?php
//============== CONSTANTS =========== GRANT SCHORGL
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{						
	define('SINGLE', 6254);
	define('DUEL', 3147);	
	define('MEALPLAN14',3147.00);
	define('MEALPLAN19',3363.00);
	define('SECONDFEE',26.53);
	define('FIRSTFEE',73.21);
	define('PRIVILEGEFEE',365);
	define('INSTATE', 268.80);
	define('OUTOFSTATE', 713.60);
	$LIVINGCOST = '';
	$MEALPLAN = '';
	$PRIVLAGEFEE = '';
	$error = false;
	$TOTALSTATE = "";
		
	if(isset($_POST['submit'])) 
	{	
			//$name = $_POST['name'];
			if (empty($_POST['name'])) 
			{
				echo "<p>ERROR: Name is empty</p>";
				$error = true;
				}
			else 
			{
				$name = $_POST['name'];
				echo "Welcome ".$name. '!';
				echo nl2br("\n");
			}
			
			$HOURS = $_POST['hours'];
			$TOTALFEE = '';
			$placeholder = '';
			if ($HOURS == 0) 
			{
				echo "<p>ERROR: you aren't taking any hours</p>";
				$error = true;
			}
			else 
			{
				if ($HOURS >= 12)
				{
					$TOTALFEE += PRIVILEGEFEE;
					$placeholder = $HOURS-1;
					$placeholder *= SECONDFEE;
					$placeholder += FIRSTFEE;
					$TOTALFEE += $placeholder;
				}
				else
				{
					$placeholder = $HOURS-1;
					$placeholder *= SECONDFEE;
					$placeholder += FIRSTFEE;
					$TOTALFEE += $placeholder;
				}
				echo 'You are planning on taking:' . $HOURS .' hours';
			}
				
			
			$state = $_POST['state'];
			if ($state == "OutOfState" ){$TOTALSTATE = OUTOFSTATE * $HOURS;}
			elseif($state == "InState" ){$TOTALSTATE = INSTATE * $HOURS;}
			else 
			{
				print '<p>ERROR IN SELECTING TUITION</p>';
				$error = true;
			}
			
			
			$living = $_POST['living'];
			if ($living == "OffCampus")
			{
				$LIVINGCOST = 0;
				if (isset($_POST['meal']) && ($_POST['meal'] == "meal14")) {$MEALPLAN = MEALPLAN14;}
				elseif(isset($_POST['meal']) && ($_POST['meal'] == "meal19")){$MEALPLAN = MEALPLAN19;}
				elseif(isset($_POST['meal']) && ($_POST['meal'] == "nomeal")){$MEALPLAN = 0;}
				else 
				{
					echo "<p>ERROR: please select a meal plan for living off campus</p>";
					$error = true;
				}
			}
			elseif($living == 'Single')
			{
				$LIVINGCOST = SINGLE;
				if (isset($_POST['meal']) && ($_POST['meal'] == "meal14")) {$MEALPLAN = MEALPLAN14;}
				elseif(isset($_POST['meal']) && ($_POST['meal'] == "meal19")){$MEALPLAN = MEALPLAN19;}
				elseif(isset($_POST['meal']) && ($_POST['meal'] == "nomeal")){$MEALPLAN = 0;}
				else 
				{
					echo "<p>ERROR: please select a meal plan for your single room</p>";
					$error = true;
				}
			}
			elseif($living == 'Duel') 
			{
				$LIVINGCOST = DUEL;
				if (isset($_POST['meal']) && ($_POST['meal'] == "meal14")) 
					{	
					$MEALPLAN = MEALPLAN14;
					}
				elseif(isset($_POST['meal']) && ($_POST['meal'] == "meal19"))
					{
						$MEALPLAN = MEALPLAN19;
					}
				elseif(isset($_POST['meal']) && ($_POST['meal'] == "nomeal")){$MEALPLAN = 0;}
				else 
				{
					"<p>ERROR: please select a meal plan for your double room</p>";
					$error = true;
				}
			}
			else 
			{
				echo "<p>ERROR: please select living arrangements</p>";
				$error = true;
			}
			
			if(!isset($_POST['state'] , $_POST['name'] , $_POST['living'] , $_POST['meal']))
			{
				echo 'isset error';
				$error = true;
			}
			else
			{	
				$error = false;
				$TOTAL=$LIVINGCOST+$TOTALSTATE+$MEALPLAN+$TOTALFEE;
				echo nl2br("\n");
				echo 'Your cost of living is: $'.number_format( $LIVINGCOST,2).nl2br("\n");
				echo 'your class total is: $'.number_format( $TOTALSTATE,2).nl2br("\n");
				echo 'Your dinning cost is $'.number_format( $MEALPLAN,2).nl2br("\n");
				echo 'Your fees are $';
				echo number_format($TOTALFEE,2);
				echo nl2br("\n");
				echo "Your total cost this semester is $".number_format($TOTAL,2).nl2br("\n");
			}
	}
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HTML5 Template</title>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<style>
body{
background-color: #512888;
color: #FFFFFF;}
</style>
<body>
<?php 
if ($error= true) {  ?>
	<form action="form_handler2.php" method="post">
		<fieldset><legend>Please fill out the form below to calculate your cost at KSU Polytechnic.</legend>
		<p><label>Name: <input type="text" name="name" size="20" maxlength="40" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"/></label></p>
		
		<p><label>How many hours are you taking?<select name="hours">
			<option value="0"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '0')) echo ' selected="selected"'; ?> >0 hour</option>
			<option value="1"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '1')) echo ' selected="selected"'; ?> >1 hour</option>
			<option value="2"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '2')) echo ' selected="selected"'; ?> >2 hours</option>
			<option value="3"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '3')) echo ' selected="selected"'; ?> >3 hours</option>
			<option value="4"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '4')) echo ' selected="selected"'; ?> >4 hours</option>
			<option value="5"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '5')) echo ' selected="selected"'; ?> >5 hours</option>
			<option value="6"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '6')) echo ' selected="selected"'; ?> >6 hours</option>
			<option value="7"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '7')) echo ' selected="selected"'; ?> >7 hours</option>
			<option value="8"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '8')) echo ' selected="selected"'; ?> >8 hours</option>
			<option value="9"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '9')) echo ' selected="selected"'; ?> >9 hours</option>
			<option value="10"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '10')) echo ' selected="selected"'; ?> >10 hours</option>
			<option value="11"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '11')) echo ' selected="selected"'; ?> >11 hours</option>
			<option value="12"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '12')) echo ' selected="selected"'; ?> >12 hours</option>
			<option value="13"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '13')) echo ' selected="selected"'; ?> >13 hours</option>
			<option value="14"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '14')) echo ' selected="selected"'; ?> >14 hours</option>
			<option value="15"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '15')) echo ' selected="selected"'; ?> >15 hours</option>
			<option value="16"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '16')) echo ' selected="selected"'; ?> >16 hours</option>
			<option value="17"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '17')) echo ' selected="selected"'; ?> >17 hours</option>
			<option value="18"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '18')) echo ' selected="selected"'; ?> >18 hours</option>
			<option value="19"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '19')) echo ' selected="selected"'; ?> >19 hours</option>
			<option value="20"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '20')) echo ' selected="selected"'; ?> >20 hours</option>
			<option value="21"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '21')) echo ' selected="selected"'; ?> >21 hours</option>
		</select></label></p>
		
		<p><label>Instate or out of state student?<br>
			<input type="radio" name="state" value="InState" <?php if (isset($_POST['state']) && ($_POST['state'] == 'InState')) echo ' checked="checked"'; ?>/> Instate <br> 
			<input type="radio" name="state" value="OutOfState" <?php if (isset($_POST['state']) && ($_POST['state'] == 'OutOfState')) echo ' checked="checked"'; ?>/> Out of state</label><br></p>
		
		<p><label>Will you be living in the dorms?<br>	
			<input type="radio" name="living" value="OffCampus"<?php if (isset($_POST['living']) && ($_POST['living'] == 'OffCampus')) echo ' checked="checked"'; ?> /> Off Campus<br></label>
			<input type="radio" name="living" value="Single" <?php if (isset($_POST['living']) && ($_POST['living'] == 'Single')) echo ' checked="checked"'; ?>/> Single<br>
			<input type="radio" name="living" value="Duel" <?php if (isset($_POST['living']) && ($_POST['living'] == 'Duel')) echo ' checked="checked"'; ?>/> Duel room<br></label></p>
			
		<p><label>Meal Plan:<br>
			<input type="radio" name="meal" value="meal14" <?php if (isset($_POST['meal']) && ($_POST['meal'] == 'meal14')) echo ' checked="checked"'; ?> /> 14 meals per week<br>
			<input type="radio" name="meal" value="meal19" <?php if (isset($_POST['meal']) && ($_POST['meal'] == 'meal19')) echo ' checked="checked"'; ?> > 19 meals per week</input><br>
			<input type="radio" name="meal" value="nomeal" <?php if (isset($_POST['meal']) && ($_POST['meal'] == 'nomeal')) echo ' checked="checked"'; ?>/> No Meal plan</label><br></p>  
  
		<input class="submit" type="submit" name="submit" value="Submit">
		</fieldset>
	</form>
<?php 
}
?>
</body>
</html>



