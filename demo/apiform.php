<?php include('../sdk/api.php'); ?>
<?php
if(isset($_REQUEST['submit'] )){
$method = $_REQUEST['submit'];
if($method == 'init-session'){
    $obj = new LiveEnsureApi();
    $rs =  $obj->initSession($_REQUEST['email']);
    header('Content-Type: application/json');
    echo json_encode($rs['content']);
   
    
}

if($method == 'add-prompt-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addPromptChallenge($_REQUEST['question'],$_REQUEST['answer'],$token);
    header('Content-Type: application/json');
    echo json_encode($rs);
  
    
}

if($method == 'add-location-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addLocationChallenge($_REQUEST['lat'],$_REQUEST['long'],$_REQUEST['selectedRadius'],$token);
    header('Content-Type: application/json');
    echo json_encode($rs);
    
    
}

if($method == 'add-behaviour-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addTouchChallenge($_REQUEST['orientation'],$_REQUEST['touches'],$token);
    header('Content-Type: application/json');
    echo json_encode($rs);
   
    
}

if($method == 'get-code'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->getAuthObj("IMG",$token);
    header('Content-Type: application/json');
    echo json_encode($rs);
   
    
}

if($method == 'poll-status'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->pollStatus($token);
    header('Content-Type: application/json');
    echo json_encode($rs['content']);
  
    
}
 
}
?>