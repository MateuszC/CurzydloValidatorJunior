<?php


class UserValidator {
	
	private const EmailRegex = '/^[a-zA-Z0-9._%-]+(\+?[a-zA-Z0-9._%-]+)?@[a-zA-Z0-9_%+-]+(\.[a-zA-Z0-9_%+-]+)*\.[a-zA-Z]{2,}$/';
	private const PasswordRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,}$/';

	public function validateEmail(string $email): bool {
        /*
            [a-zA-Z0-9._%-]+ - przynajmniej jeden znak litera albo cyfra albo znaki specjalne ._%-
            (\+?[a-zA-Z0-9._%-]+)? - opcjonalnie jeden znak '+' oraz ciąg znaków jak powyżej
            @ - dokładnie jeden znak @
            [a-zA-Z0-9_%+-]+ - przynajmniej jeden znak litera albo cyfra albo znaki specjalne - (domena)
            (\.[a-zA-Z0-9_%+-]+)* - subdomeny/domeny
            \.[a-zA-Z]{2,} - conajmniej dwie litery po kropce
        */
        return preg_match(UserValidator::EmailRegex,$email) === 1;
	}

    public function validatePassword(string $password): bool {
        /*
            . - dowolny znak
            .* - zero lub więcej wystąpień
            (?=.*[A-Z]) - czy duża litera
            (?=.*[a-z]) - czy mała litera
            (?=.*[0-9]) - czy cyfra
            (?=.*[\W_]) - czy znak specjalny
            .{8,} - czy minimum 8 znaków
        */
        return preg_match(UserValidator::PasswordRegex, $password) === 1;
    }
}








$testCases = [
    'emails' => [
        ['email' => 't@example.com', 'expected' => true],
        ['email' => 'te@example.com', 'expected' => true],
        ['email' => 'tes@example.com', 'expected' => true],
        ['email' => 'test@example.com', 'expected' => true],
        ['email' => 'test@example.com', 'expected' => true],
        ['email' => 'test_test@example.com', 'expected' => true],
        ['email' => 'test%test@example.com', 'expected' => true],
        ['email' => 'test-test@example.com', 'expected' => true],
        ['email' => 'test.test@example.com', 'expected' => true],
        ['email' => 'test__test@example.com', 'expected' => true],
        ['email' => 'test%%test@example.com', 'expected' => true],
        ['email' => 'test--test@example.com', 'expected' => true],
        ['email' => 'test..test@example.com', 'expected' => true],

        ['email' => 'test1@example.com', 'expected' => true],
        ['email' => 'test_1@example.com', 'expected' => true],
        ['email' => 'test_a123@example.com', 'expected' => true],
        ['email' => 'test-a123@example.com', 'expected' => true],
        ['email' => 'test.a123@example.com', 'expected' => true],
        ['email' => 'test.a123.a123@example.com', 'expected' => true],
        ['email' => 'test-a123-a123@example.com', 'expected' => true],
        ['email' => 'test-a123.a123@example.com', 'expected' => true],
        ['email' => 'test.a123-a123@example.com', 'expected' => true],
        ['email' => 'user.name+a@example.co.uk', 'expected' => true],
        ['email' => 'user.name+alias@example.co.uk', 'expected' => true],
        ['email' => 'user.name+alias+alias@example.co.uk', 'expected' => false],
        ['email' => 'user.name+@example.co.uk', 'expected' => false],
        ['email' => '+a@example.co.uk', 'expected' => false],
        ['email' => '+@example.co.uk', 'expected' => false],
        
        ['email' => 'test@sub.example.com', 'expected' => true],
        ['email' => 'test@sub1.example.com', 'expected' => true],
        ['email' => 'test@sub2.sub1.example.com', 'expected' => true],

        ['email' => 'test@170.com', 'expected' => true],
        ['email' => 'test@sub.170.com', 'expected' => true],
        ['email' => 'test@sub.a170.com', 'expected' => true],
        
        ['email' => 'test@a.com', 'expected' => true],
        ['email' => 'test@1.com', 'expected' => true],
        ['email' => 'test@1a.com', 'expected' => true],

        ['email' => 'test_no_domain@', 'expected' => false],
        ['email' => '@example_no_name.com', 'expected' => false],
        ['email' => 'test@.no_dom_name  ', 'expected' => false],
        ['email' => 'test@no_top_lvl', 'expected' => false],
        ['email' => 'test@domain.co', 'expected' => true],
        ['email' => '12345@domain.com', 'expected' => true],
        ['email' => 'user.name@top_lvl_too_short.c', 'expected' => false],
        ['email' => 'test@dot_at_end.com.', 'expected' => false],
        ['email' => 'test@two_dots..com', 'expected' => false],
        ['email' => 'test@two_dots..two_dots.com', 'expected' => false],
        ['email' => 'test@two_dots.two_dots..com', 'expected' => false],
        ['email' => 'test@three_dots...com', 'expected' => false],
        ['email' => 'test@four_dots....com', 'expected' => false],
        ['email' => 'test@....four_dots2....com', 'expected' => false],
        ['email' => 'test@..com', 'expected' => false],

        ['email' => 'user@domain.a', 'expected' => false],
        ['email' => 'user@domain.ab', 'expected' => true],
        ['email' => 'user@domain.abc', 'expected' => true],
        ['email' => 'user@domain.abcd', 'expected' => true],
        ['email' => 'user@domain.abcde', 'expected' => true],
        ['email' => 'user@domain.abcdef', 'expected' => true],
    ],

    'passwords' => [
        ['password' => 'StrongPass1!', 'expected' => true],
        ['password' => 'weakpass', 'expected' => false],
        ['password' => 'Short1!', 'expected' => false],
        ['password' => 'NoNumber!', 'expected' => false],
        ['password' => 'NOLOWERCASE1!', 'expected' => false],
        ['password' => 'nolowercase1!', 'expected' => false],
        ['password' => 'MissingSpecial1', 'expected' => false],
        ['password' => 'PerfectlyFinePass1$', 'expected' => true],
        ['password' => 'Strong_1!', 'expected' => true],
        ['password' => '1234567890', 'expected' => false],
        ['password' => 'abcdefghi', 'expected' => false],
        ['password' => 'Password123!', 'expected' => true],
        ['password' => 'AlmostRight1', 'expected' => false],
        ['password' => 'Correct$123', 'expected' => true],
        ['password' => 'ValidPassword!2', 'expected' => true],
        ['password' => 'SpecialChar@1', 'expected' => true],
        ['password' => 'nouppercase1@', 'expected' => false],
        ['password' => 'UppercaseNoSpecial1', 'expected' => false],
        ['password' => 'VerySecurePass!2', 'expected' => true],
        ['password' => 'P@ssw0rd', 'expected' => true],
        ['password' => '@', 'expected' => false],
        ['password' => '@@@@@@@@@@', 'expected' => false],
        ['password' => 'Xx1@@@', 'expected' => false],
        ['password' => 'Xx1@@@@', 'expected' => false],
        ['password' => 'Xx1@@@@@', 'expected' => true],
        ['password' => 'Xx1@@@@@@', 'expected' => true],
    ]
];







$validator = new UserValidator();

echo "<h3>Testing Emails:</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>Test Passed</th>
        <th>Validation Should Be</th>
        <th>Validation Is</th>
        <th>Checked Value</th>
      </tr>";

$allCorrect = true;
foreach ($testCases['emails'] as $case) {
    $email = $case['email'];
    $expected = $case['expected'];
    $result = $validator->validateEmail($email);
    
    $testPassed = $result === $expected;
    $testColor = $testPassed ? 'green' : 'red';
    $testStr = $testPassed ? "Pass" : "Fail";
    $expectedStr = $expected ? "Valid" : "Invalid";
    $resultStr = $result ? "Valid" : "Invalid";
    $allCorrect = $allCorrect && $testPassed;
    
    echo "<tr>
            <td style='color: $testColor'>$testStr</td>
            <td>$expectedStr</td>
            <td>$resultStr</td>
            <td>$email</td>
          </tr>";
}

echo "</table>";
if($allCorrect) echo "<p style='color:green;'>All Test Passed</p>"; else echo "<p style='color:red;'>Some test are invalid</p>";
echo "<br>";


echo "<h3>Testing Passwords:</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>Test Passed</th>
        <th>Validation Should Be</th>
        <th>Validation Is</th>
        <th>Checked Value</th>
      </tr>";

$allCorrect = true;
foreach ($testCases['passwords'] as $case) {
    $password = $case['password'];
    $expected = $case['expected'];
    $result = $validator->validatePassword($password);
    
    $testPassed = $result === $expected;
    $testColor = $testPassed ? 'green' : 'red';
    $testStr = $testPassed ? "Pass" : "Fail";
    $expectedStr = $expected ? "Valid" : "Invalid";
    $resultStr = $result ? "Valid" : "Invalid";
    $allCorrect = $allCorrect && $testPassed;
    
    echo "<tr>
            <td style='color: $testColor'>$testStr</td>
            <td>$expectedStr</td>
            <td>$resultStr</td>
            <td>$password</td>
          </tr>";
}

echo "</table>";
if($allCorrect) echo "<p style='color:green;'>All Test Passed</p>"; else echo "<p style='color:red;'>Some test are invalid</p>";
echo "<br>";



?>
