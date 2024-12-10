
    var header_preventionId = document.getElementById("header_prevention")

    var categoriesId = document.getElementById("categories")

    var aboutId = document.getElementById("about")

    var contentId = document.getElementById("content")

    var burger_menuId = document.getElementById("burger_menu")

    var user_informationId = document.getElementById("user_information")

    var user_information_overlayId = document.getElementById("user_information_overlay")

    var overlayId = document.getElementById("overlay")

    var categories_overlayId = document.getElementById("categories_overlay")

    var about_meId = document.getElementById("about_me")

    var opt1Id = document.getElementById("opt1")

    var fruitsId = document.getElementById("fruits")

    var opt2Id = document.getElementById("opt2")

    var vegetablesId = document.getElementById("vegetables")

    var opt3Id = document.getElementById("opt3")

    var GrainsId = document.getElementById("Grains")

    var opt4Id = document.getElementById("opt4")

    var ProteinsId = document.getElementById("Proteins")

    var opt5Id = document.getElementById("opt5")

    var DairyId = document.getElementById("Dairy")

    var opt6Id = document.getElementById("opt6")

    var Fats_and_OilsId = document.getElementById("Fats_and_Oils")

    var opt7Id = document.getElementById("opt7")

    var SnacksId = document.getElementById("Snacks")

    var opt8Id = document.getElementById("opt8")

    var DessertsId = document.getElementById("Desserts")

    var opt9Id = document.getElementById("opt9")

    var BeveragesId = document.getElementById("Beverages")

    var opt10Id = document.getElementById("opt10")

    var Fast_FoodsId = document.getElementById("Fast_Foods")

    var preventionsId = document.getElementById("preventions")

    categoriesId.addEventListener("mouseover", () => {
        overlayId.style.height = "600px"
        categories_overlayId.style.display = "flex"
        about_meId.style.display = "none"
        about_meId.style.transform = "translateX(20px)"
        about_meId.style.opacity = "0"
        user_information_overlayId.style.height = "0"
        user_information_overlayId.style.borderBottom = "0px solid #000"
        setTimeout(() => {
            categories_overlayId.style.transform = "translateX(0)"
            categories_overlayId.style.opacity = "1"
        }, 500)
    })
    categories_overlayId.addEventListener("mouseover", () => {
        overlayId.style.height = "600px"
    })
    aboutId.addEventListener("mouseover", () => {
        overlayId.style.height = "420px"
        categories_overlayId.style.display = "none"
        about_meId.style.display = "flex"
        categories_overlayId.style.transform = "translateX(20px)"
        categories_overlayId.style.opacity = "0"
        user_information_overlayId.style.height = "0"
        user_information_overlayId.style.borderBottom = "0px solid #000"
        setTimeout(() => {
            about_meId.style.transform = "translateX(0)"
            about_meId.style.opacity = "1"
        }, 500)
    })
    about_meId.addEventListener("mouseover", () => {
        overlayId.style.height = "420px"
    })
    overlayId.addEventListener("mouseout", () => {
        overlayId.style.height = "0"
    })

    user_informationId.addEventListener("mouseover", () => {
        user_information_overlayId.style.borderBottom = "2px solid #000"
        setTimeout(() => {
            user_information_overlayId.style.height = "120px"
        })
        overlayId.style.height = "0"
        categories_overlayId.style.transform = "translateX(20px)"
        categories_overlayId.style.opacity = "0"
        about_meId.style.transform = "translateX(20px)"
        about_meId.style.opacity = "0"
    })
    user_information_overlayId.addEventListener("mouseover", () => {
        user_information_overlayId.style.height = "120px"
        user_information_overlayId.style.borderBottom = "2px solid #000"
        
    })
    user_information_overlayId.addEventListener("mouseout", () => {
        user_information_overlayId.style.height = "0"
        user_information_overlayId.style.borderBottom = "0px solid #000"
    })
    header_preventionId.addEventListener("mouseover", () => {
        user_information_overlayId.style.borderBottom = "0px solid #000"
        user_information_overlayId.style.height = "0"
        overlayId.style.height = "0"
        categories_overlayId.style.transform = "translateX(20px)"
        categories_overlayId.style.opacity = "0"
        about_meId.style.transform = "translateX(20px)"
        about_meId.style.opacity = "0"
    })
    contentId.addEventListener("mouseover", () => {
        user_information_overlayId.style.borderBottom = "0px solid #000"
        user_information_overlayId.style.height = "0"
        overlayId.style.height = "0"
        categories_overlayId.style.transform = "translateX(20px)"
        categories_overlayId.style.opacity = "0"
        about_meId.style.transform = "translateX(20px)"
        about_meId.style.opacity = "0"
        burger_menuId.style.left = "-100%"
    })
    burger_menuId.addEventListener("mouseover", () => {
        burger_menuId.style.left = "0"
    })
    burger_menuId.addEventListener("mouseout", () => {
        burger_menuId.style.left = "-100%"
    })
    //Opt1
    opt1Id.addEventListener("mouseover", () => {
        opt1Id.style.backgroundColor = "#000"
        opt1Id.style.color = "#fff"
        fruitsId.style.display = "flex"
        setTimeout(() => {
            fruitsId.style.opacity = "1"
        }, 200)
        
    })
    fruitsId.addEventListener("mouseover", () => {
        opt1Id.style.backgroundColor = "#000"
        opt1Id.style.color = "#fff"
        fruitsId.style.opacity = "1"
        fruitsId.style.display = "flex"
        
        
    })
    fruitsId.addEventListener("mouseout", () => {
            opt1Id.style.backgroundColor = "#fff"
            opt1Id.style.color = "#000"
            fruitsId.style.opacity = "0"
            fruitsId.style.display = "none"
    })
    opt1Id.addEventListener("mouseout", () => {
        opt1Id.style.backgroundColor = "#fff"
        opt1Id.style.color = "#000"
        fruitsId.style.opacity = "0"
        fruitsId.style.display = "none"
    })
    
    //Opt2
    opt2Id.addEventListener("mouseover", () => {
        opt2Id.style.backgroundColor = "#000"
        opt2Id.style.color = "#fff"
        vegetablesId.style.display = "flex"
        setTimeout(() => {
            vegetablesId.style.opacity = "1"
        }, 200)
        
    })
    vegetablesId.addEventListener("mouseover", () => {
        opt2Id.style.backgroundColor = "#000"
        opt2Id.style.color = "#fff"
        vegetablesId.style.opacity = "1"
        vegetablesId.style.display = "flex"
        
        
    })
    vegetablesId.addEventListener("mouseout", () => {
            opt2Id.style.backgroundColor = "#fff"
            opt2Id.style.color = "#000"
            vegetablesId.style.opacity = "0"
            vegetablesId.style.display = "none"
    })
    opt2Id.addEventListener("mouseout", () => {
        opt2Id.style.backgroundColor = "#fff"
        opt2Id.style.color = "#000"
        vegetablesId.style.opacity = "0"
        vegetablesId.style.display = "none"
    })

    //Opt3
    opt3Id.addEventListener("mouseover", () => {
        opt3Id.style.backgroundColor = "#000"
        opt3Id.style.color = "#fff"
        GrainsId.style.display = "flex"
        setTimeout(() => {
            GrainsId.style.opacity = "1"
        }, 200)
        
    })
    GrainsId.addEventListener("mouseover", () => {
        opt3Id.style.backgroundColor = "#000"
        opt3Id.style.color = "#fff"
        GrainsId.style.opacity = "1"
        GrainsId.style.display = "flex"
        
        
    })
    GrainsId.addEventListener("mouseout", () => {
        opt3Id.style.backgroundColor = "#fff"
        opt3Id.style.color = "#000"
        GrainsId.style.opacity = "0"
        GrainsId.style.display = "none"
    })
    opt3Id.addEventListener("mouseout", () => {
        opt3Id.style.backgroundColor = "#fff"
        opt3Id.style.color = "#000"
        GrainsId.style.opacity = "0"
        GrainsId.style.display = "none"
    })

    //Opt4
    opt4Id.addEventListener("mouseover", () => {
        opt4Id.style.backgroundColor = "#000"
        opt4Id.style.color = "#fff"
        ProteinsId.style.display = "flex"
        setTimeout(() => {
            ProteinsId.style.opacity = "1"
        }, 200)
        
    })
    ProteinsId.addEventListener("mouseover", () => {
        opt4Id.style.backgroundColor = "#000"
        opt4Id.style.color = "#fff"
        ProteinsId.style.opacity = "1"
        ProteinsId.style.display = "flex"  
    })
    ProteinsId.addEventListener("mouseout", () => {
        opt4Id.style.backgroundColor = "#fff"
        opt4Id.style.color = "#000"
        ProteinsId.style.opacity = "0"
        ProteinsId.style.display = "none"
    })
    opt4Id.addEventListener("mouseout", () => {
        opt4Id.style.backgroundColor = "#fff"
        opt4Id.style.color = "#000"
        ProteinsId.style.opacity = "0"
        ProteinsId.style.display = "none"
    })

    //Opt5
    opt5Id.addEventListener("mouseover", () => {
        opt5Id.style.backgroundColor = "#000"
        opt5Id.style.color = "#fff"
        DairyId.style.display = "flex"
        setTimeout(() => {
            DairyId.style.opacity = "1"
        }, 200)
        
    })
    DairyId.addEventListener("mouseover", () => {
        opt5Id.style.backgroundColor = "#000"
        opt5Id.style.color = "#fff"
        DairyId.style.opacity = "1"
        DairyId.style.display = "flex"  
    })
    DairyId.addEventListener("mouseout", () => {
        opt5Id.style.backgroundColor = "#fff"
        opt5Id.style.color = "#000"
        DairyId.style.opacity = "0"
        DairyId.style.display = "none"
    })
    opt5Id.addEventListener("mouseout", () => {
        opt5Id.style.backgroundColor = "#fff"
        opt5Id.style.color = "#000"
        DairyId.style.opacity = "0"
        DairyId.style.display = "none"
    })

    //Opt6
    opt6Id.addEventListener("mouseover", () => {
        opt6Id.style.backgroundColor = "#000"
        opt6Id.style.color = "#fff"
        Fats_and_OilsId.style.display = "flex"
        setTimeout(() => {
            Fats_and_OilsId.style.opacity = "1"
        }, 200)
        
    })
    Fats_and_OilsId.addEventListener("mouseover", () => {
        opt6Id.style.backgroundColor = "#000"
        opt6Id.style.color = "#fff"
        Fats_and_OilsId.style.opacity = "1"
        Fats_and_OilsId.style.display = "flex"  
    })
    Fats_and_OilsId.addEventListener("mouseout", () => {
        opt6Id.style.backgroundColor = "#fff"
        opt6Id.style.color = "#000"
        Fats_and_OilsId.style.opacity = "0"
        Fats_and_OilsId.style.display = "none"
    })
    opt6Id.addEventListener("mouseout", () => {
        opt6Id.style.backgroundColor = "#fff"
        opt6Id.style.color = "#000"
        Fats_and_OilsId.style.opacity = "0"
        Fats_and_OilsId.style.display = "none"
    })

    //Opt7
    opt7Id.addEventListener("mouseover", () => {
        opt7Id.style.backgroundColor = "#000"
        opt7Id.style.color = "#fff"
        SnacksId.style.display = "flex"
        setTimeout(() => {
            SnacksId.style.opacity = "1"
        }, 200)
        
    })
    SnacksId.addEventListener("mouseover", () => {
        opt7Id.style.backgroundColor = "#000"
        opt7Id.style.color = "#fff"
        SnacksId.style.opacity = "1"
        SnacksId.style.display = "flex"  
    })
    SnacksId.addEventListener("mouseout", () => {
        opt7Id.style.backgroundColor = "#fff"
        opt7Id.style.color = "#000"
        SnacksId.style.opacity = "0"
        SnacksId.style.display = "none"
    })
    opt7Id.addEventListener("mouseout", () => {
        opt7Id.style.backgroundColor = "#fff"
        opt7Id.style.color = "#000"
        SnacksId.style.opacity = "0"
        SnacksId.style.display = "none"
    })

    //Opt8
    opt8Id.addEventListener("mouseover", () => {
        opt8Id.style.backgroundColor = "#000"
        opt8Id.style.color = "#fff"
        DessertsId.style.display = "flex"
        setTimeout(() => {
            DessertsId.style.opacity = "1"
        }, 200)
        
    })
    DessertsId.addEventListener("mouseover", () => {
        opt8Id.style.backgroundColor = "#000"
        opt8Id.style.color = "#fff"
        DessertsId.style.opacity = "1"
        DessertsId.style.display = "flex"  
    })
    DessertsId.addEventListener("mouseout", () => {
        opt8Id.style.backgroundColor = "#fff"
        opt8Id.style.color = "#000"
        DessertsId.style.opacity = "0"
        DessertsId.style.display = "none"
    })
    opt8Id.addEventListener("mouseout", () => {
        opt8Id.style.backgroundColor = "#fff"
        opt8Id.style.color = "#000"
        DessertsId.style.opacity = "0"
        DessertsId.style.display = "none"
    })

    //Opt9
    opt9Id.addEventListener("mouseover", () => {
        opt9Id.style.backgroundColor = "#000"
        opt9Id.style.color = "#fff"
        BeveragesId.style.display = "flex"
        setTimeout(() => {
            BeveragesId.style.opacity = "1"
        }, 200)
        
    })
    BeveragesId.addEventListener("mouseover", () => {
        opt9Id.style.backgroundColor = "#000"
        opt9Id.style.color = "#fff"
        BeveragesId.style.opacity = "1"
        BeveragesId.style.display = "flex"  
    })
    BeveragesId.addEventListener("mouseout", () => {
        opt9Id.style.backgroundColor = "#fff"
        opt9Id.style.color = "#000"
        BeveragesId.style.opacity = "0"
        BeveragesId.style.display = "none"
    })
    opt9Id.addEventListener("mouseout", () => {
        opt9Id.style.backgroundColor = "#fff"
        opt9Id.style.color = "#000"
        BeveragesId.style.opacity = "0"
        BeveragesId.style.display = "none"
    })

    //Opt10
    opt10Id.addEventListener("mouseover", () => {
        opt10Id.style.backgroundColor = "#000"
        opt10Id.style.color = "#fff"
        Fast_FoodsId.style.display = "flex"
        setTimeout(() => {
            Fast_FoodsId.style.opacity = "1"
        }, 200)
        
    })
    Fast_FoodsId.addEventListener("mouseover", () => {
        opt10Id.style.backgroundColor = "#000"
        opt10Id.style.color = "#fff"
        Fast_FoodsId.style.opacity = "1"
        Fast_FoodsId.style.display = "flex"  
    })
    Fast_FoodsId.addEventListener("mouseout", () => {
        opt10Id.style.backgroundColor = "#fff"
        opt10Id.style.color = "#000"
        Fast_FoodsId.style.opacity = "0"
        Fast_FoodsId.style.display = "none"
    })
    opt10Id.addEventListener("mouseout", () => {
        opt10Id.style.backgroundColor = "#fff"
        opt10Id.style.color = "#000"
        Fast_FoodsId.style.opacity = "0"
        Fast_FoodsId.style.display = "none"
    })
    
function burger_function() {
    
    var burger_menuId = document.getElementById("burger_menu")

    burger_menuId.style.left = "0"

}

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
