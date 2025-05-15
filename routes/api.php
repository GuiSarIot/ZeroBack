<?php

//* Load API route files
$apiRouteFiles = glob(__DIR__ . '/api/*.php');

foreach ($apiRouteFiles as $routeFile) {
    require $routeFile;
}
