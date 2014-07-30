<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
require('include/config.php');
ob_start();
ControllerFactory::getController('DynamicTournamentController')->run();
$contents	= json_encode(ob_get_contents());
ob_end_clean();
echo "data: {$contents}\n\n";
flush();