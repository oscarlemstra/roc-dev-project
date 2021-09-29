const emailElement = document.getElementById('email');
const emailElement2 = document.getElementById('email2');
const passwordElement = document.getElementById('pwd');
const passwordElement2 = document.getElementById('pwd2');
const submitButton = document.getElementById('submit');

let errorElement;
if (document.getElementById('error2')) {
    errorElement = document.getElementById('error2');
} else {
    errorElement = document.getElementById('error')
}

let error = false;
let errorMessage = '';

emailElement.addEventListener('input', checkEmailValidity);
emailElement2.addEventListener('input', checkEmailValidity);
passwordElement.addEventListener('input', checkPwdValidity);
passwordElement2.addEventListener('input', checkPwdValidity);

function checkPwdValidity() {
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
        errorMessage = 'please enter 8 characters or more'
    }

    // check if password contains a number
    let isnum = /\d/.test(passwordElement.value);
    if (!isnum && !error) {
        error = true;
        errorMessage = 'please also enter number'
    }

    // check if password contains a letter
    let isletter = /[a-zA-Z]/.test(passwordElement.value)
    if (!isletter && !error) {
        error = true;
        errorMessage = 'please also enter a letter'
    }

    // check if password contains a capital letter
    let isUppercase = /[A-Z]/.test(passwordElement.value);
    if (!isUppercase && !error) {
        error = true;
        errorMessage = 'please ensure you have atleast 1 capital letter'
    }

    // check if password contains the email name
    let email = emailElement.value;
    let name = email.substring(0, email.lastIndexOf("@"))
    
    if (name !== '') {
        if (passwordElement.value.includes(name) && !error) {
            error = true;
            errorMessage = 'password should not contain email name'
        }
    }

    if ((passwordElement.value !== passwordElement2.value) && !error) {
        error = true;
        errorMessage = 'password needs to be the same';
    }


    if (error) {
        errorElement.classList.remove('displayNone')
        errorElement.innerHTML = errorMessage;
    } else {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
    }
    
}

function checkEmailValidity() {
    error = false;

    if ((emailElement.value !== emailElement2.value) && !error) {
        error = true;
        errorMessage = 'email needs to be the same';
    }


    if (error) {
        errorElement.classList.remove('displayNone')
        errorElement.innerHTML = errorMessage;
    } else {
        errorElement.classList.add('displayNone')
        errorElement.innerHTML = '';
    }
}