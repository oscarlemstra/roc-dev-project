
// =================================================================== //
//
// Code by: Thijn
//
// used for: password reset
// usage path: pages/set-wachtwoord/index.php
// 
// =================================================================== //

const passwordElement = document.getElementById('pwd');
const passwordElement2 = document.getElementById('pwd2');
const submitButton = document.getElementById('submit');
const emailVak = document.getElementById('email_vak');

// in the signup/index.php there is a couple lines of PHP code
// this code will make another error message when it see's a error in the $_SESSION variable
// to avoid multiple error messages this will check if a error made by PHP code is already exists
// and then store that element
// if not it will make a error message element
let errorElement;
if (document.getElementById('error')) {
    errorElement = document.getElementById('error');
} else {
    let myElem = document.createElement('div');
    myElem.classList.add('error');
    myElem.classList.add('displayNone');
    myElem.setAttribute("id", "error");

    document.getElementsByClassName('container')[0].appendChild(myElem);
    
    errorElement = document.getElementById('error');
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
passwordElement.addEventListener('input', checkPwdValidity);
passwordElement2.addEventListener('input', checkPwdValidity);


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
    let email = emailVak.innerHTML.toLowerCase();
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
        
        submitButton.classList.add('submitdisabled')
        submitButton.classList.remove('submitenabled')

        submitButton.disabled = true;
    } else {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
        
        submitButton.classList.remove('submitdisabled')
        submitButton.classList.add('submitenabled')

        submitButton.disabled = false;
    }
}
