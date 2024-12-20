document.getElementById("myform").addEventListener("submit", function(event) {
    event.preventDefault()
    let formData = new FormData(this)

    var hideId = document.getElementById("hide")

    var uploadingId = document.getElementById("uploading")

    hideId.style.display = "none"

    uploadingId.style.display = "flex"

        fetch("add_product.php", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {

                alert(data.message)

                window.location.reload()

            } else {

                alert("Error" + data.message)

                window.location.reload()

            }
        })
})


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



document.getElementById("uploadImg").addEventListener("change", function (event) {

    var file = event.target.files[0]

    var imgPreview = document.getElementById("upImg")

    if (file && file.type.startsWith("image/")) {

        var reader = new FileReader()

        reader.onload = function(e) {
            imgPreview.src = e.target.result
        }
        reader.readAsDataURL(file)
    } else {

        imgPreview.src = ""
        alert("Please Select a Valid Image")

    }

})

