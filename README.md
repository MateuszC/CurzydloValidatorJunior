# CurzydloValidatorJunior.php

A PHP class that validates email addresses and passwords using regular expressions. The class includes robust validation for both fields, following common standards for secure and valid input.

## Table of Contents

1. [About the Project](#about-the-project)
2. [Getting Started](#getting-started)

## About the Project

The `CurzydloValidatorJunior.php` file contains a PHP class called `UserValidator`. It includes two methods that validate emails and passwords using regular expressions.

### Email Validation

The `validateEmail($email)` method checks the following:
- The email must start with one or more alphanumeric characters or certain symbols (`._%-`).
- Optionally, it can include a `+` followed by additional characters.
- A valid domain must follow, including optional subdomains, and a top-level domain of at least two characters.

### Password Validation

The `validatePassword($password)` method checks that:
- The password must contain at least one uppercase letter.
- It must contain at least one lowercase letter.
- It must contain at least one number.
- It must contain at least one special character.
- The total length must be at least 8 characters.

Both methods return a boolean (`true` or `false`) based on whether the input matches the defined regular expression.

## Getting Started

### Prerequisites

- PHP installed on your system (version 8.0+).

### Installation

1. Clone or download the `CurzydloValidatorJunior.php` file to your local machine.

```bash
git clone https://github.com/yourusername/CurzydloValidatorJunior.git