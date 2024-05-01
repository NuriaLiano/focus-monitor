function printCPUChart(datafile) {
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