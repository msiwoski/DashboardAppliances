<!-- 
    data - an array of pointsman
    id - the name of the data displayed
    key - the google maps API key
-->
<div id="{id}" style="width: 100%;height: 100%;">

</div>
<!--<script src="http://maps.googleapis.com/maps/api/js?key={key}&sensor=false"></script>-->
<!--<script>
    function initialize()
    {
        var mapProp = {
            center: new google.maps.LatLng({Lat},{Long}),
            zoom: {zoom},
            mapTypeId: google.maps.MapTypeId.HEATMAP
        };
        var mainMap = new google.maps.Map(document.getElementById("{id}")
                , mapProp);
    }

    var locations = {data};

    var i = 0;

    for (i = 0; i < locations.length; i += 2) {
        var myLatlng = new google.maps.LatLng(locations[i], locations[i + 1]);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: mainMap,
            title: ''
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>-->