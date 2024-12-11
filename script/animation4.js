
function carts() {

    var navigatorId = document.getElementById("navigator")

    var Iframe_manipulatedId = document.getElementById("Iframe_manipulated")

    navigatorId.style.left = "0"

    Iframe_manipulatedId.src = "carts_through.php"

}

function ToPay() {

    var navigatorId = document.getElementById("navigator")

    var Iframe_manipulatedId = document.getElementById("Iframe_manipulated")

    navigatorId.style.left = "120px"

    Iframe_manipulatedId.src = "ToPay.php"

}

function ToRecieve() {

    var navigatorId = document.getElementById("navigator")

    var Iframe_manipulatedId = document.getElementById("Iframe_manipulated")

    navigatorId.style.left = "240px"

    Iframe_manipulatedId.src = "ToRecieve.php"

}

function ReturnRefund() {

    var navigatorId = document.getElementById("navigator")

    var Iframe_manipulatedId = document.getElementById("Iframe_manipulated")

    navigatorId.style.left = "360px"

    Iframe_manipulatedId.src = "ReturnRefund.php"

}

function Complete() {

    var navigatorId = document.getElementById("navigator")

    var Iframe_manipulatedId = document.getElementById("Iframe_manipulated")

    navigatorId.style.left = "480px"

    Iframe_manipulatedId.src = "complete.php"

}

function Cancelled() {

    var navigatorId = document.getElementById("navigator")

    var Iframe_manipulatedId = document.getElementById("Iframe_manipulated")

    navigatorId.style.left = "600px"

    Iframe_manipulatedId.src = "cancel.php"

}

function back() {

    window.location.href = "user.php"


}