
function fback1() {

    window.location.href = "back.php"

}

function fback2() {

    window.location.href = "back1.php"

}

function checkMessage() {

    fetch("admin_denied0.php")
    .then(response => response.json)
    .then(data => {

        if (data.message) {
            alert(data.message)
        }

    })

}

setInterval(checkMessage(), 500)
