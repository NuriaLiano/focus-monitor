import platform
import apt
import sys
import subprocess
import os
import shutil

# global var
path_file = "dependencies"
root_name = "root"
database = "focusmonitor"
file_database = "focusmonitor.sql"
#main_web_path = "/var/www/focusmonitor"
app_web_path = "/var/www/focusmonitor"
log_path = "/var/log/focusmonitor"
virtualH_path = "/etc/apache2/sites-available/focusmonitor.conf"

# Def functions
def installDependencies():
    with open(path_file, "r") as file:
        print("[--------------- INSTALLING ALL DEPENDENCIES ---------------]")
        subprocess.run(["add-apt-repository", "-y", "ppa:ondrej/php"])
        subprocess.run(["add-apt-repository", "-y", "ppa:phpmyadmin/ppa"])

        subprocess.run(["bash", "install_phpmyadmin.sh"])
        for line in file:
            package = line.rstrip()
            cache = apt.cache.Cache()
            cache.update()
            cache.open()

            pkg = cache[package]
            if pkg.is_installed:
                print("{pkg_name} already installed " .format(pkg_name=package))
            else:
                pkg.mark_install()
                try:
                    cache.commit()
                except Exception as arg:
                    print >> sys.stderr, "Sorry, package installation failed [{err}]".format(
                    err=str(arg))
        subprocess.run(["a2enmod", "php8.1.load"])
        print("[-------------- INSTALL COMPOSER --------------]")
        subprocess.run(["bash", "install_composer.sh"])
#        subprocess.run(["composer install", "../app/"])
        print("[--------------- ALL DEPENDENCIES HAVE BEEN INSTALLED ---------------]")

def moveApp():
    print("[--------------- THE DIRECTORIES ARE BEING RESTRUCTURED ---------------]")
    
    shutil.rmtree(app_web_path)
    shutil.copytree('../../fm-compress', app_web_path)

    print("[--------------- THE DIRECTORIES HAVE BEING RESTRUCTURED ---------------]")
    
    shutil.rmtree(app_web_path)
    shutil.copytree('../../fm-compress', app_web_path)

    print("[--------------- THE DIRECTORIES HAVE BEING RESTRUCTURED ---------------]")

def createErrorDirectory():
    print("[--------------- THE ERROR LOG DIRECTORY IS BEING CREATED ---------------]")
    if not os.path.isdir(log_path):
        os.mkdir(log_path, 0o777)
        #the errorlog file will be created with php object errorlog.php
    print("[--------------- THE ERROR LOG DIRECTORY HAS BEING CREATED ---------------]")

def createVirtualHost():
    print("[--------------- CREATING THE VIRTUAL HOST ---------------]")
    if not os.path.isfile(virtualH_path):
        shutil.copyfile("focusmonitor.conf", virtualH_path)
        #disable default site
        subprocess.run(["a2dissite", "000-default.conf"])
        #enable focusmonitor site
        subprocess.run(["a2ensite", "focusmonitor.conf"])

        #restart apache2 service
        os.system("sudo /etc/init.d/apache2 restart")
    print("[--------------- THE VIRTUAL HOST HAVE BEING CREATED ---------------]")

# comprobar si es windows o linux
if "Windows" in platform.system():
    print("This app in only available in Linux System, please consider switch to the best OS Debian :)")
else:
    print("[--------------- FOCUS MONITOR WILL BE CONFIGURED ---------------]")
    print("[-- 1. Install all dependencies --]")
    print("[-- 2. Restructure all directories --]")
    print("[-- 3. Import database --]")
    print("[-- 4. Create error log directory --]")
    print("[-- 5. Create virtual host for Focus Monitor --]")
    print("[-- 6. Restart all services --]")
    
    installDependencies()
     # importar base de datos
    #subprocess.run(["mysql", "-u "+root_name +" -proot "+ database +" < "+ file_database +""])

    # # mover contenido de app a /var/www/focus-monitor.
    moveApp()
    
    # # crear carpeta y revisar los permisos errorlog
    createErrorDirectory()
    
    # # generar virtual host para la app
    createVirtualHost()

    # # reiniciar los servicios
    os.system("sudo /etc/init.d/apache2 restart")
    os.system("sudo /etc/init.d/mysql restart")
