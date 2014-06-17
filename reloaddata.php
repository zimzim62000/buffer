<?php

exec('php app/console doctrine:schema:drop --force');

exec('php app/console doctrine:schema:update --force');

exec('php app/console doctrine:fixtures:load -n');