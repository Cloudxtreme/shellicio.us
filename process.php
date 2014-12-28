<?php
//Include DB Credentials and Connection
include('db.php');

// Generate Random Alpha Numeric String
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Generate Random Numeric String
function generateNumber($length = 8) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Human Readable Seconds
function secs_to_h($secs)
{
        $units = array(
                "week"   => 7*24*3600,
                "day"    =>   24*3600,
                "hour"   =>      3600,
                "minute" =>        60,
                "second" =>         1,
        );

	// specifically handle zero
        if ( $secs == 0 ) return "0 seconds";

        $s = "";

        foreach ( $units as $name => $divisor ) {
                if ( $quot = intval($secs / $divisor) ) {
                        $s .= "$quot $name";
                        $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                        $secs -= $quot * $divisor;
                }
        }

        return substr($s, 0, -2);
}

// Write Credentials Files
function writeCredentials() {
	$file = "/web/shellicio.us/creds/" . $_SESSION['session_user'] . ".txt";
	if (file_exists($file)) {
	} else {
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= '<html>';
		$current .= '<div style=font-size:1.3em;>Thank you for using Shellicio.us! Here is your receipt.</div><br />';		
		$current .= '<div style=font-size:1em;><table><tr><td><img src="https://shellicio.us/images/logo_email.png"></td><td>';
		$current .= "Shellicio.us Credentials<br />";
		$current .= "========================<br /><br />";	
		$current .= "Username: <span style=font-size:1.4em;font-weight:bold;background-color:#ffffcc;>" . $_SESSION['session_user'] . "</span><br />";
		$current .= "Password: <span style=font-size:1.4em;font-weight:bold;background-color:#ffffcc;>" . $_SESSION['session_pass'] . "</span><br />";
		$current .= "Web Location: <span style=font-size:1.4em;font-weight:bold;background-color:#ffffcc;>https://shellicio.us/~" . $_SESSION['session_user'] . "</span><br />";
		$current .= '</td></tr></table><br />';
		$current .= '<div style=font-size:1.3em;>If you need assistance, please email <a href="mailto:contact@joestrusz.com?subject=Support">contact@shellicio.us</a>. This set of credentials will expire on <b>'.date('F jS, Y',$_SESSION['session_time_stop']).'</b> at <b>'.date('h:i:s A',$_SESSION['session_time_stop']).'</b>.</div><br />';
		$current .= '<div style=font-size:1.3em;>&copy; Shellicio.us - All rights reserved.</div></div>';
		$current .= '</html>';		
		// Write the contents back to the file
		file_put_contents($file, $current);
	}	
}

//Start newCred Function
if($_GET['function'] == 'newCred') {

	// Server should keep session data for AT LEAST 12 hours
	ini_set('session.gc_maxlifetime', 43200);
	
	// Each client should remember their session id for EXACTLY 12 hours
	session_set_cookie_params(43200);
		
	// Session Length
	$timeout = 43200;
	
	// Start Session
	session_start();
	
	// Check if Session Already Exists
	if(!isset($_SESSION['session_identifier'])) { 
		// If We Haven't Created our Special Session, Do So Now
		$_SESSION['session_identifier'] = "Shellicio.us Session";
		$_SESSION['session_user'] = generateRandomString(); 
		$_SESSION['session_pass'] = generateNumber('4');
		$_SESSION['session_ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['session_email'] = $_GET['email'];
		$_SESSION['session_browser'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['session_time_start'] = time();	
		$_SESSION['session_time_stop'] = time() + $timeout;	
	}
	
	// Check if Session is Expired, If so, Destroy
	if($_SESSION['session_time_stop'] < time()) {
		session_destroy();
	}
	
	$timeleft = $_SESSION['session_time_stop'] - time();
	
	writeCredentials();	

	//Grab the POST Values and make them Pretty
	$usernameCred = $_SESSION['session_user'];
	$usernamePass = $_SESSION['session_pass'];
	$credEmail = $_GET['email'];		

	//Launches our Create user Script - Accepts add/update username password	
	$command = "sudo /scripts/adduser.sh add $usernameCred $usernamePass";
	system("".$command."");

	//Emails the User and System Administartor the new Credentials	
	system('sudo cat /web/shellicio.us/creds/'.$usernameCred.'.txt | mail -s "$(echo "[Shellicio.us] Credentials Receipt\nContent-Type: text/html")" -a "From: Shellicio.us Support <contact@shellicio.us>" '.$credEmail.' contact@shellicio.us');
	echo "Done! Credentials emailed to " . $credEmail . " for user " . $usernameCred . ".";

	//Create connection
	mysql_connect($dbServer, $dbUser, $dbPass);
	mysql_select_db($dbName) or die( "Unable to select database");
	
	$insertIP = $_SERVER['REMOTE_ADDR'];
	$insertStartTime = $_SESSION['session_time_start'];
	$insertStopTime = $_SESSION['session_time_stop'];
	
	//The Query
	$sql = "INSERT INTO sessions (username,password,email,db_database,db_username,db_password,ip_address,start_time,stop_time,status) VALUES ('$usernameCred','$usernamePass','$credEmail','db_$usernameCred','$usernameCred','$usernamePass','$insertIP','$insertStartTime','$insertStopTime','active');";
	
	//Execute the Query
	mysql_query($sql);
	
	//Close Connection
	mysql_close();

//End newCred Function
} 

?>
