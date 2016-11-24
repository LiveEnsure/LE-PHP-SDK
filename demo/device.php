<?php include('layout/header.php');?>
<body>
    <header class="text-center">
        <h1 class="heading"> LiveEnsure<sup>&reg;</sup> SDK</h1>
    </header>

    <div id="content">
        
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <ul class="nav navbar-nav">
	      <li  class="active"><a href="device.php">Device</a></li>
	      <li><a href="knowledge.php">Knowledge</a></li>
	      <li><a href="location.php">Location</a></li>
	      <li><a href="behaviour.php">Behaviour</a></li>
	    </ul>
	  </div>
	</nav>
	
	<form class="col-sm-3" id="email-form">

	  <div class="form-group form-group-modified">
	  <div class="row">
	  	<div class="col-sm-12">
	    <label for="email">1. Enter your Email</label>
	    <div class = "add-input">
	    	<span class = "add-on"><i class="fa fa-envelope"></i></span>
	    	<input type="email" class="form-control form-control-changes" name="email" id="email">
	    </div>
	  </div>
	  </div>
	  <div class="row">
	  	<div class="col-sm-12">
	  	<button id="submit" class="btn btn-default pull-right btn-modified marginTop-20 marginRight-5">Login</button>
	  	</div>
	  	</div>
	  </div>
	  </div>
	</form>

    <div class = "col-sm-3 marginLeft-xs-15">
        <p> <strong> 2. Scan and Authenticate </strong> </p>
        <img id="qr-img" src = "">
        <img style="margin-left: 20px" id="result-img" src = "" class = "marginTop-40">
    </div>
    <form class = "col-sm-6">
      <div class="form-group form-group-modified">
      <div class="row">
        <div class="col-sm-12">
            <h2> Debug Console </h2>
        </div>
      </div>    
      <div class="row row-margin">
        <div class="col-sm-12"> 
            <label class ="label-modify" for="url">Host URL:</label>
            <input value="https://app.liveensure.com/live-identity" readonly class="form-control form-control-width-change" type="text">
        </div>
      </div>
       <div class="row row-margin">
        <div class="col-sm-12">
        <label class ="label-modify" for="request">Request:</label>
        <textarea id="request-box" class="form-control form-control-width-change" rows="5"></textarea>
        </div>
      </div>
      <div class="row row-margin">
        <div class="col-sm-12">
            <label class ="label-modify" for="polling">Polling Status:</label>
            <input id="polling-status-ip" class="form-control form-control-width-change" type="text">
        </div>
      </div>
      <div class="row row-margin">
        <div class="col-sm-12">
        <label class ="label-modify" for="response">Response:</label>
        <textarea id="response-box" class="form-control form-control-width-change" rows="5"></textarea>
        </div>
      </div>
      </div>
    </form>
    </div>
    <div class="row marginLeft-Right-0">
        <script>
		$(document).ready(function() {
			$("#submit").click(function(e) {
				e.preventDefault();
				makeInitSessionCall().then(getQRCode).then(poll);
			});
		});
	</script>
<?php include('layout/footer.php');?>   