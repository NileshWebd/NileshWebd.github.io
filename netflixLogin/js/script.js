var x = document.getElementById("pass");               // Input
var s = document.getElementById("show");               // Show pass
var h = document.getElementById("hide");               // Hide pass

function togglePass() {
    if (x.type === "password") {
        x.type = 'text';
        s.style.display = 'none';
        h.style.display = 'inline';
    } else {
        x.type = 'password';
        s.style.display = 'inline';
        h.style.display = 'none';
    }   
}

var passContainer = document.getElementById("passcontainer");
var rates = document.getElementById("rates");
var signincode = document.getElementById("signincode");
var redbutton = document.getElementById("redbutton");
var forgotep = document.getElementById("forgotep");
var errorpass = document.getElementById("errorTwo");
var alertmsg = document.getElementById("alertmsg");

let signincodeValue = document.getElementById("signincode").innerHTML;
let redbuttonValue = document.getElementById("redbutton").innerHTML;
let forgotepValue = document.getElementById("forgotep").innerHTML;

function signCode() {
    if(signincode.innerHTML == "Use a sign-in code" ){
        passContainer.style.display ='none';
        errorpass.style.display ='none';
        rates.style.display ='block';
        signincode.innerHTML = 'Use password';
        redbutton.innerHTML = 'Send sign-in code';
        forgotep.innerHTML = 'Forgot email or phone number?';
        alertmsg.style.display ='none';
    }else{
        passContainer.style.display ='block';
        errorpass.style.display ='block';
        rates.style.display ='none';
        signincode.innerHTML = signincodeValue;
        redbutton.innerHTML = redbuttonValue;
        forgotep.innerHTML = forgotepValue;
    }
}


const input = document.getElementById("email");
const inputTwo = document.getElementById("pass");
const error = document.getElementById("error");
const errorTwo = document.getElementById("errorTwo");

// when input loses focus
input.addEventListener("blur", function () {
    if (this.value.length < 4) {
        error.textContent = "Please enter a valid email address.";
        input.classList.add("error-border");
    }
});

// when input gets focus
input.addEventListener("focus", function () {
    error.textContent = "";
    input.classList.remove("error-border");
});

// when input loses focus
inputTwo.addEventListener("blur", function () {
    if (this.value.length < 4 || this.value.length > 60 ) {
        errorTwo.textContent = "Your password must contain between 4 and 60 characters.";
        inputTwo.classList.add("error-border");
    }
});

// when input gets focus
inputTwo.addEventListener("focus", function () {
    errorTwo.textContent = "";
    inputTwo.classList.remove("error-border");
});





document.getElementById("loginForm").addEventListener("submit", function(event) {
    let email = document.getElementById("email");
    let pass = document.getElementById("pass");

    // let emailError = document.getElementById("emailError");
    // let passError = document.getElementById("passError");

    let hasError = false;

    // Reset old errors
    // emailError.textContent = "";
    // passError.textContent = "";
    // email.classList.remove("error-border");
    // pass.classList.remove("error-border");

    // Email validation
    if (email.value.trim() === "") {
        error.textContent = "Please enter a valid email address.";
        email.classList.add("error-border");
        hasError = true;
    }

    // Password validation
    if (pass.value.trim() === "") {
        errorTwo.textContent = "Your password must contain between 4 and 60 characters.";
        pass.classList.add("error-border");
        hasError = true;
    }

    // If any error found => stop PHP from running
    if (hasError) {
        event.preventDefault();   // ⛔ stops form submission
    }
});
