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

function seller_pp() {

    window.location.href = "seller_shop.php"

}

function sell_product() {

    window.location.href = "sell_products.php"

}

function ordered() {

    window.location.href = "shop_ordered.php"

}