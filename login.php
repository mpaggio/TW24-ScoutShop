<!DOCTYPE html>
<html lang="it">

<head>
    <title>Scout Shop - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/unico-style.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="./home.php">
                    <img src="./img/ScoutShop_Logo6.png" alt="Logo" class="d-inline-block align-text-top" />
                </a>
                <a href="./help.php" class="text-decoration-none text-secondary">Aiuto</a>
            </div>
        </nav>
    </header>
    <main class="d-flex justify-content-center align-items-center mt-5 col">
        <div class="d-flex flex-column justify-content-center align-items-center col-xl-4 col-md-6 col-8">
            <div class="container-fluid bg-dark p-3">
                <h2 class="text-center text-secondary fs-1 mb-0">Benvenuto</h2>
            </div>
            <div id="signup-container"
                class="container-fluid border border-bottom-0 border-dark border-2 px-4 py-3 bg-secondary">
                <div class="form-check form-group d-flex align-items-center">
                    <input class="form-check-input me-2" type="radio" name="form" id="signup" />
                    <label class="form-check-label fs-2" for="signup">
                        Create account
                    </label>
                </div>
                <form id="signup-form d-none">
                    <div class="form-group mt-2">
                        <label class="fs-3" for="signupName">Nome</label>
                        <input type="text" class="form-control fs-5" id="signupName" name="signupName" placeholder="Mario" required />
                    </div>
                    <div class="form-group mt-2">
                        <label class="fs-3" for="signupSurname">Cognome</label>
                        <input type="text" class="form-control fs-5" id="signupSurname" name="signupSurname" placeholder="Rossi" required />
                    </div>
                    <div class="form-group mt-2">
                        <label class="fs-3" for="signupEmail">E-mail</label>
                        <input type="email" class="form-control fs-5" id="signupEmail" name="signupEmail" placeholder="mariorossi@example.com" required />
                    </div>
                    <div class="form-group mt-2">
                        <label class="fs-3" for="signupPassword">Password <p class="fs-6">(Aleno 8 caratteri, una maiuscola, un numero e un carattere speciale)</p></label>
                        <input type="password" class="form-control fs-5" id="signupPassword" name="signupPassword" placeholder="Password" required />
                    </div>
                    <div class="form-group mt-2">
                        <input class="btn btn-primary fs-4 w-100 mt-4" type="submit" value="Crea account" />
                    </div>
                </form>
                <div class="text-danger text-center w-100 fs-3 mt-2"></div>
            </div>
            <div id="login-container" class="container-fluid border border-dark border-2 px-4 py-3 bg-light">
                <div class="form-check form-group d-flex align-items-center">
                    <input class="form-check-input me-2" type="radio" name="form" id="login" checked />
                    <label class="form-check-label fs-2" for="login">
                        Login
                    </label>
                </div>
                <form id="login-form">
                    <div class="form-group my-3">
                        <label class="fs-3" for="loginEmail">E-mail</label>
                        <input type="email" class="form-control fs-5" id="loginEmail" name="loginEmail" placeholder="Inserisci la tua email" required />
                    </div>
                    <div class="form-group mb-3">
                        <label class="fs-3" for="loginPassword">Password</label>
                        <input type="password" class="form-control fs-5" id="loginPassword" name="loginPassword" placeholder="Password" required />
                    </div>
                    <div class="form-group form-check d-flex align-items-center mb-3">
                        <input type="checkbox" class="form-check-input me-2" id="sellerCheck" name="sellerCheck" />
                        <label class="form-check-label fs-3" for="sellerCheck">Sei un venditore?</label>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary fs-4 w-100" type="submit" value="Login" />    
                    </div>
                </form>
                <div class="text-danger text-center w-100 fs-3 mt-2"></div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
</body>

</html>