const signupRadio = document.getElementById("signup");
const loginRadio = document.getElementById("login");
const signupForm = document.getElementById("signup-form");
const loginForm = document.getElementById("login-form");
const signupContainer = document.getElementById("signup-container");
const loginContainer = document.getElementById("login-container");

// Inizializza visibilità
signupForm.style.display = "none"; // Nasconde il form di signup

// Aggiungi evento al radio button
signupRadio.addEventListener("change", function () {
    if (signupRadio.checked) {
        signupForm.style.display = "block";
        signupContainer.style.backgroundColor = "white";
        loginForm.style.display = "none";
        loginContainer.style.backgroundColor = "#bdbdbd";
    }
});

loginRadio.addEventListener("change", function () {
    if (loginRadio.checked) {
        loginForm.style.display = "block";
        loginContainer.style.backgroundColor = "white";
        signupForm.style.display = "none";
        signupContainer.style.backgroundColor = "#bdbdbd";
    }
});
