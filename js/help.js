function modificaMain() {
    const main = document.querySelector("main");
    main.innerHTML = `
        <section>
            <h2>Invia un messaggio al nostro supporto</h2>

            <form action="mailto:marco.paggetti@studio.unibo.it" method="post" enctype="text/plain" aria-labelledby="form-label">
                <label class="d-none" for="message" id="form-label">Messaggio:</label>
                <textarea class="d-block mb-3 mt-3 p-2 w-100" id="message" name="message" rows="15" cols="100" required aria-describedby="message-description" placeholder="Scrivi qui il tuo messaggio..."></textarea>
                <button class="btn btn-primary" type="submit" aria-label="Invia il messaggio">Invia</button>
            </form>
        </section>
    `;
    document.body.classList.remove("vh-100", "h-100", "m-0", "d-flex", "flex-column");
    const formHelp = document.querySelector("main > section > form");
    const messageInput = document.querySelector("main > section > form > textarea");

    formHelp.addEventListener('submit', function(event) {
        event.preventDefault();

        const message = messageInput.value;
        const mailtoLink = `mailto:marco.paggetti@studio.unibo.it?subject=Messaggio%20di%20supporto&body=${encodeURIComponent(message)}`;
        window.location.href = mailtoLink;
        messageInput.value = '';
    });
}

modificaMain();