<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: index.php');
    }
    require_once 'db/db_connection.php';
    require_once 'objects/user.php';
    require_once 'validations/validator.php';
    require_once 'objects/newFormat.php';
    require_once '/var/www/focus-monitor/app/php/objects/errorLog.php';

    //check and download data
    $modFileDate = date ("H", filemtime("chartsData/global/SCI/data_cpu_report_SCI.csv"));
    if($modFileDate < date("H")){
        require_once 'requestCSV.php';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("header.php") ?>
    <title>General dashboard</title>
</head>

<body>
    <div class="container">
        <?php require_once("menu.php") ?>
        <main>
            <div class="graphs">
                <h2 class="titleIndex">SCI GLOBAL GRID</h2>
                <div class="graph_header">
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SCI LOAD HEALTH</div>
                        <div class="load">
                            <script>
                                //printLoadChart("chartsData/global/SCI/data_load_report_SCI.csv")
                                loadChart("chartsData/global/SCI/data_load_report_SCI.csv")
                            </script>
                        </div>
                    </div>
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SCI MEM HEALTH</div>
                        <div class="mem">
                            <script>
                                memChart("chartsData/global/SCI/data_mem_report_SCI.csv")
                            </script>
                        </div>
                    </div>
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SCI CPU HEALTH</div>
                        <div class="cpu">
                            <script>
                                cpuChart("chartsData/global/SCI/data_cpu_report_SCI.csv");
                            </script>
                        </div>
                    </div>
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SCI NETWORK HEALTH</div>
                        <div class="network">
                            <script>
                                networkChart("chartsData/global/SCI/data_network_report_SCI.csv");
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/utils/refreshWeb.js"></script>
</body>

</html>