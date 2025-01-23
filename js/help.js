const form = document.querySelector("main > section > form");
const messageInput = document.querySelector("main > section > form > textarea");

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const message = messageInput.value;
    const mailtoLink = `mailto:marco.paggetti@studio.unibo.it?subject=Messaggio%20di%20supporto&body=${encodeURIComponent(message)}`;
    window.location.href = mailtoLink;
    messageInput.value = '';
});