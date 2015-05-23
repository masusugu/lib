<?php 
$path = '/path/to/deploy_shell.sh';
if ($_POST['payload']) {
	$decode = json_decode($_POST['payload']);
		if ($decode->{'ref'} == 'refs/heads/develop') {
			exec('sudo sh '.$path, $output);
			print_r('deployed.');
		}
	}
?>