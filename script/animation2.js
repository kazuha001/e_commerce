
function user_request_code() {
    window.location.href = "admin_user.php"
}

function restaurant_request_code() {
    window.location.href = "admin_restaurant.php"
}

function adminPP() {
    window.location.href = "admin.php"
}

function purchases_validation() {
    window.location.href = "admin_purchases_validation.php"
}

function bank_confirm() {
    window.location.href = "admin_confirming.php"

}

var bugershowId = document.getElementById("bugershow")

var burger_overlayId = document.getElementById("burger_overlay")

bugershowId.addEventListener("mouseover", () => {
    burger_overlayId.style.width = "360px"
})
burger_overlayId.addEventListener("mouseover", () => {
    burger_overlayId.style.width = "360px"
})
burger_overlayId.addEventListener("mouseout", () => {
    burger_overlayId.style.width = "0"
})

function hide_burger() {

    var burger_overlayId = document.getElementById("burger_overlay")

    burger_overlayId.style.width = "0"

}
