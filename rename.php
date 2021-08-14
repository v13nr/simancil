<?php

rename(realpath(dirname(__FILE__)).'/install',realpath(dirname(__FILE__)).'/install_'.rand());
header('location: login.php');
?>