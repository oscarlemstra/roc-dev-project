
// =================================================================== //
//
// Code by: Thijn
//
// used for: Signup
// usage path: pages/signup/index.php
//
// Copyright (c) Thijn Douwma
// fuck you get your own code
// 
// =================================================================== //

const emailElement = document.getElementById('email');
const emailElement2 = document.getElementById('email2');
const passwordElement = document.getElementById('pwd');
const passwordElement2 = document.getElementById('pwd2');
const submitButton = document.getElementById('submit');

// in the signup/index.php there is a couple lines of PHP code
// this code will make another error message when it see's a error in the $_SESSION variable
// to avoid multiple error messages this will check if a error made by PHP code is already made
// and then get the right element
let errorElement;
if (document.getElementById('error2')) {
    errorElement = document.getElementById('error2');
} else {
    errorElement = document.getElementById('error')
}

// default values
let error = false;
let errorMessage = '';

let isEmailValid = false;
let isPasswordValid = false;

submitButton.disabled = true;
submitButton.classList.add('submitdisabled')
submitButton.classList.remove('submitenabled')

// event listeners
emailElement.addEventListener('input', checkEmailValidity);
emailElement2.addEventListener('input', checkEmailValidity);
passwordElement.addEventListener('input', checkPwdValidity);
passwordElement2.addEventListener('input', checkPwdValidity);

function checkEmailValidity() {
    error = false;

    emailAdress = emailElement.value.split('@')
    arrayLength = emailAdress.length;
    if (emailAdress[arrayLength - 1] !== 'student.rocvf.nl' && !error) {
        error = true;
        errorMessage = 'email is niet een school email adress'
    }

    if ((emailElement.value !== emailElement2.value) && !error) {
        error = true;
        errorMessage = 'emails zijn niet hetzelfde';
    }


    if (error) {
        errorElement.classList.remove('displayNone')
        errorElement.innerHTML = errorMessage;
        isEmailValid = false;
    } else {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
        isEmailValid = true;
    }
    checkButtonClickable();
}

function checkPwdValidity() {
    // this function check if the password is valid acording to the requirements
    // the if statements in this funcion contain a '!error' condition
    // this is to ensure that the right error is displayed one at a time

    // check if password field has a value
    if (passwordElement.value === '') {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
        return;
    }

    // make error boolean default value
    error = false;

    // check if password is 8 characters or longer
    if (passwordElement.value.length < 8 && !error) {
        error = true;
        errorMessage = 'wachtwoord 8 of meer characters hebben'
    }

    // check if password contains a number
    let isnum = /\d/.test(passwordElement.value);
    if (!isnum && !error) {
        error = true;
        errorMessage = 'wachtwoord heeft ook een nummer nodig'
    }

    // check if password contains a letter
    let isletter = /[a-zA-Z]/.test(passwordElement.value)
    if (!isletter && !error) {
        error = true;
        errorMessage = 'wachtwoord heeft ook een letter nodig'
    }

    // check if password contains a capital letter
    let isUppercase = /[A-Z]/.test(passwordElement.value);
    if (!isUppercase && !error) {
        error = true;
        errorMessage = 'wachtwoord heeft tenminste 1 hoofdletter nodig'
    }

    // check if password contains the email name
    let email = emailElement.value.toLowerCase()
    let name = email.substring(0, email.lastIndexOf("@")).toLowerCase()
    
    if (name !== '') {
        if (passwordElement.value.includes(name) && !error) {
            error = true;
            errorMessage = 'wachtwoord kan niet email naam bevatten'
        }
    }

    if ((passwordElement.value !== passwordElement2.value) && !error) {
        error = true;
        errorMessage = 'wachtwoorden moeten hetzelfde zijn';
    }


    if (error) {
        errorElement.classList.remove('displayNone')
        errorElement.innerHTML = errorMessage;
        isPasswordValid = false;
    } else {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
        isPasswordValid = true;
    }
    checkButtonClickable();
}

function checkButtonClickable() {
    // action="../../includes/signup.inc.php"

    if (isEmailValid && isPasswordValid) {
        submitButton.classList.remove('submitdisabled')
        submitButton.classList.add('submitenabled')

        submitButton.disabled = false;

    } else {
        submitButton.classList.add('submitdisabled')
        submitButton.classList.remove('submitenabled')

        submitButton.disabled = true;
    }
}
