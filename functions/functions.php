<?php


function clean($string) {


return htmlentities($string);


}



function redirect($location){


return header("Location: {$location}");

}


function set_message($message) {


	if(!empty($message)){


		$_SESSION['message'] = $message;

	}else {

		$message = "";

	}


}



function display_message(){


	if(isset($_SESSION['message'])) {


		echo $_SESSION['message'];

		unset($_SESSION['message']);

	}



}



function token_generator(){


$token = $_SESSION['token'] =  md5(uniqid(mt_rand(), true));

return $token;


}


function validation_errors($error_message) {

$error_message = <<<DELIMITER

<div class="mb-8 w-full text-white text-center font-semibold px-2 py-3 rounded-md bg-red-400 bg-alert alert-danger alert-dismissible" role="alert">
  	$error_message
</div>
DELIMITER;

return $error_message;





}



function email_exists($email) {

	$sql = "SELECT id FROM users WHERE email = '$email'";

	$result = query($sql);

	if(row_count($result) == 1 ) {

		return true;

	} else {


		return false;

	}



}



function username_exists($username) {

	$sql = "SELECT id FROM users WHERE username = '$username'";

	$result = query($sql);

	if(row_count($result) == 1 ) {

		return true;

	} else {


		return false;

	}



}

function validate_user_registration() {

	$errors = [];

	$min = 3;
	$max = 20;



	if($_SERVER['REQUEST_METHOD'] == "POST") {


		$email 				= clean($_POST['email']);
		$password			= clean($_POST['password']);
		$confirm_password	= clean($_POST['confirm_password']);


		if(email_exists($email)){

			$errors[] = "Sorry that email already is registered";

		}




		if(strlen($email) < $min) {

			$errors[] = "Your email cannot be more than {$max} characters";

		}

		if($password !== $confirm_password) {

			$errors[] = "Your password fields do not match";

		}



		if(!empty($errors)) {

			foreach ($errors as $error) {

			echo validation_errors($error);


			}


		} else {


			if(register_user($email, $password, $paid, $startdate, $enddate)) {



				set_message("<p class='bg-success text-center'>Please Sign in</p>");

				redirect("/signin");


			} else {


				set_message("<p class='bg-danger text-center'>Sorry, sign up failed.</p>");

				redirect("/signup");

			}



		}



	}



}

function register_user($email, $password, $paid, $startdate, $enddate) {

	$email      = escape($email);
	$password   = escape($password);
	$paid       = escape($paid);
	$startdate  = escape($startdate);
	$enddate    = escape($enddate);



	if(email_exists($email)) {


		return false;

	} else {

		$password   = md5($password);
		$validation_code = md5($password + microtime());
		$thestart = date('m-d-Y');
        $sevendays = strtotime("+7 day");
        $theend = date('m-d-Y', $sevendays);
		$sql = "INSERT INTO users (email, password, active, paid, startdate, enddate, credits)";
		$sql.= " VALUES('$email','$password', 1, 'no', '$thestart', '$theend', '100')";
		$result = query($sql);
		confirm($result);

		$id = "SELECT id FROM users WHERE email = '$email'";
		$id_result = query($id);
		
		validate_user_login();

		return true;

	}



}

function validate_user_login(){

	$errors = [];

	$min = 3;
	$max = 20;



	if($_SERVER['REQUEST_METHOD'] == "POST") {


		$email 		= clean($_POST['email']);
		$password	= clean($_POST['password']);
		$remember   = isset($_POST['remember']);




		if(empty($email)) {

			$errors[] = "Email field cannot be empty";

		}


		if(empty($password)) {

			$errors[] = "Password field cannot be empty";

		}



		if(!empty($errors)) {

				foreach ($errors as $error) {

				echo validation_errors($error);


				}


			} else {


				if(login_user($email, $password, $remember)) {


					redirect("/");


				} else {


				echo validation_errors("Your password is not correct");



				}



			}



	}


}


	function login_user($email, $password, $remember) {


		$sql = "SELECT password, id FROM users WHERE email = '".escape($email)."' AND active = 1";

		$result = query($sql);

		if(row_count($result) == 1) {

			$row = fetch_array($result);

			$db_password = $row['password'];


			if(md5($password) === $db_password) {

				if($remember == "on") {

					setcookie('email', $email, time() + 86400);

				}


				$_SESSION['email'] = $email;



				return true;

			} else {


				return false;
			}









			return true;

		} else {


			return false;



		}



	}



function logged_in(){

	if(isset($_SESSION['email']) || isset($_COOKIE['email'])){


		return true;

	} else {


		return false;
	}




}