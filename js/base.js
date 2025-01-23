const iconProfileButton = document.querySelector("header > nav > div > div:nth-of-type(2) > div > button");
const dropdownMenu = document.querySelector("header > nav > div > div:nth-of-type(2) > div > ul.dropdown-menu");

function addStyles() {
    document.querySelectorAll("body:not(ul)").forEach(function(element) {
        element.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3))";
    });

    document.querySelectorAll("body > header > nav:first-of-type").forEach(function(element) {
        element.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3))";
    });

    document.querySelectorAll("body > footer").forEach(function(element) {
        element.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3))";
    });
}

function removeStyles() {
    document.querySelectorAll("body:not(ul)").forEach(function(element) {
        element.style.backgroundImage = "";
    });

    document.querySelectorAll("body > header > nav:first-of-type").forEach(function(element) {
        element.style.backgroundImage = "";
    });

    document.querySelectorAll("body > footer").forEach(function(element) {
        element.style.backgroundImage = "";
    });
}

iconProfileButton.addEventListener("click", () => {
    if (dropdownMenu.classList.contains('show')) {
        addStyles();
    } else {
        removeStyles();
    }
});
