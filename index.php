<?php


//We need to use an autoloader to import PHPOnCouch classes
//I will use composer's autoloader for this demo
$autoloader = join(DIRECTORY_SEPARATOR,[__DIR__,'vendor','Autoload.php']);
require $autoloader;

echo "<h4> 01 </h4>";

//We import the classes that we need
use PHPOnCouch\CouchClient;
use PHPOnCouch\Exceptions;

//We create a client to access the database
$client = new CouchClient('http://admin:manager1@146.59.17.22:5984','myownpocket');

//We create the database if required
if(!$client->databaseExists()){
    $client->createDatabase();
}

//We get the database info just for the demo
var_dump($client->getDatabaseInfos());

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
