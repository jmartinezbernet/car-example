function getStatus() {
    var status = document.getElementById("status");

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            status.innerHTML = JSON.parse(xmlHttp.responseText);
        }
    };
    xmlHttp.open("GET", "http://phpDockerizedApp.localhost/status", true);
    xmlHttp.send();


}

function reset() {
    var status = document.getElementById("status");

    status.innerHTML = "";
}

