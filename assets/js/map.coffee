initialize2 = ->
  mapOptions =
    center: new google.maps.LatLng(49.2500, -123.100)
    zoom: 12
    disableDefaultUI: true

  map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions)
  return
pointarray = undefined
heatmap = undefined
map = undefined
xhr = new XMLHttpRequest()
xhr.open "GET", "helpers/heatmapHelper.php", true
xhr.onload = ->
  if xhr.readyState is 4 and xhr.status is 200
    if xhr.responseText.length is 0
      console.log "No data to load."
      return
    jsonData = JSON.parse(xhr.responseText)
    garbageData = []
    i = 0

    while i < jsonData.length
      garbageData.push new google.maps.LatLng(jsonData[i]["location"][1], jsonData[i]["location"][0])
      i++
    pointArray = new google.maps.MVCArray(garbageData)
    heatmap = new google.maps.visualization.HeatmapLayer(data: pointArray)
    heatmap.setMap map
  return

xhr.send()
initialize2()