let deferredPrompt;

window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();

    // Store the event for later use
    deferredPrompt = event;
    $('#custom-download-button').show();
});

const downloadButton = document.getElementById('custom-download-button');

downloadButton.addEventListener('click', () => {
      if (deferredPrompt) {
            // Show the browser's install prompt
            deferredPrompt.prompt();

            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then((choiceResult) => {
                // Check if the user accepted the installation
                if (choiceResult.outcome === 'accepted') {
                    $('#AppInstalled').show();
                    // Clear the deferredPrompt variable
                    deferredPrompt = null;
                } else {
                    window.alert('PWA installation declined.');
                }
            });

      } else {
           $('#NOTsupported').show();
      }

});

function redirectApp() {
    return window.location.replace("/auth/login");
}


