function getCars() {
    var carTableData = document.getElementById("carTableData");
    var error = document.getElementById("error");

    var xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState === 4) {
            if (xmlHttp.status === 200) {
                var carData = JSON.parse(xmlHttp.responseText).results;


                carData.forEach(function (elem) {
                    var tr = document.createElement('tr');
                    var td = document.createElement('td');

                    td.innerHTML = elem.id;
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.innerHTML = elem.brand;
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.innerHTML = elem.model;
                    tr.appendChild(td);

                    carTableData.appendChild(tr);
                });

                error.innerHTML = "";
            } else {
                error.innerHTML = "Error: " + xmlHttp.responseText;
            }
        }
    };
    xmlHttp.open("GET", "http://0.0.0.0:8081/car?page=1", true);

    xmlHttp.send();
}

function reset() {
    var carTableData = document.getElementById("carTableData");
    var error = document.getElementById("error");

    error.innerHTML = "";
    carTableData.innerHTML = "";
}

