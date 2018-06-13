<?php

echo "Welcome to the safety assurance dashboard";


  echo "executing script";

  // execute R script from shell
  // this will save a plot at temp.png to the filesystem
  shell_exec("/var/www/html/sms/generate_graphs.sh");
  echo "<br>";
  echo "<img src='plot.jpg' alt='plot of description'>";

?>
