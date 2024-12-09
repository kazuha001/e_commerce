document.getElementById("myform").addEventListener("submit", function(event) {

    let formData = new FormData(this)

        fetch("edited_product.php", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message)
                window.location.href = "sell_products.php"
            } else {
                alert("Error" + data.message)
                window.location.href = "sell_products.php"
            }
        })
        .catch(error => {
            alert("Updated Successfully Server Down")
        })
})

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