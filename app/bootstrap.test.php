<?php

include 'bootstrap.php.cache';

echo "\r\ntruncate bdd...\r\n";

echo exec('php /home/worldcup/www/app/console doctrine:schema:drop --force');

echo "\r\nload schema bdd...\r\n";

echo exec('php /home/worldcup/www/app/console doctrine:schema:update --force');

echo "\r\nLoading datafixture test ...\r\n";

echo exec('php /home/worldcup/www/app/console doctrine:fixtures:load --fixtures=/home/worldcup/www/src/ZIMZIM/Test/DataFixtures/ORM -n');

echo "\r\nDatafixture loaded\r\n";