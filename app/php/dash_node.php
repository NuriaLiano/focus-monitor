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
$modFileDate = date("H", filemtime("chartsData/nodes/abedul/data_cpu_system_abedul.csv"));
if ($modFileDate < date("H")) {
    require_once 'requestCSV.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("header.php") ?>
    <script src="../js/prueba.js"></script>
    <title>Dashboard for node</title>
    
</head>

<body>
    <div class="container">
        <?php require_once("menu.php") ?>
        <main>
            <div class="graphs">
                <div class="headerSec">
                    <h2 class="titleIndex"><span id="nodeSel"></span>&nbsp;GRID </h2>
                    <div class="left">
                        <div class="titleGraph">Select node</div>
                        <div class="selectNode">
                            <select name="nodes" id="nodes">
                                <option class="" value="">Select node</option>
                                <option value="abedul">Abedul</option>
                                <option value="encina">Encina</option>
                                <option value="haya1">Haya1</option>
                                <option value="haya2">Haya2</option>
                                <option value="nat">Nat</option>
                                <option value="nogal">Nogal</option>
                                <option value="oceano">Oceano</option>
                                <option value="tejo">Tejo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="graph_header">
                    <div id="graph2" class="graph">
                        <div class="titleGraph">CPU System</div>
                        <div class="content1">
                        </div>
                    </div>
                    <div id="graph3" class="graph">
                        <div class="titleGraph">Disk Space Available</div>
                        <div class="content2">
                        </div>
                    </div>
                    <div id="graph4" class="graph">
                        <div class="titleGraph">Load Average</div>
                        <div class="content3">
                        </div>
                    </div>
                    <div id="graph5" class="graph">
                        <div class="titleGraph">Free Memory</div>
                        <div class="content4">
                        </div>
                    </div>
                    <div id="graph6" class="graph">
                        <div class="titleGraph">Total Pocesses</div>
                        <div class="content5">
                        </div>
                    </div>
                </div>
                <div class="graph_left">

                </div>
        </main>
    </div>
    <script src="../js/utils/refreshWeb.js"></script>
</body>

</html>