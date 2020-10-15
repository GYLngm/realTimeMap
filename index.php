<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tweets Flux Test</title>

        <link href="index.css" ref="stylesheet">

    </head>
    <body>

    <h3>Gragh temps reel</h3>
    <div>
        <svg id="area"></svg>
        <label for="filtreLangue">Langue</label>
        <select id="filtreLangue">
            <option value="0" default>Select langue</option>
            <option value="french">French</option>
        </select>
        <label for="filtreRS">Reseau social</label>
        <select id="filtreRS">
            <option value="0" default>Select reseau social</option>
            <option value="twitter">Twitter</option>
        </select>
        <label for="filtreAge">Age</label>
        <input type="number" id="filtreAge" min="13" max="100" />
    </div>

    <h3>Carte temps reel</h3>
    <div id="container">

    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/data.js"></script>
    <script src="https://code.highcharts.com/mapdata/custom/world.js"></script>
    <script type="text/javascript" src="app.js"></script>
    </body>
</html>
