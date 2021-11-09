
// =================================================================== //
//
// Code by: Thijn
//
// used for: email verification
// usage path: pages/6code-verification/index.php
// 
// =================================================================== //

const inputElement = document.getElementById('verification_code');
const submitButton = document.getElementById('submit');

// in the email-verification/index.php there is a couple lines of PHP code
// this code will make another error message when it see's a error in the $_SESSION variable
// to avoid multiple error messages this will check if a error made by PHP code is already made
// and then get the right element
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
inputElement.addEventListener('input', checkCodeValidity);

function checkCodeValidity() {
    // this function check if the code is valid acording to the requirements
    // the if statements in this funcion contain a '!error' condition
    // this is to ensure that the right error is displayed one at a time

    // check if code field has a value
    if (inputElement.value === '') {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
        return;
    }

    // make error boolean default value
    error = false;

    // check if code is 8 characters
    if (inputElement.value.length !== 6 && !error) {
        error = true;
        errorMessage = 'code moet 6 lang zijn'
    }


    if (error) {
        errorElement.classList.remove('displayNone')
        errorElement.innerHTML = errorMessage;
        isCodeValid = false;
    } else {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
        isCodeValid = true;
    }
    checkButtonClickable();
}

function checkButtonClickable() {
    // action="../../includes/signup.inc.php"

    if (isCodeValid) {
        submitButton.classList.remove('submitdisabled')
        submitButton.classList.add('submitenabled')

        submitButton.disabled = false;

    } else {
        submitButton.classList.add('submitdisabled')
        submitButton.classList.remove('submitenabled')

        submitButton.disabled = true;
    }
}
