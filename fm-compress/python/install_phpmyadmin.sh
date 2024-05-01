#!/bin/bash

apt update -y && apt install -y wget 

export DEBIAN_FRONTEND=noninteractive
echo -e "\e[96m ########## MYSQL INSTALLATION ##########  \e[39m"

# Download Debian package (.deb) that adds and configures the MySQL repository:
wget -O mysql_all.deb https://dev.mysql.com/get/mysql-apt-config_0.8.18-1_all.deb
dpkg -i mysql_all.deb

#add key
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys 467B942D3A79BD29

# Remove .deb package because no longer needed it:
rm -rf mysql_all.deb

apt update

# Install MySQL 8.0:
apt install -y mysql-server

echo "MYSQL VERSION: $(mysql --version)"
echo -e "\n"

# check if MySQL service is running:
#echo -e "\e[96m ########## MYSQL STATUS ##########  \e[39m"
#service mysql status

# Change password of root user by running SQL statement:
mysql -u root -e "ALTER USER root@localhost IDENTIFIED WITH caching_sha2_password BY 'root';"

echo -e "\e[96m ########## PHPMYADMIN INSTALLATION ##########  \e[39m"
echo -e "\n"
echo -e "\e[96m Adding PPA  \e[39m"
add-apt-repository -y ppa:phpmyadmin/ppa
apt update

echo -e "\e[96m Begin silent install phpMyAdmin \e[39m"

echo -e "\e[93m User: root, Password: root \e[39m"
# Set non-interactive mode
debconf-set-selections <<<'phpmyadmin phpmyadmin/dbconfig-install boolean true'
debconf-set-selections <<<'phpmyadmin phpmyadmin/app-password-confirm password root'
debconf-set-selections <<<'phpmyadmin phpmyadmin/mysql/admin-pass password root'
debconf-set-selections <<<'phpmyadmin phpmyadmin/mysql/app-pass password root'
debconf-set-selections <<<'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2'

apt-get -y install phpmyadmin

# Restart apache server
service apache2 restart

# Clean up
apt-get clean

echo -e "\e[92m phpMyAdmin installed successfully \e[39m"