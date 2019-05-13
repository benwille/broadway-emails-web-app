#! /bin/sh
cd /var/www/html/broadway/private/cron/; php /var/www/html/broadway/private/cron/feed.cron.php 1;
php /var/www/html/broadway/private/cron/feed.cron.php 2;
php /var/www/html/broadway/private/cron/feed.cron.php 3;
php /var/www/html/broadway/private/cron/feed.cron.php 4;
php /var/www/html/broadway/private/cron/feed.cron.php 5;
php /var/www/html/broadway/private/cron/feed.cron.php 6;
#sudo chmod +x scriptpath/name.sh
#wget 'http://localhost/RSL/public/staff/posts/news_feed.php'
