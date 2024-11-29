
function back() {

    window.location.href = "login.html"

}
function UPback() {

    window.location.href = "user_pp.html"

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