addEventListener('load', function () {

    //default value
    let nodeSelected = "abedul"
    document.querySelector("#nodeSel").innerHTML = nodeSelected.toUpperCase()
    let pathCPU = "chartsData/nodes/abedul/data_cpu_system_abedul.csv"
    let pathDisk = "chartsData/nodes/abedul/data_disk_free_abedul.csv"
    let pathLoad = "chartsData/nodes/abedul/data_load_fifteen_abedul.csv"
    let pathMem = "chartsData/nodes/abedul/data_mem_free_abedul.csv"
    let pathProc = "chartsData/nodes/abedul/data_proc_total_abedul.csv"

    nodeAreaChart(pathCPU, "content1")
    nodeAreaChart(pathDisk, "content2")
    nodeAreaChart(pathLoad, "content3")
    nodeAreaChart(pathMem, "content4")
    nodeAreaChart(pathProc, "content5")

    let selNode = document.querySelector("#nodes");
    selNode.addEventListener('change', function () {

        //clean div
        document.querySelector(".content1").innerHTML = "";
        document.querySelector(".content2").innerHTML = "";
        document.querySelector(".content3").innerHTML = "";
        document.querySelector(".content4").innerHTML = "";
        document.querySelector(".content5").innerHTML = "";
        nodeSelected = document.querySelector("#nodes").value;
        //change name node sel
        document.querySelector("#nodeSel").innerHTML = nodeSelected.toUpperCase()


        if (nodeSelected == "nat" || nodeSelected == "oceano") {
            pathCPU = "chartsData/nodes/" + nodeSelected + ".macc/data_cpu_system_" + nodeSelected + ".macc.csv"
            pathDisk = "chartsData/nodes/" + nodeSelected + ".macc/data_disk_free_" + nodeSelected + ".macc.csv"
            pathLoad = "chartsData/nodes/" + nodeSelected + ".macc/data_load_fifteen_" + nodeSelected + ".macc.csv"
            pathMem = "chartsData/nodes/" + nodeSelected + ".macc/data_mem_free_" + nodeSelected + ".macc.csv"
            pathProc = "chartsData/nodes/" + nodeSelected + ".macc/data_proc_total_" + nodeSelected + ".macc.csv"
        } else {
            pathCPU = "chartsData/nodes/" + nodeSelected + "/data_cpu_system_" + nodeSelected + ".csv"
            pathDisk = "chartsData/nodes/" + nodeSelected + "/data_disk_free_" + nodeSelected + ".csv"
            pathLoad = "chartsData/nodes/" + nodeSelected + "/data_load_fifteen_" + nodeSelected + ".csv"
            pathMem = "chartsData/nodes/" + nodeSelected + "/data_mem_free_" + nodeSelected + ".csv"
            pathProc = "chartsData/nodes/" + nodeSelected + "/data_proc_total_" + nodeSelected + ".csv"
        }

        //change paths



        nodeAreaChart(pathCPU, "content1")
        nodeAreaChart(pathDisk, "content2")
        nodeAreaChart(pathLoad, "content3")
        nodeAreaChart(pathMem, "content4")
        nodeAreaChart(pathProc, "content5")

        //alert(document.querySelector("#nodes").value)
    }, false)



}, false);