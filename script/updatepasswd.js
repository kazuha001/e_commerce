
function back() {

    window.location.href = "index.php"

}

function showpasswd1() {

    var showpass1Id = document.getElementById("showpass1")

    var password1Id = document.getElementById("password1")

    if (password1Id.type === "password") {

        showpass1Id.src = "css/Icons/see.png"

        password1Id.type = "text"

    } else {

        showpass1Id.src = "css/Icons/invisible.png"

        password1Id.type = "password"

    }
    

}



document.getElementById("myform").addEventListener("submit", function(event) {

    event.preventDefault()

    var password1Id = document.getElementById("password1")

    var c_password1Id = document.getElementById("c_password1")

    var highlightsId = document.getElementById("highlights")

    var highlights2Id = document.getElementById("highlights2")

    if (password1Id.value != c_password1Id.value) {
        
        highlightsId.style.border = "2px solid #f00"

        highlights2Id.style.border = "2px solid #f00"

        alert("Incorrect Cofirmation Passwd")

    } else {

        let formData = new FormData(this)

        fetch("updatepasswd.php", {
            method: 'POST',
            body: formData
     
        })

        alert("Update Successsfully");

        window.location.href = "session_destroy.php"

    }


})



