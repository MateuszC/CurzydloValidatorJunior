<?php


class UserValidator {
    
    public function validateEmail(string $email): bool {
        $EmailRegex = '/^[a-zA-Z0-9._%-]+(\+?[a-zA-Z0-9._%-]+)?@[a-zA-Z0-9_%+-]+(\.[a-zA-Z0-9_%+-]+)*\.[a-zA-Z]{2,}$/';
        /*
            [a-zA-Z0-9._%-]+ - przynajmniej jeden znak litera albo cyfra albo znaki specjalne ._%-
            (\+?[a-zA-Z0-9._%-]+)? - opcjonalnie jeden znak '+' oraz ciąg znaków jak powyżej
            @ - dokładnie jeden znak @
            [a-zA-Z0-9_%+-]+ - przynajmniej jeden znak litera albo cyfra albo znaki specjalne - (domena)
            (\.[a-zA-Z0-9_%+-]+)* - subdomeny/domeny
            \.[a-zA-Z]{2,} - conajmniej dwie litery po kropce
        */
        return preg_match($EmailRegex,$email) === 1;
	}
    
    public function validatePassword(string $password): bool {
        $PasswordRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,}$/';
        /*
            . - dowolny znak
            .* - zero lub więcej wystąpień
            (?=.*[A-Z]) - czy duża litera
            (?=.*[a-z]) - czy mała litera
            (?=.*[0-9]) - czy cyfra
            (?=.*[\W_]) - czy znak specjalny
            .{8,} - czy minimum 8 znaków
        */
        return preg_match($PasswordRegex, $password) === 1;
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
