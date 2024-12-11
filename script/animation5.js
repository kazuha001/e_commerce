var products_foods_popupId = document.getElementById("products_foods_popup")

var buyId = document.querySelectorAll(".buy")

var close_popupId = document.getElementById("close_popup")

var totalId = document.getElementById("total")

var total_resultId = document.getElementById("total_result")

var org_price2Id = document.getElementById("org_price2")

var qty_resultId = document.getElementById("qty_result")

var totalId = document.getElementById("total")

var qtyId = document.getElementById("qty")

var priceId = document.getElementById("price")

var products_nameHTMLId = document.getElementById("products_name")

var hide_bgId = document.getElementById("hide_bg")

var PRIDrecieve = document.getElementById("PRID")

var img_changeId = document.getElementById("img_change")

var tokenId = document.getElementById("token")

var sellerId = document.getElementById("seller")

buyId.forEach(function (button) {
    button.addEventListener("click", function() {

        var parent = this.closest(".products_foods_ads_info_funtion")

        var org_priceId = parent.querySelector(".org_price").value

        var products_nameId = parent.querySelector(".products_name").value

        var PRIDresult = parent.querySelector(".PRID").value

        var token = parent.querySelector(".token").value

        var img_identify = parent.querySelector(".img_identify").value

        var seller = parent.querySelector(".seller").value

        sellerId.value = seller

        tokenId.value = token

        products_nameHTMLId.innerText = products_nameId

        total_resultId.innerText = org_priceId

        org_price2Id.value = org_priceId

        priceId.innerText = org_priceId

        products_foods_popupId.style.display = "flex"

        PRIDrecieve.value = PRIDresult

        img_changeId.src = "product_img.php?user_id=" + img_identify

        setTimeout(() => {
            products_foods_popupId.style.right = "0"
        }, 100)

        hide_bgId.style.display = "block"

    })
})


close_popupId.addEventListener("click", function(){

    products_foods_popupId.style.right = "-100%"

    setTimeout(() => {
        products_foods_popupId.style.display = "none"
    }, 200)

    total_resultId.innerText = "0"

    org_price2Id.value = "0"

    qty_resultId.innerText = "1"

    totalId.value = "0"

    qtyId.value = "1"

    hide_bgId.style.display = "none"

    document.getElementById("resetf0").reset();

})



function minus_qty() {

    var org_price2Id = document.getElementById("org_price2")

    var org_priceValId = parseFloat(org_price2Id.value)

    var qtyId = document.getElementById("qty")

    var qtyIdVal = parseFloat(qtyId.value)

    var qty_resultId = document.getElementById("qty_result")

    var totalId = document.getElementById("total")

    var totalValId = parseFloat(totalId.value)

    var total_resultId = document.getElementById("total_result")

    if (qtyIdVal <= "1") {
        qtyId.value = "1"
        qty_resultId.innerText = "1"
    } else {
        let minusId = qtyIdVal - 1
        qtyId.value = minusId
        qty_resultId.innerText = minusId
        let equalId = totalValId - org_priceValId
        totalId.value = equalId
        total_resultId.innerText = equalId

    }


}

function plus_qty() {
    
    var org_price2Id = document.getElementById("org_price2")

    var org_priceValId = parseFloat(org_price2Id.value)

    var qtyId = document.getElementById("qty")

    var qtyIdVal = parseFloat(qtyId.value)

    var qty_resultId = document.getElementById("qty_result")

    var totalId = document.getElementById("total")

    var total_resultId = document.getElementById("total_result")

    if (qtyIdVal >= "1") {
        let plusId = qtyIdVal + 1
        qtyId.value = plusId
        qty_resultId.innerText = plusId
        let multiplyId = org_priceValId * plusId
        totalId.value = multiplyId
        total_resultId.innerText = multiplyId
    }


}

function adjustDivHeight() {
    const div = document.getElementById('products_foods_popup')
    div.style.height = `${window.innerHeight}px`
}

adjustDivHeight()

window.addEventListener('resize', adjustDivHeight)