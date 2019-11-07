<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>

		<?php
		# Ex 4 :
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		$checking = true;
		$values = array($_POST["Name"], $_POST["ID"], $_POST["Credit"], $_POST["cc"]);
		foreach ($values as $value) {
			if(!isset($value) || $value === ''){
				$checking = false;
				break;
			}
		}
		if(!isset($_POST["CSE326"]) && !isset($_POST["CSE107"]) && !isset($_POST["CSE603"]) && !isset($_POST["CIN870"])) {
			$checking = false;
		}
		?>

		<!-- Ex 4 :
			Display the below error message :
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		-->
		<?php
		if(!$checking) { ?>
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>

		<?php
		# Ex 5 :
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (!preg_match("/^[a-zA-Z\- ]*$/", $_POST["Name"])) {
		?>

		<!-- Ex 5 :
			Display the below error message :
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		-->
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>
		<?php
		# Ex 5 :
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5.
	} elseif (!preg_match("/^[0-9]{16}$/", $_POST["Credit"]) || ($_POST["cc"]==="visa" && !preg_match("/^4[0-9]{15}$/", $_POST["Credit"])) || ($_POST["cc"]==="mastercard" &&!preg_match("/^5[0-9]{15}$/", $_POST["Credit"]))) {
		?>

		<!-- Ex 5 :
			Display the below error message :
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		-->
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>
		<?php
		# if all the validation and check are passed
		} else {
		?>

			<h1>Thanks, looser!</h1>
			<p>Your information has been recorded.</p>

			<!-- Ex 2: display submitted data -->

			<ul>
				<li>Name: <?=$_POST["Name"]?></li>
				<li>ID: <?=$_POST["ID"]?></li>
				<!-- use the 'processCheckbox' function to display selected courses -->
				<li>Course: <?=processCheckbox(array("CSE326", "CSE107", "CSE603", "CIN870"))?></li>
				<li>Grade: <?=$_POST["grade"]?></li>
				<li>Credit Card: <?=$_POST["Credit"]?> (<?=$_POST["cc"]?>)</li>
			</ul>

			<!-- Ex 3 :
				<p>Here are all the loosers who have submitted here:</p> -->
			<p>Here are all the loosers who have submitted here:</p>
			<?php
				$filename = "loosers.txt";
				$contents = array($_POST["Name"], $_POST["ID"], $_POST["Credit"], $_POST["cc"]);
				$new_line = implode(";", $contents);
				file_put_contents($filename, "\n$new_line", FILE_APPEND);
				/* Ex 3:
				 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
				 * For example, "Scott Lee;20110115238;4300523877775238;visa"
				 */
		?>
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
			<pre>
				<?= file_get_contents($filename) ?>
			</pre>

		<?php
		}
		?>

		<?php
			/* Ex 2:
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 *
			 * The function checks whether the checkbox is selected or not and
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				$text = array();
				foreach ($names as $name) {
					if(isset($_POST[$name])) {
						array_push($text, $name);
					}
				}
				return implode(", ", $text);
			}
		?>
	</body>
</html>
