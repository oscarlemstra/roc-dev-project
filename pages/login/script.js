const emailElement = document.getElementById('email')
const passwordElement = document.getElementById('pwd');
const submitButton = document.getElementById('submit');
const errorElement = document.getElementById('error');

// classname of display none:
// displayNone

// special characters
// !@#$%^&*

let error = false;
let errorMessage = '';

passwordElement.addEventListener('input', () => {
    if (passwordElement.value.length < 8) {
        error = true;
        errorMessage = 'please enter 8 characters or more'
    }
    else error = false;

    let isnum = /^\d+$/.test(passwordElement.value);
    if (isnum && !error) {
        error = true;
        errorMessage = 'please also enter letter'
    }
    else error = false;

    let islet = /^[a-zA-Z]/.test(passwordElement.value)
    if (islet && !error) {
        error = true;
        errorMessage = 'please also enter a number'
    }
    else error = false;

    let isUp = /[A-Z]/.test(passwordElement.value);
    if (!isUp && !error) {
        error = true;
        errorMessage = 'please ensure you have atleast 1 capital letter'
    }
    else error = false;

    let email = emailElement.value;
    let name = email.substring(0, email.lastIndexOf("@"))
    if (passwordElement.value.includes(name) && !error) {
        error = true;
        errorMessage = 'password should not contain email name'
    }
    else error = false;

    if (error) console.log(passwordElement.value.includes(name), passwordElement.value, name)
    
});