

    var categoriesId = document.getElementById("categories")

    var overlayId = document.getElementById("overlay")

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
        overlayId.style.height = "570px"
    })
    overlayId.addEventListener("mouseover", () => {
        overlayId.style.height = "570px"
    })
    overlayId.addEventListener("mouseout", () => {
        overlayId.style.height = "0"
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
    