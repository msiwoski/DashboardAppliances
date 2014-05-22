
var pointarray, heatmap, map;


var xhr = new XMLHttpRequest();
xhr.open('GET', 'helpers/heatmapHelper.php', true);
xhr.onload = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        if (xhr.responseText.length == 0) {
            console.log("No data to load.");
            return;
        }
        var jsonData = JSON.parse(xhr.responseText);
        var garbageData = [];
        for (var i = 0; i < jsonData.length; i++) {
            garbageData.push(new google.maps.LatLng(jsonData[i]['location'][1],jsonData[i]['location'][0]));
        }
        var pointArray = new google.maps.MVCArray(garbageData);
       
        heatmap = new google.maps.visualization.HeatmapLayer({
            data: pointArray
        });
         
        heatmap.setMap(map);

    }

};
xhr.send();

function initialize2() {
    var mapOptions = {
        center: new google.maps.LatLng(49.2500, -123.100),
        zoom: 12,
        disableDefaultUI: true
    };
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
   
}
initialize2();
