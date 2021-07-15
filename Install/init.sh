#!/bin/bash
echo ""
# Check installations php,apache,mysql
if [ -f /usr/bin/php ]; 
then
	echo "PHP VERSION: "
	php -v
	echo ""
else
	echo "PHP missing. Install php. "
	return;
fi

if [ -f /sbin/chkconfig ]; 
then
	echo "chkconfig found! "
	echo ""
else
	echo "chkconfig missing. Install chkconfig. "
	return;
fi

if [ -f /usr/sbin/postfix ]; 
then
	echo "postfix found! "
	echo ""
else
	echo "<span style='color:red'>Postfix  not found!  Please install it before continue.</span>"
	echo "If distribution is Ubuntu remove /html/ from the path"
	echo "Run command: dos2unix /var/www/html/Install/InstallPostfix.sh"
	echo "Run command: sudo sh /var/www/html/Install/InstallPostfix.sh"
	echo ""
	return;
fi

if [ -d /var/www/html ]
then 
    mkdir -p /var/www/html/lib/css/images/ScannedImage/old
else
    mkdir -p /var/www/lib/css/images/ScannedImage/old
fi

if [ -f /usr/sbin/apache2 ]; 
then
	echo "WEBSERVER VERSION: "
	apache2 -v
	chkconfig --level 345 apache2 on
	chkconfig apache2 -l
	echo ""
else
	if [ -f /usr/sbin/httpd ];
	then
		echo "WEBSERVER VERSION: "
		httpd -v
		chkconfig --level 345 httpd on
		chkconfig httpd -l
		echo ""
	else
		echo "Apache2 or Httpd webserver missing.. "
	return;
	fi
fi

if [ -f /usr/bin/mysql ]; 
then
	echo "MYSQL VERSION: "
	mysql -V
	chkconfig --level 345 mysql on
	chkconfig mysql -l
	echo ""
else
	echo "Mysql missing. Install mysql server. "
	return;
fi


# Set httpd user and group
httpd_user=$(ps axho user,comm|grep -E "httpd|apache"|uniq|grep -v "root"|awk 'END {if ($1) print $1}')
httpd_group=$(ps axho group,comm|grep -E "httpd|apache"|uniq|grep -v "root"|awk 'END {if ($1) print $1}')

# Set data-file
datafile=t700_env.txt

# Remove old datafile
if [ -f $datafile ];
then
   rm -f ./$datafile
fi

# Set httpd user and group
echo "HTTPD_USER=$httpd_user" >> $datafile
echo "HTTPD_GROUP=$httpd_group" >> $datafile

# Set T700 home
dir=`pwd`
parentdir="$(dirname "$dir")"
T700_ROOT=$parentdir
echo "T700_ROOT=$parentdir" >> $datafile

# T700 database name
T700_DATABASE=t700
echo "T700_DATABASE=$T700_DATABASE" >> $datafile

# Empty skeleton database
initdatabase=$T700_ROOT/lib/Database/defaults/blank_database.sql
echo "T700_INIT_DATABASE=$initdatabase" >> $datafile

# Init database, import database skeleton
mysql -u username -p -h localhost $T700_DATABASE < $initdatabase

# Set file ownership
chown -R $httpd_user:$httpd_group $T700_ROOT

# Set file permissions
chmod -R 777 $T700_ROOT

# Restart apache
if [ -f "etc/init.d/httpd" ];then
	service httpd restart
fi	
if [ -f "etc/init.d/apache2" ];then
	service apache2 restart
fi
