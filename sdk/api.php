<?php 
   
class LiveEnsureApi
{
    public $apiVersion = "5";
    public $stackLocation = "US";
    public $sessionToken = "";
    public $debug = False;
  
    
  public function __Construct()
  {
       $dataApi = parse_ini_file("../config/settings.ini", true);
        
       $this->apiKey = $dataApi['API_KEY'];
       $this->apiPassword = $dataApi['API_PASSWORD'];
       $this->agentId = $dataApi['AGENT_ID'];
       $this->leHostBase = $dataApi['API_HOST'];
       $this->leHostUrl =  $this->leHostBase."/rest";
  }
  /*Function to initialize session*/
  public function initSession($userId)
  {
        $data = array(
            'apiVersion'=>  $this->apiVersion,
            'userId'=>  $userId,
            'agentId'=>  $this->agentId,
            'apiKey'=>  $this->apiKey
        );
       
       
      $url = $this->leHostUrl."/host/session";
        $result = $this->curl_json($url,'PUT',$data);  
        $result['userId'] = $userId;
       return $result;
        

     
   }
   /*Function to run CURL*/
   public function curl_json($url, $method='PUT', $data='') {
	$ch = curl_init();
  
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
  	curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');

	if ($method != 'GET') {
		$data_json = json_encode($data);
	  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    
	}
  	$content = curl_exec($ch);
  	$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  	curl_close($ch);
  	$content_json = json_decode($content);
       
	$result =  array('code' => $http_status, 'content' => $content_json);
         
        return $result;
}
   

/*Function to perform Knowledge challenge*/
   public function addPromptChallenge($question, $answer, $sessionToken){
        $type = "PROMPT";             # Required
        $required = "true";           # Required
        $fallback = "0";              # Required
        $maxAt = "1";                 # Required

        $details = array(
                   "question"           => $question,
                   "answer"             => $answer, 
                   "required"           => $required, 
                   "fallbackChallengeID"=> $fallback, 
                   "maximumAttempts"    => $maxAt
        );
                
        $data = array(
                'sessionToken'     => $sessionToken, 
                'challengeType'    => $type, 
                'agentId'          => $this->agentId, 
                'challengeDetails' => $details 
                );

                $url = $this->leHostUrl."/host/challenge";
                $result = $this->curl_json($url,'PUT',$data);  
                // $result['userId'] = $userId;
                 return $result;
   }


   /*Function to perform Knowledge challenge*/
   public function addTimeChallenge($startDate, $inout, $endDate, $sessionToken){
    $type = "TIME";             # Required
    $required = "true";           # Required
    $fallback = "0";              # Required
    $maxAt = "1";                 # Required

    $details = array(
               "endDate"           => $endDate,
               "startDate"         => $startDate,
               "inout"             => $inout, 
               "required"           => $required, 
               "fallbackChallengeID"=> $fallback, 
               "maximumAttempts"    => $maxAt
    );
            
    $data = array(
            'sessionToken'     => $sessionToken, 
            'challengeType'    => $type, 
            'agentId'          => $this->agentId, 
            'challengeDetails' => $details 
            );

            $url = $this->leHostUrl."/host/challenge";
            $result = $this->curl_json($url,'PUT',$data);  
            // $result['userId'] = $userId;
             return $result;
}
   
   
   /* Function to perform Bio Challenge*/   
     public function addBioChallenge($touches, $sessionToken){

        $type = "BIOMETRIC";      # Required
        $required = "true";  

        $details = array(
                   "touches"             => $touches,
                   "required"            => $required               );
                
        $data = array(
                'sessionToken'     => $sessionToken, 
                'challengeType'    => $type, 
                'agentId'          => $this->agentId, 
                'challengeDetails' => $details 
                );
        
                $url = $this->leHostUrl."/host/challenge";
                $result = $this->curl_json($url,'PUT',$data);  
            
                 return $result;
   }
   
    /*Function to perform Behaviour Challenge*/
   public function addTouchChallenge($orientation, $touches, $sessionToken){

        $type = "HOST_BEHAVIOR";      # Required
        $regionCount = "6";           # Grid pattern
        $required = "true";           # Required
        $fallback = "0";              # Required
        $maxAt = "1";                 # Max retries

        $details = array(
                  
                   "orientation"         => $orientation,
                   "touches"             => $touches, 
                   "regionCount"         => $regionCount,
                   "required"            => $required, 
                   "fallbackChallengeID" => $fallback, 
                   "maximumAttempts"     => $maxAt
                   );
                
        $data = array(
                'sessionToken'     => $sessionToken, 
                'challengeType'    => $type, 
                'agentId'          => $this->agentId, 
                'challengeDetails' => $details 
                );
        
                $url = $this->leHostUrl."/host/challenge";
                $result = $this->curl_json($url,'PUT',$data);  
            
                 return $result;
   }

    /*Function to perform Behaviour v6 Challenge*/
    public function addTouchV6Challenge($touches, $sessionToken){

        $type = "HOST_BEHAVIOR_V6";      # Required
        $required = "true";           # Required
        $fallback = "0";              # Required
        $maxAt = "1";                 # Max retries

        $details = array(
                  
                   "touches"             => $touches, 
                //    "regionCount"         => $regionCount,
                   "required"            => $required, 
                   "fallbackChallengeID" => $fallback, 
                   "maximumAttempts"     => $maxAt
                   );
                
        $data = array(
                'sessionToken'     => $sessionToken, 
                'challengeType'    => $type, 
                'agentId'          => $this->agentId, 
                'challengeDetails' => $details 
                );
        
                $url = $this->leHostUrl."/host/challenge";
                $result = $this->curl_json($url,'PUT',$data);  
            
                 return $result;
   }
   
   /*Function to perform location challenge*/
   public function addLocationChallenge($latitude, $longitude, $radius, $inout, $sessionToken){

        $type = "LAT_LONG_V6";      # Required
        $required = "true";       # Required
        $fallback = "0";          # If fail, other challenge
        $maxAt = "1";             # Retries

        $details = array(
                   "latitude"            => $latitude,
                   "longitude"           => $longitude, 
                   "radius"              => $radius,
                   "inout"              => $inout,
                   "required"            => $required, 
                   "fallbackChallengeID" => $fallback, 
                   "maximumAttempts"     => $maxAt
                        );
                
        $data = array(
                'sessionToken'     => $sessionToken, 
                'challengeType'    => $type, 
                'agentId'          => $this->agentId, 
                'challengeDetails' => $details
                );

                $url = $this->leHostUrl."/host/challenge";
                $result = $this->curl_json($url,'PUT',$data);  
                // $result['userId'] = $userId;
                 return $result;
   }

   /*Function to authenticate session token*/
   public function getAuthObj($type, $sessionToken){
        if ($sessionToken == "ERROR"){
            # logger("Invalid SessionToken " + sessionToken)
            # logger("Quitting.")
            exit();
        }
        $qurl = $this->leHostBase."/QR?w=240&sessionToken=".$sessionToken;
        $furl = $this->leHostBase."/launcher?sessionToken=".$sessionToken;
        $lirl = $this->leHostBase."/launcher?sessionToken=".$sessionToken."&light=1";
        $lurl = "liveensure://?sessionToken=".$sessionToken."&status=".$this->leHostBase."/rest";
       
        if ($type == "IMG"){
             
            return($qurl);
        }
        elseif ($type == "COMBO"){
            return($furl);
        }
        elseif ($type == "LIGHT"){
            return($lirl);
        }
        elseif ($type == "LINK"){
            return($lurl);
        }
        else{
            return "NOTOKEN";
        }
   }

   /*Function to peform polling*/
   public function pollStatus($sessionToken){
        if ($sessionToken == "ERROR"){
            exit();
        }
        $p = $this->curl_json($this->leHostUrl. "/host/session" ."/" . $sessionToken . "/" . $this->agentId,"GET");

        return $p;
   }
   
    /*Function to delete user*/
   public function deleteUser($userId){
        $data = array(
            'apiVersion' => $this->apiVersion,
            'userId'     => $userId,
            'agentId'    => $this->agentId,
            'apiKey'     => $this->apiKey
        );
        $url = $this->leHostUrl."/host/user";
        $result = $this->curl_json($url,'DELETE',$data);  
        return $result;

   }
 


}

 
