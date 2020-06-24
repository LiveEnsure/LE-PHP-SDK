# LiveEnsure PHP SDK

This is the LiveEnsure® PHP DEMO SDK for LiveEnsure Authentication (www.liveensure.com)
>From this SDK you will be able to launch a full API stack in PHP and demonstrate the 
full capabilities of LiveEnsure® Authentication for web, cloud, apps and mobile.

The SDK is provided to illustrate how to integrate LiveEnsure® with your identity, web or
app platforms. For futher information, visit the SDK docs at http://developer.liveensure.com 

You will need to obtain LiveEnsure® developer API keys to test this API and sign up for a 
paid LiveEnsure service subscription to use the API/SDK in production. 

This SDK functions in desktop-browser and mobile-browser (app to app) modes, depending on how
you access the pages. From a desktop, you will scan with the free LiveEnsure app to authenticate
based on the settings you configure to drive the API. If you acccess the pages from your mobile
device, the SDK will behave in an app-to-app fashion, rolling over to authenticate as in an app
or mobile HTML implementation, without providing or requiring a scan step. 

For questions about this SDK or LiveEnsure® authentication, visit support.liveensure.com 

## Getting Started

* **First,** sign up at http://www.liveensure.com/signup.html for your developer API keys.
* **Second,** download the free LiveEnsure app for iOS or Android http://www.liveensure.com/app.html
* **Third,** download, configure and run this SDK on your local or networked machine as instructed.

### Prerequisites

Below packages need to be installed and configured:
- network accessible server (or virtual instance)
- PHP 5.5+
- Obtain LiveEnsure® developer API keys by signup (http://www.liveensure.com/signup.html) and then click the link "Send me my credentials by email" after login
- Google MAP api key (optional for location factors)

### Installing

To install `liveensuredemo` app, git clone or download the repository from URL https://github.com/LiveEnsure/PHP-SDK
    
### Configuration
* Include following setting in your `config/settings.ini` file:

```    
API_KEY = "<API key for liveensure>"
API_PASSWORD = "<API password>"
AGENT_ID = "<Agent ID for liveensure>"
API_HOST = "https://app.liveensure.com/live-identity"
GOOGLE_MAP_KEY = "<Optional Google Map key to access map to run location auth demo>"
```

* Test your SDK demo application:

```
Add your vritualhost in apache configuration or open using IP as per your server configuration
```


## Running the SDK

If the SDK is available to access using IP, open the application using IP URL (http://<Your IP><:Port if configured>/<SDK Path>/demo/index.php)

If you want to access the SDK using domain URL, you need to create VirtualHost in apache configuration, restart the apache server and then open URL ((http://<Your virtualhost domain><:Port if configured>/<SDK Path>/demo/index.php)

If your domain does not exist, add the local domain in your local DNS file. For Pc, you can find the hosts file at location (Windows\System32\drivers\etc\hosts). Add entry like:
```    
<Your domain> <Your IP where code is hosted>
```    
### Desktop/Browser Authentication via Mobile Scan

Walk through each factor tab and how to test/engage desktop with mobile scan.

[1] To test to basic device authentication factor, simply click [DEVICE] tab,
enter your email and click login. Scan screen to authenticate. 

On your first login, you will get an emailed OOB token to enter/register in app.

[2] To test knowledge challenge, click the [Knowledge] tab, enter your email and
choose a challenge question and anwner/response. This is teeing up the API, as the
end-user would not see this. Then click and scan, enter response to challenge
in the device, to authenticate. 

[3] To test location, click the [Location] challenge, enter email, IN/OUT and click
the map to register your current lat/long. If you want location to pass,
simply login select IN, scan and pass location proximity test. If you want it to fail,
drag the map to an alternate location or select OUT, login and fail due to proximity difference.

[4] To test behavior, click the [Behavior] tab and select 3 pattern vary from 1 to 9 for example ((1,1), (2, 2), (3,3)) and scan from  the device the screen will popup with the PAttern. 

[5] To test bio, click the [Bio] and Login by entering Email after scanning the device's security PIN/Pattern/Face Detection/Fingerprint will appear. 

[6] To test time, click the [Time] and Login by entering Email and enter the start date and end date with the hint Pattern and select IN or OUT, after scanning in case of IN if the time is in between the selected then will get PASS otherwise it will get FAIL, after scanning in case of OUT if the time is in between the selected then will get FAIL otherwise it will get PASS. 

Click login and touch and hold the desired locations AS YOU SCAN, until it beeps. 
To fail, tap wrong locations on the screen or release before you scan. 

In the demo you can only choose one factor per test, but in the full API SDK
you can add multiple challenges in combination as needed.

### App to App Mobile Authentication via App Only

Walk thorugh each factor and how to test/engage from mobile browser to
the mobile app, from app-to-app (no QR scan).

First, access the demos from a mobile browser on iOS on Android.

For the mobile demos, repeat the steps as above, except you will rollover
from mobile browser to app to authenticate after each "login" press/tap.

For behavior, you must hold the touch locations while and until the clock sweeps,
since there is no scan.

The rest of the demos function as they do in the desktop version.

## Using the SDK with your own stack/app/code

To use the SDK in your own code, You can copy `sdk/api.php` in your own stack. It is a class based
implementaton of all the api, which internally calls the liveensure API using `requests`.

This can be used as follows:

- Create LiveEnsure object (required)

```  
  # Make sure you have all these keys before you start using the APIs
  $obj = new LiveEnsureApi();
 ```

- Start session (required)

```      
  # email is the userid for which authentication is to be done

   $rs =  $obj->initSession($_REQUEST['email']);
```

  It will return JSON object which have the `sessionToken`, that will be used in all subsequent calls.
  

- Add factors (optional)



```          
Add knowledge challenge:

# question is the question to be asked after scanning the code
# answer is the answer to the question 
# session Token is the session key that is returned by initSession call.

liveAuthObj.addPromptChallenge('<question>', '<answer>', '<sessionToken>')
It will return json object with status of the API call.
```

 ```
Add location challenge:

# lat is lattitude of location
# lang is the langitude of the location
# inOut is the In between or Out of the location
# radius is the radius limit of location authentication

$rs =  $obj->addLocationChallenge($_REQUEST['lat'],$_REQUEST['long'],$_REQUEST['selectedRadius'],$_REQUEST['inOut'],$token);
 ```

          
```
 Add behaviour challenge:
    
    # touches the pattern to be drawn similar ((1,1), (2,2), (3,3))
    $rs =  $obj->addTouchV6Challenge($_REQUEST['touches'],$token);
```

```
 Add Bio challenge:
    
    # touches this will be true to enable this challenge
    $rs =  $obj->addBioChallenge($_REQUEST['touches'],$token);
```

```
 Add Time challenge:
    # startDate is date and time from what challenge to be enabled
    # inOut is the if IN between start date and end date and if OUT when time has been completed in between start and end date
    # endDate is date and time till what the challenge will be completed
   
    $rs =   $obj->addTimeChallenge($_REQUEST['startDate'],$_REQUEST['inOut'],$_REQUEST['endDate'],$token);
```


- Get the session token (required)
```
 $rs =  $obj->getAuthObj("IMG",$token);
```

This is the moment the user scans or taps on mobile to authenticate and performs their authentication factors as configured above. During this process you may poll for status in the background.

- Poll for session status (required)

```      
 $rs =  $obj->pollStatus($token);
```

- Delete user (optional)

```    
  # email: email of the user that is to be deleted
   $rs =  $obj->deleteUser(<email>);
```

## Built With

* PHP 5.5+
* Bootstrap
* Google Map APIs
* LiveEnsure Authentication APIs


## Versioning

Current Version: **0.01**

## Authors

* **Christian Hessler** - *Author* - [LiveEnsure](https://github.com/LiveEnsure)
* **Narender Poonia** - *Author* - [LiveEnsure](https://github.com/LiveEnsure)


## License

This project is proprietary software (c) 2016 LiveEnsure Inc. 
Visit http://www.liveensure.com for more information.

## Contact

* Web: http://www.liveensure.com 
* Dev: http://developer.liveensure.com
* Support: http://support.liveensure.com 


