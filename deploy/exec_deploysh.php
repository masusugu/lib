<?php 
$path = '/path/to/deploy_shell.sh';
$branch = 'TARGET_BRANCH';
$secret = 'WEBHOOK_SECRET';
 
$headers = getallheaders();
$hubSignature = $headers['X-Hub-Signature'];
 
// Split signature into algorithm and hash
list($algo, $hash) = explode('=', $hubSignature, 2);
 
// Get payload
$payload = file_get_contents('php://input');
 
// Calculate hash based on payload and the secret
$payloadHash = hash_hmac($algo, $payload, $secret);
 
// Check if hashes are equivalent
if ($hash !== $payloadHash) {
	print_r('invalid secret');
    die();
}
if ($_POST['payload']) {
	$decode = json_decode($_POST['payload']);
	if ($decode->{'ref'} == 'refs/heads/'.$branch) {
		exec('sudo sh '.$path, $output);
		print_r($output);
	} else {
		print_r('is not '.$branch.' branch');
	}
} else {
	print_r('invalid access');
}
?>