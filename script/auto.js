function adjustDivHeight() {
    const div = document.getElementById('resize')
    div.style.height = `${window.innerHeight}px`
}

adjustDivHeight()

window.addEventListener('resize', adjustDivHeight)


function signup() {

    window.location.href = "signup.php"

}

function showpasswd() {

    var showpassId = document.getElementById("showpass")

    var passwordId = document.getElementById("password")

    if (passwordId.type === "password") {

        showpassId.src = "css/Icons/see.png"

        passwordId.type = "text"

    } else {

        showpassId.src = "css/Icons/invisible.png"

        passwordId.type = "password"

    }
    

}