<html>
<body>
<h1>index.php</h1>
<?php

//We need to use an autoloader to import PHPOnCouch classes
//I will use composer's autoloader for this demo
$autoloader = join(DIRECTORY_SEPARATOR,[__DIR__,'vendor','autoload.php']);
require $autoloader;

$config = join(DIRECTORY_SEPARATOR,[__DIR__,'..','p','pr01-config.php']);
$cfg = require $config;

//We import the classes that we need
use PHPOnCouch\CouchClient;
use PHPOnCouch\Exceptions;

//We create a client to access the database
$dsn = 'http://(user):(pass)@(host):(port)';
$dsn = str_replace('(user)',$cfg['user'],$dsn);
$dsn = str_replace('(pass)',$cfg['pass'],$dsn);
$dsn = str_replace('(host)',$cfg['host'],$dsn);
$dsn = str_replace('(port)',$cfg['port'],$dsn);
#echo "dsn: ".$dsn."<br/>";

try {
    $client = new CouchClient($dsn, $cfg['name']);
} catch (Exception $ex) {
    echo $ex->getMessage();
}


//We get the database info just for the demo
var_dump($client->getDatabaseInfos());

echo "<h4> 05 </h4>";

//Note:  Every request should be inside a try catch since CouchExceptions could be thrown.For example, let's try to get a unexisting document

try{
    $doc = $client->getDoc('f2555c998125e3ff19b6824154000912');
    echo 'Document found';
}
catch(Exceptions\CouchNotFoundException $ex){
    if($ex->getCode() == 404)
        echo 'Document not found';
}
echo $doc->_id.' revision '.$doc->_rev;
echo "<hr/>";
print_r(json_encode($doc));

// Show all information, defaults to INFO_ALL
phpinfo();

?>
</body>
</html>
