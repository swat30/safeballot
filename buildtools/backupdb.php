<?php
include '../include/db-config.php';
exec('mysqldump ' . $dbase . ' -u ' . $dbuser . ' -p' . $dbpass . ' > schema.sql');
?>