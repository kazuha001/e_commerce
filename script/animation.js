
function back() {

    window.location.href = "demo_login.php"

}

function fback() {

    window.location.href = "demo_login.php"

}




function showpasswd1() {

    var showpass1Id = document.getElementById("showpass1")

    var password1Id = document.getElementById("password1")

    if (password1Id.type === "password") {

        showpass1Id.src = "Icons/see.png"

        password1Id.type = "text"

    } else {

        showpass1Id.src = "Icons/invisible.png"

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

        fetch("submit.php", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message)
                window.location.href = "demo_login.php"
            } else {
                alert("Error" + data.message)

            }
        })
        .catch(error => {
            alert("Username must have minimum at 8 characters...Submit Failded Error")
        });
    }


})



