

document.getElementById("submit").addEventListener("submit", function(event) {
    event.preventDefault()

    var systemId = document.getElementById("system").value

    if (systemId <= 0) {

        alert("Invalid Actions")

    } else {

    let formData = new FormData(this)

    fetch("", {
        method: 'POST',
        body: formData
    })

    alert("Admin will send you an qr code through this Email Address")

    document.getElementById("submit").reset();

    var waitId = document.getElementById("wait")

    waitId.style.display = "flex"

    var payformId = document.getElementById("payform")

    payformId.style.display = "none"

}

})

