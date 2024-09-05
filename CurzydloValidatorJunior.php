<?php


class UserValidator {

	public function validateEmail(string $email): bool {
        return false;
	}

    public function validatePassword(string $password): bool {
        return false;
    }
}





$validator = new UserValidator();

$email = "test@example.com";
$password = "StrongPass1!";

if ($validator->validateEmail($email)) {
    echo "Email is valid.<br>";
} else {
    echo "Email is invalid.<br>";
}
if ($validator->validatePassword($password)) {
    echo "Password is valid.<br>";
} else {
    echo "Password is invalid.<br>";
}



?>
