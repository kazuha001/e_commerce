
document.getElementById("myform").addEventListener("submit", function(event) {

    event.preventDefault()

    var new_password1Id = document.getElementById("new_password1")

    var c_password1Id = document.getElementById("c_password1")

    var highlightsId = document.getElementById("highlights")

    var highlights2Id = document.getElementById("highlights2")

    var hideId = document.getElementById("hide")

    var uploadingId = document.getElementById("uploading")

    hideId.style.display = "none"

    uploadingId.style.display = "flex"

    if (new_password1Id.value != c_password1Id.value) {
        
        highlightsId.style.border = "2px solid #f00"

        highlights2Id.style.border = "2px solid #f00"

        alert("Incorrect Cofirmation Passwd")

    } else {

        let formData = new FormData(this)

        fetch("update.php", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {

            if (data.success) {
                alert(data.message)
                window.location.reload()
                
            } else {
                alert(data.message)
            }
            if (data.success1) {
                window.location.href = "2FA_2.php"
            }
           
        })
        .catch(error => {
            console.log(error)
            
        });
    }
        


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

function UPback() {

    window.location.href = "user_pp.php"

}

function showpasswd() {

    var showpassId = document.getElementById("showpass")

    var passwordId = document.getElementById("cu_password")

    if (passwordId.type === "password") {

        showpassId.src = "css/Icons/see.png"

        passwordId.type = "text"

    } else {

        showpassId.src = "css/Icons/invisible.png"

        passwordId.type = "password"

    }
    

}

function showpasswd1() {

    var showpass1Id = document.getElementById("showpass1")

    var password1Id = document.getElementById("new_password1")

    if (password1Id.type === "password") {

        showpass1Id.src = "css/Icons/see.png"

        password1Id.type = "text"

    } else {

        showpass1Id.src = "css/Icons/invisible.png"

        password1Id.type = "password"

    }
    

}


