//Функция обработки Ajax запросов
function getAjaxRequest(adress, params, check, callback) {
    xmlhttp.open('POST', adress, true);
    if (check == true) {
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                callback(xmlhttp.responseText);
            }
        }
    }

    xmlhttp.send(params);
}
/*Создаем объект для работы аснхронными запросами*/
function getXmlHttp() {

    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

var xmlhttp = getXmlHttp();
// Отлавливаем нажатие клавиш и обрабатываем ответы сервера
document.addEventListener('click', function (event) {
    event = event || window.event;
    if (event.target.getAttribute("id") == "refresh") {
        var adress = '/alterego/ukrnet';
        var params = "submit=" + "refresh";
        getAjaxRequest(adress, params, true, function (response) {
            var links = JSON.parse(response);
            var date = new Date(links[0]["date"] * 1000);
            var d = date.getDate() > 10 ? date.getDate() : '0' + date.getDate();
            var m = date.getMonth() > 10 ? date.getMonth() + 1 : '0' + (date.getMonth() + 1);
            var y = date.getFullYear();
            var h = date.getHours() > 10 ? date.getHours() : '0' + date.getHours();
            var min = date.getMinutes() > 10 ? date.getMinutes() : '0' + date.getMinutes();
            var sec = date.getSeconds() > 10 ? date.getSeconds() : '0' + date.getSeconds();
            var dateref = d + "." + m + "." + y + " " + h + ":" + min + ":" + sec;
            document.getElementById("date").innerHTML = dateref;
            var i;
            for (i = 0; i < 3; i++) {
                var tr = document.createElement("tr");
                var contents = '<td class="text-center">' + dateref + '</td>' + '<td class="text-center"><a href=' + links[i]["link"] + '>' + links[i]["description"] + '</a></td>';
                tr.innerHTML = contents;
                document.getElementById('tbody').appendChild(tr);
            }
        })

    }

})