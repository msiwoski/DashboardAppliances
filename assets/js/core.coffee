###
The main js that runs the updating, xml parsing, etc
###
#Update time in seconds

###
Initializes the javascript.
This starts the timer to get the updates for the dashboard.

@Designer: Jordan Marling
@Programmer: Jordan Marling

@param:

@return:
###
initialize = ->
  
  #get the first update.
  getUpdate()
  
  #start the update timer.
  setInterval getUpdate, updateInterval * 1000
  return

###
Gets an update from the server.
If it is a dashboard update, it is handled inside the updateDashboard function
If it is a widget update, it is handled inside the updateWidget funtion

@Designer: Jordan Marling
@Programmer: Jordan Marling

@param:

@return:
###
getUpdate = ->
  httpUpdate = new XMLHttpRequest()
  httpUpdate.onreadystatechange = ->
    if httpUpdate.readyState is 4 and httpUpdate.status is 200
      if httpUpdate.responseText.length is 0
        console.log "No data to load."
        return
      
      #console.log(httpUpdate.responseText);
      json = JSON.parse(httpUpdate.responseText)
      console.log json
      
      #var parser = new DOMParser();
      #var xml = parser.parseFromString(httpUpdate.responseText, "application/xml");
      
      #get the response node and the type of update
      #var rootNode = xml.getElementsByTagName("response")[0];
      #var type = rootNode.getAttribute("type");
      switch json.type
        when "dashboard" #Update dashboard
          updateDashboard json
        when "widget" #Update widgets
          updateWidget json
        when "reload" #Update Webpage
          updateWebpage()

  httpUpdate.open "GET", "update.php", true
  httpUpdate.send()
  return

###
Updates the entire dashboards html code.

@Designer: Jordan Marling
@Programmer: Jordan Marling

@param: The xml returned by the server.

@return:
###
updateDashboard = (json) ->
  
  #var widgets = xml.getElementsByTagName("widget");
  widgets = json.widgets
  document.getElementById("dashboard").innerHTML = ""
  document.getElementById("scripts").innerHTML = ""
  i = 0

  while i < widgets.length
    document.getElementById("dashboard").innerHTML += widgets[i].html
    js = widgets[i].script
    if js?
      script = document.createElement("script")
      script.src = js
      script.type = "text/javascript"
      document.getElementById("scripts").appendChild script
    i++
  return

###
Updates the widget html code.

@Designer: Jordan Marling
@Programmer: Jordan Marling

@param: The xml returned by the server.

@return:
###
updateWidget = (json) ->
  
  #var widgets = xml.getElementsByTagName("widget");
  widgets = json.widgets
  widgetContent = undefined
  i = 0

  while i < widgets.length
    widgetContent = widgets[i]
    document.getElementById(widgetContent.id).outerHTML = widgetContent.html
    i++
  return

###
Refreshes the webpage to get the latest source files.

@Designer: Jordan Marling
@Programmer: Jordan Marling

@param:

@return:
###
updateWebpage = (xml) ->
  
  #Forces the client to reload all the data on the webpage.
  location.reload true
  return
updateInterval = 20

#run the initialize function to start the javascript.
window.onload = ->
  initialize()
  return