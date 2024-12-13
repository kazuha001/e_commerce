

// Add event listener to the form
document.getElementById("sendmail").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission behavior
    
    emailjs.sendForm('service_dfa7neq', 'template_rwaoa8f', this)
    .then(function(response) {
        alert('Email sent successfully! Status: ' + response.status + ', Text: ' + response.text);
    }, function(error) {
        alert('Failed to send email! Error: ' + error.text);
    });
    

});
