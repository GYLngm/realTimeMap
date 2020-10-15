var filters = {
    langue: 'french',
    pays: 'France',
    reseau_social: 'twitter',
    age: 13,
}

var setArea = (data, columns) => {
    var margin = ({top: 20, right: 20, bottom: 40, left: 40}),
        height = 400,
        width = 750;

    var x = d3.scaleUtc()
        .domain(d3.extent(columns, d => new Date(d.date)))
        .range([margin.left, width - margin.right])
        .clamp(true);

    
    var y = d3.scaleLinear()
        .domain([0, d3.max(d3.group(data, d => d3.max(d.values, d => d.value)))[0]]).nice()
        .range([height - margin.bottom, margin.top]);

    var z = d3.scaleOrdinal(d3.schemeCategory10).domain(data.map(d => d.key));

    var xAxis = g => g
        .attr("transform", `translate(0,${height - margin.bottom})`)
        .call(d3.axisBottom(x).ticks(width / 80).tickSizeOuter(0));

    var yAxis = g => g
        .attr("transform", `translate(${margin.left},0)`)
        .call(d3.axisLeft(y))
        .call(g => g.select(".domain").remove())
        .call(g => g.select(".tick:last-of-type text").clone()
            .attr("x", 3)
            .attr("text-anchor", "start")
            .attr("font-weight", "bold")
            .text(data.y));

    var line = d3.line()
        .x(d => x(new Date(d.date)))
        .y(d => y(d.value));

    const svg = d3.select("svg#area")
            .attr("viewBox", [0, 0, width, height]);
      
    svg.append("g")
            .style("font", "bold 1-px sans-serif")
            .selectAll("path")
            .data(data)
            .join("path")
            .attr("stroke", d => z(d.key))
            .style("mix-blend-mode", "multiply")
            .attr("d", d => line(d.values));

    svg.append("g")
        .call(xAxis);
      
    svg.append("g")
        .call(yAxis);
}

var request = fetch('http://localhost:8080/ajax.php')
    .then(res => res.json())
    .then(data => {
        if(data){
            var r = [], ds = [],
            series = [], rawData = [];
            Object.assign(rawData, data);

            // Filtrer les données
            rawData.filter(item => {
                for (var key in filters) {
                    if (Number.isInteger(filters[key])) {
                        return item[key] >= filters[key];
                    } else {
                        return item[key] == filters[key];
                    }
                }
            });

            series = d3.groups(rawData, d => d.tag).map(([key, values]) => {
                return {key, values: d3.groups(values, d => d.datetime).map(([k, vs]) => {
                    return {date: k, value: vs.length};
                })};
            });
            const columns = d3.groups(rawData, d => d.datetime).map(([key, values]) => ({date: key}));

            setArea(series, columns);
        }   
    })
    .catch(error => {
        console.error(error);
    });


    Highcharts.data({

        googleSpreadsheetKey: '0AoIaUO7wH1HwdFJHaFI4eUJDYlVna3k5TlpuXzZubHc',
    
        // custom handler when the spreadsheet is parsed
        parsed: function (columns) {
    
            // Read the columns into the data array
            var data = [];
            $.each(columns[0], function (i, code) {
                data.push({
                    code: code.toUpperCase(),
                    value: Math.floor(Math.random() * Math.floor(3)),
                    name: columns[1][i]
                });
            });

            // Initiate the chart
            Highcharts.mapChart('container', {
                chart: {
                    borderWidth: 1
                },
                title: {
                    text: 'Named data classes'
                },
    
                mapNavigation: {
                    enabled: true
                },
    
                legend: {
                    title: {
                        text: 'Population density'
                    },
                    align: 'left',
                    verticalAlign: 'bottom',
                    floating: true,
                    layout: 'vertical',
                    valueDecimals: 0,
                    backgroundColor: 'rgba(255,255,255,0.9)',
                    symbolRadius: 0,
                    symbolHeight: 14
                },
    
                colorAxis: {
                    dataClasses: [{
                            color: 'red',
                        from: 2,
                        to: 2,
                        name: 'negatif'
                    }, {
                        color: 'green',
                        from: 1,
                        to: 1,
                        name: 'positif'
                    }, {
                        color: 'orange',
                        from: 0,
                        to: 0,
                        name: 'neutre'
                    }]
                },
    
                series: [{
                    data: data,
                    mapData: Highcharts.maps['custom/world'],
                    joinBy: ['iso-a2', 'code'],
                    name: 'Population density',
                    states: {
                        hover: {
                            color: '#a4edba'
                        }
                    },
                    tooltip: {
                        valueSuffix: '/km²'
                    }
                }]
            });
        }
    });