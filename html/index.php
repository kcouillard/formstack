<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FamPad Interest</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/custom.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <img src="img/logo.jpg"/>
      </div>
      <div class="jumbotron">
        <h2>Interested?</h2>
        <p class="lead">
        <h3>Want to make major income by renting out your family-friendly home to other families?</h3>We will mail you our info brochure for free and add you to our mailing list to keep you informed of our new platform progress!</p>
        <div class="row">
					<div class="col-md-5">
						<form action="index.php" method="POST">
							<div class="form-group">
								<label>First Name</label> <span class="required">required</span>
								<input type="text" id="first_name" name="first_name" size="20" value="<?php echo $_POST['first_name'];?>" required class="form-control" aria-required="true" />
							</div>
							<div class="form-group">
								<label>Last Name</label> <span class="required">required</span>
								<input type="textl" id="last_name" name="last_name" size="20" value="<?php echo $_POST['last_name'];?>" required class="form-control" aria-required="true" />
							</div>
							<div class="form-group">
								<label>Address Line 1</label> <span class="required">required</span>
								<input type="text" id="address1" name="address1" size="50" required value="<?php echo $_POST['address1'];?>" class="form-control" aria-required="true" />
							</div>
							<div class="form-group">
								<label>Address Line 2</label>
								<input type="text" id="address2" name="address2" size="50" value="<?php echo $_POST['address2'];?>" style="margin-top:5px;" class="form-control" />
							</div>
							<div class="form-group">
								<label>City</label> <span class="required">required</span>
								<input type="text" id="city" name="city" size="15" value="<?php echo $_POST['city'];?>" required class="form-control" aria-required="true" />
							</div>
							<div class="form-group">
								<label>State</label> <span class="required">required</span>
								<?php
								$states = statesList();
								echo '<select id="state" name="state" required class="form-control" value="<?php echo $_POST["state"];?>" aria-required="true">';
								echo '<option selected="selected">Select your state...</option>';
								foreach($states as $key=>$value) {
								  if($_POST['state'] == $key) {
								    echo '<option value="'.$key.'" selected>'.$value.'</option>';
								  } else {
									  echo '<option value="'.$key.'">'.$value.'</option>';
								  }
								}
								echo '</select>';
								?>
							</div>
							
							<div class="form-group">
								<label>Zip</label> <span class="required">required</span>
								<input type="text" id="zip" name="zip" size="6" value="<?php echo $_POST['zip'];?>" required class="form-control" aria-required="true" />
							</div>

							<div class="form-group">
								<label>Tell Us About Your Property</label>
								<textarea id="about" name="about" rows="10" cols="50" class="form-control"><?php echo $_POST['about'];?></textarea>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary pull-right">I am interested</button>
							</div>

						</form>
					</div>

					<div class="col-md-7">

						<h3>DOTS Address Verification</h3>
						<?php
						if(!empty($_POST)) {
							require_once('api/Address.php');
							$aclient = new Address('WS72-SHR1-FOT4');
							$res2 = $aclient->checkAddress($_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['state'], $_POST['zip']);
							$_POST['correctedAddress'] = $res2['address1'] . " " . $res2['address2'] . " " . $res2['city'] . " " . $res2['state']. " " . $res2['zip'];
							echo "<h4>Updated Address</h4>";
							echo "<pre>";
							print_r($res2);
							echo "</pre>";
						}
						?>

						<h3>Formstack Result</h3>
						<?php
						if(!empty($_POST)) {
						  if(isset($res2) && count($res2) > 0) {
								require_once('api/Formstack.php');
								$fclient = new Formstack('39f0c0761711721bbfaf0378411ce064');
								$form = $fclient->getFormDetails('2155033');
								//formstack name, address, about property, and corrected hidden address
								$fieldIds = array('36684981', '36684982', '36684986', '36686859');
								$name =  $_POST['first_name'] . " " . $_POST['last_name'];
								$address = $_POST['address1'] . " " . $_POST['address2'] . " " . $_POST['city'] . " " . $_POST['state']. " " . $_POST['zip'];
								$fieldValues = array($name, $address, $_POST['about'], $_POST['correctedAddress']);
								$res = $fclient->submitForm('2155033', $fieldIds, $fieldValues, date("Y-m-d H:i:s"), $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], '0', false);
								echo "<pre>";
								print_r($res);
								echo "</pre>";
							} else {
								echo "<h4>We don't recognize that address at all and we can't even find a replacement</h4>Not submitting formstack form.";
							}
						}
						?>
					</div>
        </div>
      </div>
      <footer class="footer">
        <p>&copy; 2015 FamPad </p>
      </footer>
    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php
function statesList() {
	$states = array('AL'=>"Alabama",
					'AK'=>"Alaska",
					'AZ'=>"Arizona",
					'AR'=>"Arkansas",
					'CA'=>"California",
					'CO'=>"Colorado",
					'CT'=>"Connecticut",
					'DE'=>"Delaware",
					'DC'=>"District Of Columbia",
					'FL'=>"Florida",
					'GA'=>"Georgia",
					'HI'=>"Hawaii",
					'ID'=>"Idaho",
					'IL'=>"Illinois",
					'IN'=>"Indiana",
					'IA'=>"Iowa",
					'KS'=>"Kansas",
					'KY'=>"Kentucky",
					'LA'=>"Louisiana",
					'ME'=>"Maine",
					'MD'=>"Maryland",
					'MA'=>"Massachusetts",
					'MI'=>"Michigan",
					'MN'=>"Minnesota",
					'MS'=>"Mississippi",
					'MO'=>"Missouri",
					'MT'=>"Montana",
					'NE'=>"Nebraska",
					'NV'=>"Nevada",
					'NH'=>"New Hampshire",
					'NJ'=>"New Jersey",
					'NM'=>"New Mexico",
					'NY'=>"New York",
					'NC'=>"North Carolina",
					'ND'=>"North Dakota",
					'OH'=>"Ohio",
					'OK'=>"Oklahoma",
					'OR'=>"Oregon",
					'PA'=>"Pennsylvania",
					'RI'=>"Rhode Island",
					'SC'=>"South Carolina",
					'SD'=>"South Dakota",
					'TN'=>"Tennessee",
					'TX'=>"Texas",
					'UT'=>"Utah",
					'VT'=>"Vermont",
					'VA'=>"Virginia",
					'WA'=>"Washington",
					'WV'=>"West Virginia",
					'WI'=>"Wisconsin",
					'WY'=>"Wyoming");
	return $states;
}
?>