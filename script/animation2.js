
function user_request_code() {
    window.location.href = "admin_user.html"
}

function restaurant_request_code() {
    window.location.href = "admin_restaurant.html"
}

function adminPP() {
    window.location.href = "admin.html"
}

function show_burger() {

    var burger_overlayId = document.getElementById("burger_overlay")

    burger_overlayId.style.width = "25%"

}

function hide_burger() {

    var burger_overlayId = document.getElementById("burger_overlay")

    burger_overlayId.style.width = "0"

}