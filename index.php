#! /usr/bin/env php

<?php

require 'vendor/autoload.php';

$app = new \Symfony\Component\Console\Application('Widgets', '0.1');
echo 'Hi';
/*
$app->config = include 'config/config.php';

$app->add(new \Euler\SetupCommand);
$app->add(new \Euler\CreateCommand(new \Goutte\Client));
$app->add(new \Euler\NextCommand);
$app->add(new \Euler\ImportCommand(new \ZipArchive));
$app->add(new \Euler\ExportCommand);
$app->add(new \Euler\RunCommand);
$app->add(new \Euler\ReadCommand);
$app->add(new \Euler\CurrentCommand);
$app->run();
*/
