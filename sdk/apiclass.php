<?php
include('api.php');
$method = $_REQUEST['submit'];
if($method == 'init-session'){
    $obj = new LiveEnsureApi();
    $rs =  $obj->initSession($_REQUEST['email']);
    header('Content-Type: application/json');
    echo json_encode($rs['content']);
    die;
    
}

   //   "TIME":{"endDate":"2020-06-09 03:53 PM","inout":"TRUE","required":"false","startDate":"2020-06-09 03:50 PM"}},

if($method == 'add-prompt-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addPromptChallenge($_REQUEST['question'],$_REQUEST['answer'],$token);
    header('Content-Type: application/json');
    echo json_encode($rs);
  
    
}



if($method == 'add-time-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addTimeChallenge($_REQUEST['startDate'],$_REQUEST['inOut'],$_REQUEST['endDate'],$token);
    header('Content-Type: application/json');
    echo json_encode($rs);
  
    
}
// if($method == 'add-location-challenge'){
//     $obj = new LiveEnsureApi();
//     $token = $_REQUEST['sessionToken'];
//     $rs =  $obj->addLocationChallenge($_REQUEST['lat'],$_REQUEST['long'],$_REQUEST['selectedRadius'],$token);
//     header('Content-Type: application/json');
//     echo json_encode($rs);
    
    
// }

if($method == 'add-location-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addLocationChallenge($_REQUEST['lat'],$_REQUEST['long'],$_REQUEST['selectedRadius'],$_REQUEST['inOut'],$token);
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


if($method == 'add-behaviour-v6-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addTouchV6Challenge($_REQUEST['touches'],$token);
    header('Content-Type: application/json');
    echo json_encode($rs);
   
    
}

if($method == 'add-bio-challenge'){
    $obj = new LiveEnsureApi();
    $token = $_REQUEST['sessionToken'];
    $rs =  $obj->addBioChallenge($_REQUEST['touches'],$token);
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
?>

