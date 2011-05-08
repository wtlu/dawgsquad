#!/bin/bash

# configure apache, install mysql, install php
/sbin/chkconfig httpd on
/sbin/service httpd start
system-config-firewall-tui
yum install mysql mysql-server
/sbin/chkconfig  mysqld on
/sbin/service mysqld start
yum install php php-mysql
/sbin/service httpd restart
echo "<?php phpinfo(); ?>" > /var/www/html/index.php

# install mercurial
yum install mercurial

# clone the repository (i.e. install the application)
cd /var/www/html
hg clone https://dawgsquad.googlecode.com/hg/ dawgsquad

# set correct ownership on tmp folder
cd dawgsquad/sharingmedia
chown -R `whoami` app/tmp
