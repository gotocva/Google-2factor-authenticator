<?php
include 'vendor/autoload.php'; 

header('Content-Type: application/json');

$g = new \Google\Authenticator\GoogleAuthenticator();
$username = "blockstreet";
$secret = $g->generateSecret();

if (isset($_GET['action'])) {
    
    switch ((string) $_GET['action']) {

        case 'generate':
            $image = $g->getURL($username, 'blockstreet.com', $secret);
            echo json_encode(array('image'=>$image,'secret'=>$secret));
            break;
        
        case 'validate':
            if ($g->checkCode($_GET['secret'], $_GET['code'])) {
                echo json_encode(array('status'=>true));
            } else {
                echo json_encode(array('status'=>false));
            }
            break;

        default:
            # code...
            break;
    }
}

?>