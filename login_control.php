<?php 

//index.php
include 'db.php';

$externalContent = file_get_contents('http://checkip.dyndns.com/');


$message = '';
$formdata = [];

if (isset($_POST["login_button"])) {


	

    // Email Validation
    if (empty($_POST["user_email"])) {
        $message .= '<li>Email Address is required</li>';
    } elseif (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {
        $message .= '<li>Invalid Email Address</li>';
    } else {
        $formdata['user_email'] = $_POST['user_email'];
    }

    // Password Validation
    if (empty($_POST['user_password'])) {
        $message .= '<li>Password is required</li>';
    } else {
        $formdata['user_password'] = md5($_POST['user_password']);
    }

    if ($message == '') {
        $user_email = $formdata['user_email'];

        // Fetch user with email
        $query = "SELECT * FROM user_login WHERE user_email = :email";
        $statement = $connect->prepare($query);
        $statement->bindParam(':email', $user_email);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            foreach ($statement->fetchAll() as $row) {

                // Match password
                if ($row['user_password'] === $formdata['user_password']) {
					

                    $today = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

					// Clone to preserve $today
					$present = clone $today;
					$present->modify('-1 days');
					

					
					

					$expdate = new DateTime($row['expeiry_date']);
					if ($expdate >= $present) { 
					//echo $row['user_email'];exit;

                        session_start();
                        session_regenerate_id();
                        $user_session_id = session_id();

                        // Update session ID in DB
                        $update_query = "
                            UPDATE user_login 
                            SET user_session_id = :session_id 
                            WHERE id = :id
                        ";
                        $update_stmt = $connect->prepare($update_query);
                        $update_stmt->execute([
                            ':session_id' => $user_session_id,
                            ':id' => $row['id']
                        ]);

                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_email'] = $row['user_email'];
                        $_SESSION['username'] = $row['user_name'];
                        $_SESSION['remote_ip'] = $row['remote_ip'];
                        $_SESSION['user_session_id'] = $user_session_id;

                        // Redirect based on user type
                        if ($_SESSION['user_id'] == 1) {
                            header('location:/admin');
                        } else {
							preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);

							$externalIp = $m[1];
							

							if($externalIp != $_SESSION['remote_ip'] && $externalIp != null){
								header('location:/');
								
							}
							else{
								header('location:home_page.php');
							}
                            
                        }
                        
                    } else {
                        $message = '<li>Your account is expired on'.$row['expeiry_date'].'. Contact admin.</li>';
                    }
                } else {
                    $message = '<li>Wrong Password</li>';
                }
            }
        } else {
            $message = '<li>Wrong Email Address</li>';
        }
    }
}



?>