<?php include('apiform.php');?>
<?php include('layout/header.php');?>
<style>
		table td:hover {
			background-color: #81B6D5;
			color: #fff;
			cursor: pointer;
		}
		table td.clicked {
			background-color: #2B6282;
			color: #fff;
			cursor: pointer;
		}
	</style>
<body>
    <header class="text-center">
        <h1 class="heading"> LiveEnsure<sup>&reg;</sup> SDK</h1>
        <!-- <p class="sub-heading"> Real-time authentication solution demo with your mobile device. </p> -->
    </header>

    <div id="content">
        
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <ul class="nav navbar-nav">
	      <li><a href="device.php">Device</a></li>
	      <li><a href="knowledge.php">Knowledge</a></li>
	      <li><a href="location.php">Location</a></li>
	      <li  class="active"><a href="behaviour.php">Behaviour</a></li>
	    </ul>
	  </div>
	</nav>
	<div class = "col-sm-3" >
	<form id="email-form">
	  <div class="form-group form-group-modified">
	  <div class="row">
	  	<div class="col-sm-12">
	    <label for="email">1. Enter your Email and Challenge</label>
	    <div class = "add-input">
	    	<span class = "add-on"><i class="fa fa-envelope"></i></span>
	    	<input type="email" class="form-control form-control-changes" name="email" id="email">
	    </div>
	  </div>
	  </div>
	  </div>
	  </form>
	  <form id="behaviour-form">
		<div class="form-group form-group-modified">
			<div class="row">
				<div class="col-sm-12">
					<label for="orientation1">2. Select orientation</label>
				    	<select class="form-control" name="orientation" id="orientation1">
				    		<option value=0>Portrait</option>
				    		<option value=1>Upside down</option>
				    		<option value=2>Landscape Left</option>
				    		<option value=3>Landscape Right</option>
				    	</select>
				</div>
				
				<input type="hidden" name="touches" id="touches"/>
				<input type="hidden" name="sessionToken" id="b-sessionToken"/>

				<div class="col-sm-12">
					<label for="" style="margin-top: 10px">3. Touch points</label>
					<div class="row">
					<div class="col-sm-12" id="portrait">
						<table class="table table-bordered">
							<tr><td>1</td><td>2</td></tr>
							<tr><td>3</td><td>4</td></tr>
							<tr><td>5</td><td>6</td></tr>
							
						</table>
					</div>
					<div class="col-sm-5" id="landscape">
						<table class="table table-bordered">
							<tr><td>1</td><td>2</td><td>3</td></tr>
							<tr><td>4</td><td>5</td><td>6</td></tr>
						</table>
					</div>
					</div>
				</div>
			</div>
			<div class="row">
			  	<div class="col-sm-12">
			  	<button id="submit" class="btn btn-default pull-right btn-modified marginTop-20">Login</button>
			  	</div>
			  </div>
		</div>
	</form>
        </div>
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
		var touches = [];
		$(document).ready(function() {

			$("#submit").click(function(e) {
				e.preventDefault();
				makeInitSessionCall().then(addBehaviourChallenge).then(getQRCode).then(poll);
			});
			$("table td").click(function() {
				if($(this).hasClass('clicked')) {
					touches.splice(touches.indexOf($(this).text()),1);
					$(this).removeClass("clicked");
				}else {
					$(this).addClass("clicked");
					touches.push($(this).text());
				}
				console.log(touches);
			});
			$("#landscape").hide();
			$("#orientation1").change(function() {
				var val = $(this).val();
				if(val <= 1) {
					$("#portrait").show();
					$("#landscape").hide();
				} else {
					$("#portrait").hide();
					$("#landscape").show();
				}
			})
		});
	</script>
<?php include('layout/footer.php');?>