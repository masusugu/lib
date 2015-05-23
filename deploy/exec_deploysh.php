<?php 
if ($_POST['payload']) {
	$decode = json_decode($_POST['payload']);
		if ($decode->{'ref'} == 'refs/heads/develop') {
			exec('sudo sh /home/intronworks/deploy_DEVELOP_leaglesapp.sh', $output);
			print_r('deployed.');
		}
	}
?>