
function back() {

    window.location.href = "login.html"

}
function UPback() {

    window.location.href = "user_pp.php"

}
function fback() {

    window.location.href = "login.html"

}

function signup() {

    window.location.href = "signup.html"

}

function showpasswd() {

    var showpassId = document.getElementById("showpass")

    var passwordId = document.getElementById("password")

    if (passwordId.type === "password") {

        showpassId.src = "Icons/see.png"

        passwordId.type = "text"

    } else {

        showpassId.src = "Icons/invisible.png"

        passwordId.type = "password"

    }
    

}

function showpasswd1() {

    var showpass1Id = document.getElementById("showpass1")

    var password1Id = document.getElementById("password1")

    if (password1Id.type === "password") {

        showpass1Id.src = "Icons/see.png"

        password1Id.type = "text"

    } else {

        showpass1Id.src = "Icons/invisible.png"

        password1Id.type = "password"

    }
    

}

document.getElementById("myform").addEventListener("submit", function(event) {

    event.preventDefault()

    var password1Id = document.getElementById("password1")

    var c_password1Id = document.getElementById("c_password1")

    var highlightsId = document.getElementById("highlights")

    var highlights2Id = document.getElementById("highlights2")

    if (password1Id.value != c_password1Id.value) {
        
        highlightsId.style.border = "2px solid #f00"

        highlights2Id.style.border = "2px solid #f00"

        alert("Incorrect Cofirmation Passwd")

    } else {

        let formData = new FormData(this)

        fetch("submit.php", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message)
            } else {
                alert("Error" + data.message)

            }
        })
        .catch(error => {
            alert("Request failed:" + error)
        });
    }


})

