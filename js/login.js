const signupRadio = document.querySelector("main > div > div:nth-of-type(2) > div:first-of-type > input");
const loginRadio = document.querySelector("main > div > div:nth-of-type(3) > div:first-of-type > input");
const signupForm = document.querySelector("main > div > div:nth-of-type(2) > form");
const signUpButton = document.querySelector("main > div > div:nth-of-type(2) > form > div:last-of-type > input");
const loginForm = document.querySelector("main > div > div:nth-of-type(3) > form");
const loginButton = document.querySelector("main > div > div:nth-of-type(3) > form > div:last-of-type > input");
const signupContainer = document.querySelector("main > div > div:nth-of-type(2)");
const loginContainer = document.querySelector("main > div > div:last-of-type");
const isSeller = document.querySelector("main > div > div:nth-of-type(3) > form > div:nth-last-of-type(2) > input");
const errorSignup = document.querySelector("main > div > div:nth-of-type(2) > div:last-of-type");
const errorLogin = document.querySelector("main > div > div:nth-of-type(3) > div:last-of-type");

// Inizializza visibilità
signupForm.style.display = "none"; // Nasconde il form di signup

// Aggiungi evento al radio button
signupRadio.addEventListener("change", function () {
    if (signupRadio.checked) {
        errorLogin.innerHTML = "";
        errorSignup.innerHTML = "";
        signupForm.style.display = "block";
        signupContainer.classList.replace("bg-secondary", "bg-light");
        loginForm.style.display = "none";
        loginContainer.classList.replace("bg-light", "bg-secondary");
    }
});

loginRadio.addEventListener("change", function () {
    if (loginRadio.checked) {
        errorLogin.innerHTML = "";
        errorSignup.innerHTML = "";
        loginForm.style.display = "block";
        loginContainer.classList.replace("bg-secondary", "bg-light");
        signupForm.style.display = "none";
        signupContainer.classList.replace("bg-light", "bg-secondary");
    }
});

// Richiesta post di login
async function login(formData, seller) {
    const url = "../api/api-login.php";
    
    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        
        let json;
        try {
            // Prova a parsare il JSON
            json = await response.json();
        } catch (parseError) {
            console.error("Errore nel parsing della risposta JSON:", parseError);
            json = null; // Imposta a null se non è parsabile
        }
        
        if (!response.ok) {
            // Gestione degli errori con risposta non OK
            if (response.status === 401) {
                errorLogin.innerHTML = `<p>${json["message"]}</p>`;
            } else {
                errorLogin.innerHTML = `<p>Errore durante il login.</p>`;
            }
        } else {
            // Login riuscito
            errorLogin.innerHTML = `<p class="text-success">${json["message"]}</p>`;
            setTimeout(() => {
                window.location.href = "../php/home.php";
            }, 1500);
        }
    } catch (error) {
        // Errore di rete o altro problema
        console.error("Errore nella richiesta di rete:", error);
    }
}

// Richiesta post di signup
async function signup(formData) {
    const url = "../api/api-signup.php";
    
    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        
        let json;
        try {
            // Prova a parsare il JSON
            json = await response.json();
        } catch (parseError) {
            console.error("Errore nel parsing della risposta JSON:", parseError);
            json = null; // Imposta a null se non è parsabile
        }
        
        if (response.ok) {
            // Registrazione riuscita
            errorSignup.innerHTML = `<p>${json["message"]}</p>`;
            setTimeout(() => {
                window.location.href = "../php/home.php";
            }, 1500);
        } else {
            errorSignup.innerHTML = '<p>Errore durante la registrazione.</p>';
        }
    } catch (error) {
        // Errore di rete o altro problema
        console.error("Errore nella richiesta di rete:", error);
    }
}

loginButton.addEventListener("click", (event) => {
    event.preventDefault();
    errorLogin.innerHTML = "";
    
    if(!loginForm.checkValidity()) {
        loginForm.reportValidity();
    } else {
        const formData = new FormData(loginForm);
        login(formData, isSeller.checked);
    }
});

signUpButton.addEventListener("click", (event) => {
    event.preventDefault();
    errorSignup.innerHTML = "";
    let valid = true;
    nome = signupForm.querySelector("#signupName").value;
    cognome = signupForm.querySelector("#signupSurname").value;
    password = signupForm.querySelector("#signupPassword").value;
    
    if(!signupForm.checkValidity()) {
        signupForm.reportValidity();
    } else if (!/^[a-zA-ZàèìòùÀÈÌÒÙ\s]+$/.test(nome)) {
        // Controllo sul nome (solo lettere e spazi)
        valid = false;
        errorSignup.innerHTML += '<p>Il nome può contenere solo lettere e spazi.</p>';
    } else if (!/^[a-zA-ZàèìòùÀÈÌÒÙ\s]+$/.test(cognome)) {
        valid = false;
        errorSignup.innerHTML += '<p>Il cognome può contenere solo lettere e spazi.</p>';
    } else if (password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password) || !/[\W_]/.test(password)) {
        // Constrollo sulla password
        valid = false;
        errorSignup.innerHTML += '<p>La password deve avere almeno 8 caratteri, una lettera maiuscola, un numero e un carattere speciale.</p>';
    } else {
        const formData = new FormData(signupForm);
        signup(formData);
    }
});