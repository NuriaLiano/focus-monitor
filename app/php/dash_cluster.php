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
    $modFileDate = date ("H", filemtime("chartsData/cluster/Servidores/data_cpu_report_Servidores.csv"));
    if($modFileDate < date("H")){
        require_once 'requestCSV.php';  
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.php") ?>
    <title>View all hosts</title>
</head>
<body>
<div class="container">
        <?php require_once("menu.php") ?>
        <main>
            <div class="graphs">
                <h2 class="titleIndex">SERVIDORES CLUSTER GRID</h2>
                <div class="graph_header">
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SERVIDORES LOAD HEALTH</div>
                        <div class="load">
                            <script>
                                loadChart("chartsData/cluster/Servidores/data_load_report_Servidores.csv")
                            </script>
                        </div>
                    </div>
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SERVIDORES MEM HEALTH</div>
                        <div class="mem">
                            <script>
                                memChart("chartsData/cluster/Servidores/data_mem_report_Servidores.csv")
                            </script>
                        </div>
                    </div>
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SERVIDORES CPU HEALTH</div>
                        <div class="cpu">
                            <script>
                                cpuChart("chartsData/cluster/Servidores/data_cpu_report_Servidores.csv");
                            </script>
                        </div>
                    </div>
                    <div id="graph1" class="graph">
                        <div class="titleGraph">SERVIDORES NETWORK HEALTH</div>
                        <div class="network">
                            <script>
                                networkChart("chartsData/cluster/Servidores/data_network_report_Servidores.csv");
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