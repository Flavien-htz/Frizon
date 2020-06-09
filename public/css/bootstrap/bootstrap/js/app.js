const weatherIcons = {
    "Rain": "wi wi-day-rain",
    "Clouds": "wi wi-day-cloudy",
    "Clear": "wi wi-day-sunny",
    "Snow": "wi wi-day-snow",
    "mist": "wi wi-day-fog",
    "Drizzle": "wi wi-day-sleet",
}


var httpRequest = new XMLHttpRequest();
var key = 'e351d673af296c37883bdc891999b278'


var temp;
var vent;
var nom;
var body;
var $HTML;


httpRequest.open('GET', 'http://api.openweathermap.org/data/2.5/weather?q=Frizon&lang=fr&APPID=' + key + '&units=metric', true)


httpRequest.onreadystatechange = function () {
    if (httpRequest.readyState === 4 && httpRequest.status === 200) {

        var meteo = JSON.parse(httpRequest.response);
        var temp = meteo.main.temp;
        var desc = meteo.weather[0].description;
        //var conditions = meteo.weather[0].main;


        //console.log(httpRequest.response);
        //console.log(Math.round(temp));
        //console.log(desc);
        


        //creation(temp);
        document.getElementById('ok').innerHTML = 'Météo : ' + Math.round(temp) + ' °C (' + majuscule(desc) + ')';
    }
}

httpRequest.send();


function majuscule(str){
    return str[0].toUpperCase() + str.slice(1);
}