/*
-
-   Database for the widgets/dashboard and the control panel
-
-
-
*/

DROP TABLE IF EXISTS piDashboards;
DROP TABLE IF EXISTS dashboardWidgets;
DROP TABLE IF EXISTS widget;
DROP TABLE IF EXISTS dashboard;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS pi;
/*
-
- Table for the pi`s
-
*/
CREATE TABLE IF NOT EXISTS pi(
    id serial,
    city varchar(256) NOT NULL,
    department varchar(256),
    piDesc TEXT,
  PRIMARY KEY (id)
); 

/*
-
- Table for the widgets
-
*/
CREATE TABLE IF NOT EXISTS dashboard(
        id serial,
        dashboardName varchar(256),
        TTL integer,
        gridFormat text,     
    PRIMARY KEY (id)
);

/*
-
- Table for the widgets used on the dashboard
-
*/
CREATE TABLE IF NOT EXISTS widget(
    id serial,
    widgetType varchar(256),
    widgetDesc text,
    modelName varchar(256),
    widgetStyle text,
    TTL integer,
    PRIMARY KEY (id)
);

/*
-
- Table for the pi-dashboard relation
-
*/
CREATE TABLE IF NOT EXISTS piDashboards(
    piID integer,
    dashboardID integer,
    PRIMARY KEY (piID, dashboardID),
        FOREIGN KEY (piID) REFERENCES pi(id),
        FOREIGN KEY (dashboardID) REFERENCES dashboard(id)
);

/*
-
- Table for the dashboard - widget relation
-
*/
CREATE TABLE IF NOT EXISTS dashboardWidgets(
    dashboardID integer,
    widgetID integer,
    PRIMARY KEY (dashboardID, widgetID),
        FOREIGN KEY (dashboardID) REFERENCES dashboard(id),
        FOREIGN KEY (widgetID) REFERENCES widget(id)
);

INSERT INTO pi (id, city, department, piDesc) VALUES 
(1, 'Vancouver', 'Garbage Collection','Test widget data'),
(2, 'Ottawa', 'Garbage Collection','Test widget data');

INSERT INTO dashboard (id, dashboardName, TTL, gridFormat) VALUES
(1, 'VancouverDashboard', 10, 'test the grid'),
(2, 'OttawaDashboard', 10, 'test the grid');

INSERT INTO widget (id, widgetType, widgetDesc, modelName, widgetStyle, TTL) VALUES
(1, 'Number','This is a number widget','VancouverGarbage', 'g', 10),
(2, 'graph','This is a graph widget','VancouverGarbage', 'g', 10);

INSERT INTO piDashboards (piID, dashboardID) VALUES
(1, 1);

INSERT INTO dashboardWidgets (dashboardID, widgetID) VALUES 
(1, 1),
(1, 2);
