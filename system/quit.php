<?php
session_start();
session_unset();
session_destroy();
header('location: /clubes-brasil-2/index.php/');
exit;