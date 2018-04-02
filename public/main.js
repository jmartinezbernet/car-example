function getCars() {
    var status = document.getElementById("status");
    var error = document.getElementById("error");

    var xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState === 4){
            if (xmlHttp.status === 200) {
                status.innerHTML = JSON.parse(xmlHttp.responseText);
                error.innerHTML = "";
            } else {
                error.innerHTML = "Error: " + xmlHttp.responseText;
                status.innerHTML = "";
            }
        }
    };
    xmlHttp.open("GET", "http://0.0.0.0:8081/status", true);

    xmlHttp.send();
}

function reset() {
    var status = document.getElementById("status");

    error.innerHTML = "";
    status.innerHTML = "";
}

