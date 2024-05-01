
function nodeAreaChart(datafile, classJoin){

    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 30, bottom: 30, left: 50},
        width = 460 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;
    
    // append the svg object to the body of the page
    var svg = d3.select("."+classJoin)
      .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
              "translate(" + margin.left + "," + margin.top + ")");
    
    //Read the data
    d3.csv(datafile,
    
      // When reading the csv, I must format variables:
      function(d){
        return { date : d3.timeParse("%Y/%m/%d-%H:%M:%S")(d.date), value : d.value }
      },
    
      // Now I can use this dataset:
      function(data) {
    
        // Add X axis --> it is a date format
        var x = d3.scaleTime()
          .domain(d3.extent(data, function(d) { return d.date; }))
          .range([ 0, width ]);
        svg.append("g")
          .attr("transform", "translate(0," + height + ")")
          .call(d3.axisBottom(x));
    
        // Add Y axis
        var y = d3.scaleLinear()
          .domain([0, d3.max(data, function(d) { return +d.value; })])
          .range([ height, 0 ]);
        svg.append("g")
          .call(d3.axisLeft(y));
    
        // Add the area
        svg.append("path")
          .datum(data)
          .attr("fill", "#cce5df")
          .attr("stroke", "#ad36a1")
          .attr("stroke-width", 1.5)
          .attr("d", d3.area()
            .x(function(d) { return x(d.date) })
            .y0(y(0))
            .y1(function(d) { return y(d.value) })
            )
        }
    
    )
}

function loadChart(datafile) {
    var margin = { top: 20, right: 20, bottom: 30, left: 50 },
        width = 560 - margin.left - margin.right,
        height = 350 - margin.top - margin.bottom;

    //var parseDate = d3.time.format("%y-%b-%d").parse;
    var parseDate = d3.time.format("%Y/%m/%d-%H:%M:%S").parse;
    //formatPercent = d3.format(".0%");

    var x = d3.time.scale()
        .range([0, width]);

    var y = d3.scale.linear()
        .range([height, 0]);

    var color = d3.scale.category20();

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
    //.tickFormat(formatPercent);

    var area = d3.svg.area()
        .x(function (d) { return x(d.date); })
        .y0(function (d) { return y(d.y0); })
        .y1(function (d) { return y(d.y0 + d.y); });

    var stack = d3.layout.stack()
        .values(function (d) { return d.values; });

    var svg = d3.select(".load").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    d3.csv(datafile, function (error, data) {
        color.domain(d3.keys(data[0]).filter(function (key) { return key !== "date"; }));
        data.forEach(function (d) {
            d.date = parseDate(d.date);
        });

        var browsers = stack(color.domain().map(function (name) {
            return {
                name: name,
                values: data.map(function (d) {
                    return { date: d.date, y: d[name] * 1 };
                })
            };
        }));

        // Find the value of the day with highest total value
        var maxDateVal = d3.max(data, function (d) {
            var vals = d3.keys(d).map(function (key) { return key !== "date" ? d[key] : 0 });
            return d3.sum(vals);
        });

        // Set domains for axes
        x.domain(d3.extent(data, function (d) { return d.date; }));
        y.domain([0, maxDateVal])

        var browser = svg.selectAll(".browser")
            .data(browsers)
            .enter().append("g")
            .attr("class", "browser");

        browser.append("path")
            .attr("class", "area")
            .attr("d", function (d) { return area(d.values); })
            .style("fill", function (d) { return color(d.name); });

        browser.append("text")
            .datum(function (d) { return { name: d.name, value: d.values[d.values.length - 1] }; })
            .attr("transform", function (d) { return "translate(" + x(d.value.date) + "," + y(d.value.y0 + d.value.y / 2) + ")"; })
            .attr("x", -6)
            .attr("dy", ".35em")
            .text(function (d) { return d.name; });

        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis);
    });
}

function cpuChart(datafile) {
    // set the dimensions and margins of the graph
    var margin = { top: 20, right: 30, bottom: 30, left: 55 },
        width = 460 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    var svg = d3.select(".cpu")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");
    // Parse the Data
    d3.csv(datafile, function (data) {
        // List of groups = header of the csv files
        var keys = data.columns.slice(1)

        // Add X axis
        var x = d3.scaleLinear()
            .domain(d3.extent(data, function (d) { return d.Timestamp; }))
            .range([0, width]);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x).ticks(5));

        // Add Y axis
        var y = d3.scaleLinear()
            //.domain([0, 150])
            .domain([0, d3.max(data, function (d) { return +d["Idle"]; }) * 1.2])
            .range([height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));

        // color palette
        var color = d3.scaleOrdinal()
            .domain(keys)
            .range(['#e41a1c', '#377eb8', '#4daf4a', '#984ea3', '#ff7f00', '#ffff33', '#c8f7ee', '#f781bf'])

        //stack the data?
        var stackedData = d3.stack()
            .keys(keys)
            (data)
        //console.log("This is the stack result: ", stackedData)

        // Show the areas
        svg
            .selectAll("mylayers")
            .data(stackedData)
            .enter()
            .append("path")
            .style("fill", function (d) { console.log(d.key); return color(d.key); })
            .attr("d", d3.area()
                .x(function (d, i) { return x(d.data.Timestamp); })
                .y0(function (d) { return y(d[0]); })
                .y1(function (d) { return y(d[1]); })
            )

    })
}

function memChart(datafile) {
    // set the dimensions and margins of the graph
    var margin = { top: 20, right: 30, bottom: 30, left: 55 },
        width = 460 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    var svg = d3.select(".mem")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");
    // Parse the Data
    d3.csv(datafile, function (data) {
        // List of groups = header of the csv files
        var keys = data.columns.slice(1)

        // Add X axis
        var x = d3.scaleLinear()
            .domain(d3.extent(data, function (d) { return d.Timestamp; }))
            .range([0, width]);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x).ticks(5));

        // Add Y axis
        var y = d3.scaleLinear()
            //.domain([0, 150])
            .domain([0, d3.max(data, function (d) { return +d["Total"]; }) * 1.2])
            .range([height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));

        // color palette
        var color = d3.scaleOrdinal()
            .domain(keys)
            .range(['#e41a1c', '#377eb8', '#4daf4a', '#984ea3', '#ff7f00', '#ffff33', '#c8f7ee', '#f781bf'])

        //stack the data?
        var stackedData = d3.stack()
            .keys(keys)
            (data)
        //console.log("This is the stack result: ", stackedData)

        // Show the areas
        svg
            .selectAll("mylayers")
            .data(stackedData)
            .enter()
            .append("path")
            .style("fill", function (d) { console.log(d.key); return color(d.key); })
            .attr("d", d3.area()
                .x(function (d, i) { return x(d.data.Timestamp); })
                .y0(function (d) { return y(d[0]); })
                .y1(function (d) { return y(d[1]); })
            )

    })
}

function networkChart(datafile) {
    // set the dimensions and margins of the graph
    var margin = { top: 20, right: 30, bottom: 30, left: 55 },
        width = 460 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    var svg = d3.select(".network")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");
    // Parse the Data
    d3.csv(datafile, function (data) {
        // List of groups = header of the csv files
        var keys = data.columns.slice(1)

        // Add X axis
        var x = d3.scaleLinear()
            .domain(d3.extent(data, function (d) { return d.Timestamp; }))
            .range([0, width]);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x).ticks(5));

        // Add Y axis
        var y = d3.scaleLinear()
            //.domain([0, 150])
            .domain([0, d3.max(data, function (d) { return +d["Out"]; }) * 1.2])
            .range([height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));

        // color palette
        var color = d3.scaleOrdinal()
            .domain(keys)
            .range(['#e41a1c', '#377eb8', '#4daf4a', '#984ea3', '#ff7f00', '#ffff33', '#c8f7ee', '#f781bf'])

        //stack the data?
        var stackedData = d3.stack()
            .keys(keys)
            (data)
        //console.log("This is the stack result: ", stackedData)

        // Show the areas
        svg
            .selectAll("mylayers")
            .data(stackedData)
            .enter()
            .append("path")
            .style("fill", function (d) { console.log(d.key); return color(d.key); })
            .attr("d", d3.area()
                .x(function (d, i) { return x(d.data.Timestamp); })
                .y0(function (d) { return y(d[0]); })
                .y1(function (d) { return y(d[1]); })
            )

    })
}
