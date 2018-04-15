<?php 
	
	$output = shell_exec('/usr/bin/python script/mysqlbackup.py');

	echo $output;


	?>