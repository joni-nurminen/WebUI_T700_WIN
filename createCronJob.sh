#!/bin/sh
if [ -f /etc/os-release ]; then
	#remove cronjob
	crontab -u www-data -r
	#write out current crontab
	crontab -u www-data -l > mycron
	#echo new cron into cron file
	echo "$1 $2 $3 $4 $5 php /var/www/mail.php" > mycron
	#install new cron file
	crontab mycron
	rm mycron
elif [ -f /etc/redhat-release ]; then
	#remove cronjob
	crontab -u apache -r
	#write out current crontab
	crontab -u apache -l > mycron
	#echo new cron into cron file
	echo "$1 $2 $3 $4 $5 php /var/www/html/mail.php" > mycron
	#install new cron file
	crontab mycron
	rm mycron
else
	echo "Cant't identify release.. Creating cronjob failed.."
	exit 1
fi


