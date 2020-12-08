<html>
<body>
<h3>git...</h3>
<h4>trump do</h4>
<?php
#$output = shell_exec("git clone 2>&1");
#$output = shell_exec("git clone https://github.com/michallangner/pr01.git 2>&1");
$output = shell_exec("git --git-dir=/var/www/pr01/.git --work-tree=/var/www/pr01 pull 2>&1");
#$output = shell_exec("git --git-dir=/var/www/pr01/.git --work-tree=/var/www/pr01 status 2>&1");

echo "<p>$output</p>";
?>
<?php
echo "<hr/>";
$q1 = shell_exec("echo blabla");
echo "<p>$q1</p>";
?>
<?php
     echo shell_exec('whoami');
echo "<hr/>";
$date = date('Y-m-d H:i:s');
echo "<h4>$date</h4>";
?>
</body>
</html>
