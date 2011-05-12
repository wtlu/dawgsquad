#!/bin/sh 
# 
# Author	: Greg Brandt, Ken Inoue
# Purpose	: This script sets up the CSE VM to serve Team Dawgsquad's
#                 CSE 403 SharingMedia application

# install apache, etc...
/sbin/chkconfig httpd on
/sbin/service httpd start
system-config-firewall-tui
yum install mysql mysql-server
/sbin/chkconfig  mysqld on
/sbin/service mysqld start
yum install php php-mysql
/sbin/service httpd restart

# clone the repository to /var/www/html
yum install mercurial
cd /var/www/html
hg clone https://dawgsquad.googlecode.com/hg/ dawgsquad

# set correct ownership on tmp folder
cd dawgsquad/sharingmedia
chown -R `whoami` app/tmp

# add cake executable to the path
export PATH=$PATH:/var/www/html/dawgsquad/sharingmedia/cake/console

# this modifies L290 of /etc/httpd/conf/httpd.conf
# to read 'AllowOverride All' instead of 'AllowOverride None'
perl httpd_patch.pl /etc/httpd/conf/httpd.conf

# set up database using scripts
echo "Enter mysql root user: "
read mysql_root_user
echo "Setting up db user...\n"
mysql -u $mysql_root_user -p < user_setup.sql
echo "Setting up db tables...\n"
mysql -u $mysql_root_user -p < media_db_setup.sql

