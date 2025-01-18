const signupRadio = document.querySelector("main > div > div:nth-of-type(2) > div:first-of-type > input");
const loginRadio = document.querySelector("main > div > div:nth-of-type(3) > div:first-of-type > input");
const signupForm = document.querySelector("main > div > div:nth-of-type(2) > div:last-of-type");
const loginForm = document.querySelector("main > div > div:nth-of-type(3) > div:last-of-type");
const signupContainer = document.querySelector("main > div > div:nth-of-type(2)");
const loginContainer = document.querySelector("main > div > div:last-of-type");

// Inizializza visibilità
signupForm.style.display = "none"; // Nasconde il form di signup

// Aggiungi evento al radio button
signupRadio.addEventListener("change", function () {
    if (signupRadio.checked) {
        signupForm.style.display = "block";
        signupContainer.classList.replace("bg-secondary", "bg-light");
        loginForm.style.display = "none";
        loginContainer.classList.replace("bg-light", "bg-secondary");
    }
});

loginRadio.addEventListener("change", function () {
    if (loginRadio.checked) {
        loginForm.style.display = "block";
        loginContainer.classList.replace("bg-secondary", "bg-light");
        signupForm.style.display = "none";
        signupContainer.classList.replace("bg-light", "bg-secondary");
    }
});
