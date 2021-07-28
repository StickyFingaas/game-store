var obj, dbParam, xmlhttp, myObj, x, txt = "";
obj = { table: "game", limit: 10 };
dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {

            txt+=myObj[x].title;
            txt+=myObj[x].description;
           
        }


        document.getElementById("putData").innerHTML = txt;
    }
};
xmlhttp.open("POST", "./api/gameAPI.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("x=" + dbParam);