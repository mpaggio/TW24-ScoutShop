const notificationSpan = document.querySelector("header > nav > div > div > div > button > span");
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

document.addEventListener("click", (event) => {
    if (!dropdownMenu.contains(event.target) && !dropdownMenu.classList.contains("show")) {
        removeStyles();
    }
})

async function checkIfLoggedIn() {
    const url = "./api/api-check-login.php";
    try {
        const response = await fetch(url);
        const data = await response.json();
        return data.isLoggedIn;
    } catch (error) {
        console.error('Errore nel controllo del login:', error);
        return false;
    }
}


async function getUnreadNotificationsCount() {
    const url = "./api/api-notification.php";
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: new URLSearchParams({
                'count': "countNotification"
            })
        });
        if (!response.ok) {
            throw new Error("Errore nel recupero delle notifiche");
        }
        const data = await response.json();
        return data.result;
    } catch (error) {
        console.error('Errore nel recupero delle notifiche:', error);
        return 0;
    }
}

async function updateNotificationBadge() {
    const isLoggedIn = await checkIfLoggedIn();
    if (!isLoggedIn) {
        notificationSpan.classList.add('d-none');
        return;
    }

    const unreadCount = await getUnreadNotificationsCount();

    if (unreadCount > 0) {
        notificationSpan.textContent = unreadCount;
        notificationSpan.classList.remove('d-none');
    } else {
        notificationSpan.classList.add('d-none');
    }
}

updateNotificationBadge();