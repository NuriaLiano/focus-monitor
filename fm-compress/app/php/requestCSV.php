<?php

require_once 'objects/newFormat.php';

//GLOBAL

function loadGlobalChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&me=SCI&m=load_one&s=by+name&mc=2&g=load_report");
    $createCSV->main();
};
function memGlobalChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&me=SCI&m=load_one&s=by+name&mc=2&g=mem_report");
    $createCSV->main();
}
function cpuGlobalChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&me=SCI&m=load_one&s=by+name&mc=2&g=cpu_report");
    $createCSV->main();
}
function networkGlobalChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&me=SCI&m=load_one&s=by+name&mc=2&g=network_report");
    $createCSV->main();
}

loadGlobalChart();
memGlobalChart();
cpuGlobalChart();
networkGlobalChart();

//CLUSTER

function loadClusterChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&m=load_one&s=by+name&mc=2&g=load_report");
    $createCSV->main();
};
function memClusterChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&m=load_one&s=by+name&mc=2&g=mem_report");
    $createCSV->main();
}
function cpuClusterChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&m=load_one&s=by+name&mc=2&g=cpu_report");
    $createCSV->main();
}
function networkClusterChart(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&m=load_one&s=by+name&mc=2&g=network_report");
    $createCSV->main();
}

loadClusterChart();
memClusterChart();
cpuClusterChart();
networkClusterChart();

//ABEDUL
function dCPUSys_abedul(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=abedul.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_abedul(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=abedul.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_abedul(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=abedul.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_abedul(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=abedul.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_abedul(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=abedul.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//encina
function dCPUSys_encina(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=encina.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_encina(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=encina.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_encina(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=encina.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_encina(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=encina.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_encina(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=encina.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//haya1
function dCPUSys_haya1(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya1.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_haya1(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya1.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_haya1(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya1.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_haya1(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya1.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_haya1(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya1.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//haya2
function dCPUSys_haya2(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya2.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_haya2(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya2.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_haya2(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya2.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_haya2(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya2.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_haya2(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=haya2.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//nat
function dCPUSys_nat(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nat.macc.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_nat(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nat.macc.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_nat(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nat.macc.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_nat(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nat.macc.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_nat(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nat.macc.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//nogal
function dCPUSys_nogal(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nogal.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_nogal(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nogal.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_nogal(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nogal.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_nogal(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nogal.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_nogal(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=nogal.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//oceano
function dCPUSys_oceano(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=oceano.macc.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_oceano(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=oceano.macc.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_oceano(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=oceano.macc.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_oceano(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=oceano.macc.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_oceano(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=oceano.macc.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//tejo
function dCPUSys_tejo(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=tejo.unican.es&jr=&js=&v=0.3&m=cpu_system&vl=%25&ti=CPU+System");
    $createCSV->main();
};
function dDiskSpace_tejo(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=tejo.unican.es&jr=&js=&v=8158.710&m=disk_free&vl=GB&ti=Disk+Space+Available");
    $createCSV->main();
}
function dLoadAv_tejo(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=tejo.unican.es&jr=&js=&v=0.10&m=load_fifteen&vl=+&ti=Fifteen+Minute+Load+Average");
    $createCSV->main();
}
function dFreeMem_tejo(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=tejo.unican.es&jr=&js=&v=189188&m=mem_free&vl=KB&ti=Free+Memory");
    $createCSV->main();
}
function dTotalProc_tejo(){
    $createCSV = new newFormartCSV("http://meteo.unican.es/ganglia/graph.php?r=hour&z=xlarge&c=Servidores&h=tejo.unican.es&jr=&js=&v=856&m=proc_total&vl=+&ti=Total+Processes");
    $createCSV->main();
}

//ABEDUL

dCPUSys_abedul();
dDiskSpace_abedul();
dLoadAv_abedul();
dFreeMem_abedul();
dTotalProc_abedul();

//ENCINA

dCPUSys_encina();
dDiskSpace_encina();
dLoadAv_encina();
dFreeMem_encina();
dTotalProc_encina();

//HAYA1

dCPUSys_haya1();
dDiskSpace_haya1();
dLoadAv_haya1();
dFreeMem_haya1();
dTotalProc_haya1();

//HAYA2

dCPUSys_haya2();
dDiskSpace_haya2();
dLoadAv_haya2();
dFreeMem_haya2();
dTotalProc_haya2();

//NAT

dCPUSys_nat();
dDiskSpace_nat();
dLoadAv_nat();
dFreeMem_nat();
dTotalProc_nat();

//NOGAL

dCPUSys_nogal();
dDiskSpace_nogal();
dLoadAv_nogal();
dFreeMem_nogal();
dTotalProc_nogal();

//OCEANO

dCPUSys_oceano();
dDiskSpace_oceano();
dLoadAv_oceano();
dFreeMem_oceano();
dTotalProc_oceano();

//TEJO

dCPUSys_tejo();
dDiskSpace_tejo();
dLoadAv_tejo();
dFreeMem_tejo();
dTotalProc_tejo();


?>