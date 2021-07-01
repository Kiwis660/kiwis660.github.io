<?php
require 'header.php';

$idServer = 0;

if(isset($_GET['id'])){
  $idServer = $_GET['id'];
}else{
  header("Location: index");
  exit();
}
if($idServer == 0){
  header("Location: index");
  exit();
}
?>

<main class="recaptchaMain">
  <div class="recaptchaDiv">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  				<form id="contact-form" method="post" action="recaptcha/check_code.php">

  					<div class="form-group row" >
  						<label class="col-sm-2 col-form-label">Captcha *</label>
  						<div class="col-sm-10">
  							<div class="form-row align-items-center">
  								<div class="col mb-3">
  									<input type="text" class="form-control" name="token" id="token" placeholder="Captcha" style="min-width: 150px;">
  								</div>

  								<div class="col mb-3">
  									<img src="recaptcha/image.php?12325" alt="CAPTCHA" id="image-captcha">
  									<a href="#" id="refresh-captcha" class="align-middle" title="refresh"><i class="material-icons align-middle">refresh</i></a>
  								</div>

  							</div>

  						</div>
  					</div>

  					<button type="submit" class="btn btn-primary" name="submit" id="submit" value="<?=$idServer?>">Submit</button>
  				</form>
  		</div>

  	</div>

  	<script type="text/javascript">
  		var refreshButton = document.getElementById("refresh-captcha");
  		var captchaImage = document.getElementById("image-captcha");

  		refreshButton.onclick = function(event) {
  			event.preventDefault();
  			captchaImage.src = 'recaptcha/image.php?' + Date.now();
  		}
  	</script>

  </div>

</main>
