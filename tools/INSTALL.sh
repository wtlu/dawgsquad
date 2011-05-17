#!/bin/sh 
# 
# Author	: Greg Brandt, Ken Inoue
# Purpose	: This script sets up the CSE VM to serve Team Dawgsquad's
#                 CSE 403 SharingMedia application

# check to see if helper scripts are there
if [ ! -e "httpd_patch.pl" ]; then
    echo "Couldn't find httpd_patch.pl"
    exit
fi

if [ ! -e "user_setup.sql" ]; then
    echo "Couldn't find user_setup.sql"
    exit
fi

if [ ! -e "media_db_setup.sql" ]; then
    echo "Couldn't find media_db_setup.sql"
    exit
fi

# install apache, etc...
/sbin/chkconfig httpd on
/sbin/service httpd start
system-config-firewall-tui
yum -y install mysql mysql-server
/sbin/chkconfig  mysqld on
/sbin/service mysqld start
yum -y install php php-mysql
/sbin/service httpd restart

# add cake executable to the path
export PATH=$PATH:/var/www/html/dawgsquad/sharingmedia/cake/console

# set up database using scripts

#echo "Enter mysql root user: "
#read mysql_root_user
#echo "$mysql_root_user password is root"
echo "Setting up db user..."
mysql -u root < ./user_setup.sql
echo "Setting up db tables..."
mysql -u root < ./media_db_setup.sql
mysqladmin password "root"

# clone the repository to /var/www/html
yum -y install mercurial
cd /var/www/html
hg clone https://dawgsquad.googlecode.com/hg/ dawgsquad

# set correct ownership on tmp folder
cd dawgsquad/sharingmedia
chown -R `whoami` app/tmp
chmod -R 777 app/tmp

# restart apache
/etc/init.d/httpd restart

# installing perl and mailman for Testing Interface
yum install -y perl-IO-stringy
yum install -y perl-Mail-Sendmail
