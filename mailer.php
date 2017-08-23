<?php 
$errmsg = "";
$results = ""; // to send data back to ajax call

function clean($data) {
	$data = trim(stripslashes(strip_tags($data)));
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$results = "request method = post";

	// collect, sanitize, validate input
	if (empty($_POST['name'])) {
		$errmsg .= "Missing required information: NAME<br />";
	} else {
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
	      $errmsg .= "Only letters and white space allowed in NAME field<br />";
	    } else {
	    	$name = clean(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
	    }
	}

	if (empty($_POST['email'])) {
		$errmsg .= "Missing required information: EMAIL<br />";
	} else {
		if (!preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', strtolower($_POST['email']))) {
	      $errmsg .= "Invalid email format<br />";
	    } else {
	    	$email = clean(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
	    }
	}

	if(isset($_POST['income'])) {
		$income = ($_POST['income']);
		// switch case to convert value to useable info
		switch ($income) {
			case 'a':
				$incomeStatement = "Estimated monthly income is less than $2,500.";
				break;
			case 'b':
				$incomeStatement = "Estimated monthly income is between $2,500 and $4,000.";
				break;
			case 'c':
				$incomeStatement = "Estimated monthly income is between $4,000 and $6,000.";
				break;
			case 'd':
				$incomeStatement = "Estimated monthly income is over $6,000.";
				break;
			case 'e':
				$incomeStatement = "Unsure of estimated monthly income at this time.";
				break;
			default: 
				$incomeStatement = "Estimated monthly income not selected.";
		}
	} else { $incomeStatement = "Estimated monthly income not selected."; }

	if(isset($_POST['debt'])) {
		$debt = ($_POST['debt']);
		// switch case to convert value to useable info
		switch ($debt) {
			case 'a':
				$debtStatement = "Estimated monthly debt is less than $500.";
				break;
			case 'b':
				$debtStatement = "Estimated monthly debt is between $500 and $1,000.";
				break;
			case 'c':
				$debtStatement = "Estimated monthly debt is between $1,000 and $1,500.";
				break;
			case 'd':
				$debtStatement = "Estimated monthly debt is over $1,500.";
				break;
			case 'e':
				$debtStatement = "Unsure of estimated monthly debt at this time.";
				break;
			default: 
				$debtStatement = "Estimated monthly debt not selected.";
		}
	} else { $debtStatement = "Estimated monthly debt not selected."; }

	if(isset($_POST['score'])) {
		$score = ($_POST['score']);
		// switch case to convert value to useable info
		switch ($score) {
			case 'a':
				$scoreStatement = "Estimated FICO score is less than 600.";
				break;
			case 'b':
				$scoreStatement = "Estimated FICO score is between 600 and 649.";
				break;
			case 'c':
				$scoreStatement = "Estimated FICO score is between 650 and 700.";
				break;
			case 'd':
				$scoreStatement = "Estimated FICO score is over 700.";
				break;
			case 'e':
				$scoreStatement = "Unsure of FICO score at this time.";
				break;
			default: 
				$scoreStatement = "Estimated FICO score not selected.";
		}
	} else { $scoreStatement = "Estimated FICO score not selected."; }

	if(isset($_POST['late'])) {
		$late = ($_POST['late']);
		// switch case to convert value to useable info
		switch ($late) {
			case 'y':
				$lateStatement = "Yes, there has been a late payment in the last 12 months.";
				break;
			case 'n':
				$lateStatement = "No, there has not been a late payment in the last 12 months.";
				break;
			default:
				$lateStatement = "Late payments question not answered.";
		}
	} else { $lateStatement = "Late payments question not answered."; }

	if(isset($_POST['bankrupt'])) {
		$bankrupt = ($_POST['bankrupt']);
		// switch case to convert value to useable info
		switch ($bankrupt) {
			case 'y':
				$bankruptStatement = "Yes, there has been a bankruptcy in the last 7 years.";
				break;
			case 'n':
				$bankruptStatement = "No, there has not been a bankruptcy in the last 7 years.";
				break;
			default:
				$bankruptStatement = "Bankruptcy question not answered.";
		}
	} else { $bankruptStatement = "Bankruptcy question not answered."; }
	
	if(isset($_POST['selling'])) {
		$selling = ($_POST['selling']);
		// switch case to convert value to useable info
		switch ($selling) {
			case 'y':
				$sellingStatement = "Yes, there is a home to sell as well.";
				break;
			case 'n':
				$sellingStatement = "No, there is no home to sell at this time.";
				break;
			default:
				$sellingStatement = "Selling a home question not answered.";
		}
	} else { $sellingStatement = "Selling a home question not answered."; }

	if(isset($_POST['buynow'])) {
		$buynow = ($_POST['buynow']);
		// switch case to convert value to useable info
		switch ($buynow) {
			case 'y':
				$buynowStatement = "Yes, ready to purchase a new home in the next 3 months.";
				break;
			case 'n':
				$buynowStatement = "No, not ready to purchase a new home in the next 3 months.";
				break;
			case 'u':
				$buynowStatement = "Unsure if ready to purchase a new home right now.";
				break;
			default:
				$buynowStatement = "Ready to purchase question not answered.";
		}
	} else { $buynowStatement = "Ready to purchase question not answered."; }

	if(isset($_POST['down'])) {
		$down = ($_POST['down']);
		// switch case to convert value to useable info
		switch ($down) {
			case 'a':
				$downpayStatement = "Current ammount available for a down payemnt is less than $2,500.";
				break;
			case 'b':
				$downpayStatement = "Current ammount available for a down payemnt is between $2,500 and $4,000.";
				break;
			case 'c':
				$downpayStatement = "Current ammount available for a down payemnt is between $4,000 and $6,000.";
				break;
			case 'd':
				$downpayStatement = "Current ammount available for a down payemnt is over $6,000.";
				break;
			case 'e':
				$downpayStatement = "Unsure of available amount for a down payment at this time.";
				break;
			default: 
				$downpayStatement = "Down payment amount not selected.";
		}
	} else { $downpayStatement = "Down payment amount not selected."; }

	if(isset($_POST['location'])) {
		$locationStatement = "Looking to buy within the following location(s): ";
		foreach (($_POST['location']) as $location) {
			$locationStatement .= $location ." ";
		}
	} else {
		$locationStatement = "No purchase location was selected.";
	}

	if(isset($_POST['via'])) {
		$contactMethod = ($_POST['via']);
		$contactStatement = "Best way to reach out: " . $contactMethod . " ";
		if ($contactMethod == 'phone') {
			if(empty($_POST['telephone'])) {
 				$errmsg .= "Phone number missing<br />"; 
			} else {
				$phoneNum = clean(filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT));
				$contactStatement .= "at " . $phoneNum . " ";
			}
		} else {
			$contactStatement .= ": " . $email . " ";
		}
	} else { $contactStatement = "No preferred contact method selected."; }


	if(isset($_POST['timeofday'])) {
		$contactStatement .= "\r\nBest time to reach out is ";
		foreach (($_POST['timeofday']) as $daytime) {
			$contactStatement .= $daytime . " ";
		}
	} else {
		$contactStatement .= "\r\nNo time of day was seleceted as best to be contacted.";
	}

	if (empty($_POST['comments'])) {
		$comments = "no comment supplied";
	} else {
		$comments = clean(filter_var($_POST['comments'], FILTER_SANITIZE_STRING));
	}


	if(empty($errmsg)) {
		// message one = email to site owners
		$results = "No error messages - proceed to build. \r\n";
		
		$to1 = /*insert receiving email address here*/;

		$subject1 = "Form submission from WAHomeGrants.com";

		$message1 = "Someone has completed the form on WAHomeGrants.com - Please see the details below: \r\n";
		$message1 .= "Name/Email: " . $name ." [" . $email . "]\r\n";
		$message1 .= "Message/Comments: " . $comments . "\r\n\r\n";

		$message1 .= $incomeStatement . "\r\n"; 
		$message1 .= $debtStatement . "\r\n"; 
		$message1 .= $scoreStatement . "\r\n";
		$message1 .= $lateStatement . "\r\n"; 
		$message1 .= $bankruptStatement . "\r\n"; 
		$message1 .= $sellingStatement . "\r\n";
		$message1 .= $buynowStatement . "\r\n"; 
		$message1 .= $downpayStatement . "\r\n";
		$message1 .= $locationStatement . "\r\n"; 
		$message1 .= $contactStatement . "\r\n"; 

		$headers1  = "From: $name <$email>\r\n";
		$headers1 .= "Reply-To: $email\r\n";

		$mail1status = mail($to1, $subject1, $message1, $headers1);

		if ($mail1status) {
			$results = "Your message has been sent! Watch your inbox for more information.";

			// message two = confirmation email to site visitor
			$to2 = $email;

			$subject2 = "Thank you for visiting WAHomeGrants.com";

			$message2 =  $name. ", \r\n\r\n";
			$message2 .= "Thank you for visiting WAHomeGrants.com and completing our form. Below are the details you submitted: \r\n";
			$message2 .= "Name/Email: " . $name ." [" . $email . "]\r\n";
			$message2 .= "Message/Comments: " . $comments . "\r\n\r\n";

			$message2 .= $incomeStatement . "\r\n"; 
			$message2 .= $debtStatement . "\r\n";
			$message2 .= $scoreStatement . "\r\n";
			$message2 .= $lateStatement . "\r\n";
			$message2 .= $bankruptStatement . "\r\n";
			$message2 .= $sellingStatement . "\r\n";
			$message2 .= $buynowStatement . "\r\n";
			$message2 .= $downpayStatement . "\r\n"; 
			$message2 .= $locationStatement . "\r\n";
			$message2 .= $contactStatement . "\r\n\r\n";

			// add more content here as defined by Skip and/or Traci
			$message2 .= "Please note, none of this information is stored or otherwise saved, and it will be used solely for the purpose of providing home-buying guidance and possibly free down payment assistance. You have not been added to any mailing lists, however you may still receive messages with more information regarding this subject. If you would rather not receive these, simply reply to this email with the subject line 'REMOVE'.\r\n\r\n";

			$message2 .= "A certified loan professional will be in touch with you directly within 2 business days.";

			$mail2status = mail($to2, $subject2, $message2, $headers2);
			if($mail2status == 1) { $results .= " Second message sent."; }

		} else { // mail 1 not sent
			$results = $errmsg;
		}

	// if error messages present and message not created
	} else {
		$results = $errmsg;
	}

} else {
	$results = "Could not execute - request method != POST";
}

echo $results;
?>
