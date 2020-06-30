
    console.log("Jobs Page JS loaded");
    document.getElementById("soft").addEventListener("click", function () {
        setField("fieBox", "Software and Technology")
    });
    document.getElementById("mech").addEventListener("click", function () {
        setField("fieBox", "Mechanical Engineering")
    });
    document.getElementById("elec").addEventListener("click", function () {
        setField("fieBox", "Electronic Engineering")
    });
    document.getElementById("chem").addEventListener("click", function () {
        setField("fieBox", "Chemical Engineering")
    });

    document.getElementById("10k").addEventListener("click", function () {
        setField("salBox", "£0 - £10k")
    });
    document.getElementById("20k").addEventListener("click", function () {
        setField("salBox", "£10k - £20k")
    });
    document.getElementById("30k").addEventListener("click", function () {
        setField("salBox", "£20k - £30k")
    });
    document.getElementById("more").addEventListener("click", function () {
        setField("salBox", "£30k +")
    });

    document.getElementById("grad").addEventListener("click", function () {
        setField("typBox", "Grad Jobs")
    });
    document.getElementById("part").addEventListener("click", function () {
        setField("typBox", "Part Time Placements")
    });
    document.getElementById("summ").addEventListener("click", function () {
        setField("typBox", "Summer Placements")
    });
    document.getElementById("12mon").addEventListener("click", function () {
        setField("typBox", "12 Month Placements")
    });

    document.getElementById("NY").addEventListener("click", function () {
        setField("locBox", "North Yorkshire")
    });
    document.getElementById("EY").addEventListener("click", function () {
        setField("locBox", "East Yorkshire")
    });
    document.getElementById("WY").addEventListener("click", function () {
        setField("locBox", "West Yorkshire")
    });
    document.getElementById("SY").addEventListener("click", function () {
        setField("locBox", "South Yorkshire")
    });
    document.getElementById("other").addEventListener("click", function () {
        setField("locBox", "pointless")
    });
    
    document.getElementById("job").addEventListener("click", function () {
        setField("ordBox", "By Title")
    });
    document.getElementById("company").addEventListener("click", function () {
        setField("ordBox", "By Company Name")
    });
    function setField(boxID, textIn) {
        document.getElementById(boxID).innerHTML = textIn;
    }