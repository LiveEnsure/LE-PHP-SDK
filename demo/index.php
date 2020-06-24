<?php
    $data = parse_ini_file("../config/settings.ini", true);
    if($data['API_KEY'] != '' ){
       header('location: device.php');
     }
    if(isset($_POST['submit'])){
        function write_ini_file($assoc_arr, $path) { 
    $content = ""; 
 
        foreach ($assoc_arr as $key=>$elem) { 
            if(is_array($elem)) 
            { 
                for($i=0;$i<count($elem);$i++) 
                { 
                    $content .= $key."[] = \"".$elem[$i]."\"\n"; 
                } 
            } 
            else if($elem=="") $content .= $key." = \n"; 
            else $content .= $key." = \"".$elem."\"\n"; 
        } 
  

    if (!$handle = fopen($path, 'w')) { 
        return false; 
    }

    $success = fwrite($handle, $content);
    fclose($handle); 

    return $success; 
}
       
        $apiData = array(
            'API_KEY' => $_POST['api_key'],
            'API_PASSWORD' => $_POST['api_password'],
            'AGENT_ID' => $_POST['agent_id'], 
            'API_HOST' => 'https://app.liveensure.com/live-identity',
            'GOOGLE_MAP_KEY' => $_POST['map_key'],  
        );
          write_ini_file($apiData, '../config/settings.ini');
         header('location: device.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <title>LiveEnsure PHP SDK</title>
</head>

<body>
    <header class="text-center">
        <h1 class="heading"> LiveEnsure <sup> &reg; </sup>. Live.</h1>
        <p class="sub-heading"> Real-time authentication solution demo with your mobile device. </p>
    </header>

    <div id="content">
    	<p class="text-center marginTop-40"> Please copy API credentials from your email received from LiveEnsure, paste in below form and save to proceed to the demo. </p>
		<form action="" method="post" class = "col-md-offset-3 col-md-6 text-center marginTop-20">
			<div class="form-group">
			<input type='hidden' name='csrfmiddlewaretoken' value='sPFfAZ6ewIXsAFdx4gt5p6N8EKhCDbBFQj3StH3KEhEWH1uLQy0AYgd02E03A4Uw' />
			<label class ="label-modify" for="key">API Key*:</label>
			<input class="form-control form-control-width-change" name="api_key" type="text" required>
			<label class ="label-modify marginTop-20" for="password">API Password*:</label>
			<input class="form-control form-control-width-change marginTop-20" name="api_password" type="password" required>
			<label class ="label-modify marginTop-20" for="id">Agent ID*:</label>
			<input name="agent_id" class="form-control form-control-width-change marginTop-20" type="text" required>

            <label class ="label-modify marginTop-20" for="id">Google Map Key:</label>
            <input name="map_key" class="form-control form-control-width-change marginTop-20" type="text">
			<button type="submit" name="submit" class="btn btn-default btn-modified marginTop-20">Save</button>
			</div>
		</form>
    </div>
    
    <script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        var agentId = "";
        var urls = {
            host: "",
            initSession: "/social/initSession",
            addPromptChallenge: "/live/add-prompt-challenge",
            addTimeChallenge: "/live/add-time-challenge"
            addLocationChallenge: "/live/add-location-challenge",
            getCode: "/social/getCode",
            pollStatus: "/social/pollStatus",
        };

        function getCookie(name) {
            var cookieValue = null;
            if (document.cookie && document.cookie !== '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) === (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
        var csrftoken = getCookie('csrftoken');
        function csrfSafeMethod(method) {
            // these HTTP methods do not require CSRF protection
            return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
        }
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                }
            }
        });
    </script>
    
</body>
</html>