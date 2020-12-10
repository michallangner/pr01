<html>
<body>
<h1>index.php</h1>
<?php

echo "<h4> 00 </h4>";

//We need to use an autoloader to import PHPOnCouch classes
//I will use composer's autoloader for this demo
$autoloader = join(DIRECTORY_SEPARATOR,[__DIR__,'vendor','autoload.php']);
require $autoloader;

echo "<h4> 01 </h4>";

$config = join(DIRECTORY_SEPARATOR,[__DIR__,'..','p','pr01-config.php']);
echo "<h4>$config</h4>";

$cfg = require $config;

echo "<h4> 02 </h4>";


//We import the classes that we need
use PHPOnCouch\CouchClient;
use PHPOnCouch\Exceptions;

//We create a client to access the database

$dsn = 'http://(user):(pass)@(host):(port)';
$dsn = str_replace('(user)',$cfg['user'],$dsn);
$dsn = str_replace('(pass)',$cfg['pass'],$dsn);
$dsn = str_replace('(host)',$cfg['host'],$dsn);
$dsn = str_replace('(port)',$cfg['port'],$dsn);
echo "dsn: ".$dsn."<br/>";

$my_database = "myownpocket(public)";
if ( CouchClient::isValidDatabaseName($my_database) ) {
    $client = new CouchClient("http://slftst:@Meka!23@146.59.17.22:5984/",$my_database);
} else {
    die("Invalid database name");
}

$dbs = $client->listDatabases();
print_r($dbs); // array ('first_database','another_database')

try {
    $client = new CouchClient('http://slftst:@Meka!23@146.59.17.22:5984', 'myownpocket');
    #$client = new CouchClient($dsn,'slftst01');
    echo "<hr/>";
    echo $client->dsn();
    $cookie = $client->getSessionCookie();
    echo "cookie: ".$cookie."<br/>";
} catch (Exception $ex) {
    echo "dupa";
    echo $ex->getMessage();
}
echo "<h4> 03... </h4>";

//We create the database if required
try {    
    if (!$client->databaseExists()) {
        echo "db create...";
        $client->createDatabase();
        echo "db created!";
    } else {
        echo "nop";
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo "<h4> 04 </h4>";

//We get the database info just for the demo
var_dump($client->getDatabaseInfos());

echo "<h4> 05 </h4>";

//Note:  Every request should be inside a try catch since CouchExceptions could be thrown.For example, let's try to get a unexisting document

try{
    $client->getDoc('the id');
    echo 'Document found';
}
catch(Exceptions\CouchNotFoundException $ex){
    if($ex->getCode() == 404)
        echo 'Document not found';
}

// Show all information, defaults to INFO_ALL
phpinfo();

?>
</body>
</html>
