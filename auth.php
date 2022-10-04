<?php 
//* Session start
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (empty($email)) {
		header("Location: client/login.php?error=Email is required");
	}else if (empty($password)){
		header("Location: client/login.php?error=Password is required&email=$email");
	}else {

		//* Read User
        $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?email=' . $email);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $user = json_decode(curl_exec($curl), true);
		if (isset($user)) {
			$user_id = $user['id'];
			$user_email = $user['email'];
			$user_password = $user['password'];
			$user_name = $user['name'];
			if ($email === $user_email) {
				if (password_verify($password, $user_password)) {
					if (!$user['active']) {
						header("Location: client/login.php?error=Your account has been deactived. Please Contact Admin.");	
					} else {
						$_SESSION['user'] = $user;
					
						if ($user['type'] == "2") {
							header("Location: admin/main/index.php");
						} else {
							header("Location: client/homepage.php");
						}
					}

				}else {
					header("Location: client/login.php?error=Incorrect Email or password&email=$email");
				}
			}else {
				header("Location: client/login.php?error=Incorrect Email or password&email=$email");
			}
		}else {
			header("Location: client/login.php?error=Incorrect Email or password&email=$email");
		}
	}
}