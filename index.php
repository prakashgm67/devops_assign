<?php

# This is the default index.php file, that is called initially
#  This requires login_lib.php - in the lib directory - where two functions are defined
#	-- index.php
#   -- lib
#		-- lib/login_lib.php
#	-- img
#		-- img/favicon.png
#		-- img/WILP.jpg
#		-- img/wilp_logo.png
#	-- css
#		-- css/bootstrp.min.css
#	-- arc : Original files from sample_application downloaded from AWS
#
	# Including the library file
	include_once("lib/login_lib.php");
	# Initializing some variables
	$as_error='';
	$as_msg='';
	
	# backend code - when user hit submit
	if(isset($_REQUEST['submit_button']) && $_REQUEST['submit_button']!=''){
		# Getting the user id
		if(isset($_REQUEST['username']) && trim($_REQUEST['username'])!=''){
			$as_uname=$_REQUEST['username'];
			# Getting the password
			if(isset($_REQUEST['password']) && $_REQUEST['password']!=''){
				$as_pass=$_REQUEST['password'];
				
				# Reading the file by opening it
				$as_file = fopen("cred.src","r");
				//Output lines until EOF is reached
				$as_suc=false;
				while(! feof($as_file)) {
					$as_line = fgets($as_file);
					# !~!~ is the seperator of id and pass in cred.src file					
					$as_line_ar=explode('!~!~',$as_line);
					# Checking if user name and pass is matching or not
					if(trim($as_uname) == trim($as_line_ar[0]) && trim($as_pass) == trim($as_line_ar[1])){
						$as_suc=true;
					}
				}
				if($as_suc){
					$as_msg='Congratulation, Login success!!';
				}else{
					$as_error='Invalid login credentials!!';
				}
				# Finally closing the file
				fclose($as_file);
			}else{
				$as_error='Passowrd can not be empty!!';
			}
		}else{
			$as_error='User id can not be empty!!';
		}
	}
	
	# Including header
	$as_str=as_header();
	# Container start from here
	$as_str.='
	<div class="container" style="margin-top:80px">';
		$as_str.='
		<div class="col-sm-1 col-md-1">';
		$as_str.='
		</div>';
		$as_str.='
		<div align="center" class="col-xs-12 col-sm-10 col-md-10">';
		$as_str.='
		</div>';
		$as_str.='
		<div class="col-sm-1 col-md-1">';
		$as_str.='
		</div>';
		$as_str.='
		<br><br><br>
		<div class="col-sm-2 col-md-2" style="width:20%;">';
		$as_str.='
		</div>';
		
		# Actual div that is showing (Login form)
		$as_str.='
		<div style="padding:5%" align="center" class="col-xs-12 col-sm-6 col-md-6">';
			if($as_msg!=''){
				$as_str.='
				<div style="color:white;background-color: grey;" class="panel-body">';
					$as_str.='
					<div class="alert alert-success" style="font-size:12px">'.$as_msg.'   <a href="index.php">Go back</a></div>';
					$as_str.='
					This concludes Cloud computing assignment - Web application deploymment on Azure App Service - PHP<br><hr>
					Submitted by: Prakash G M (2020HT66517)<br>
					Program: Conputer Science and Infrastructure
					Course: ';
				$as_str.='
				</div>';
			}else{	
				$as_str.='
				<div class="login-panel panel panel-default modal-content" style="border-radius: 7px;border:4px solid grey;">';
					# Header in login form
					$as_str.='
					<div style="background-color: black;" class="panel-heading">';
						$as_str.='
						<h3 class="panel-title"><font style="font-family:helvetica;" color="white"><b>Login Form</b></font>';
						$as_str.='
						</h3>';
					$as_str.='
					</div>';
					# Showing the message after click on submit button
					$as_str.='
					<div style="color:white;background-color: grey;" class="panel-body">';
						if( $as_error!=''){
							$as_str.='
							<div class="alert alert-danger" style="font-size:12px"><b>!</b> '.$as_error.'</div>';
						}
						# Login form - username / password
						$as_str.=as_logIn_form();	
					$as_str.='
					</div>';
				$as_str.='
				</div>';
			}
			$as_str.='
			<div class="col-sm-4 col-md-4">';
			$as_str.='
			</div>';
		$as_str.='
		</div>';
	$as_str.='
	</div>
</div>';
	$as_str.='
</div>';
$as_str.='
</body>';
$as_str.='
</html>';
$as_str.=as_footer('10%');
# Some CSS
$as_str.='
<style type="text/css">
@media screen and (max-width: 992px) {
  h2 {
    font-size: 22px;  
  }
}
@media screen and (max-width: 768px) {
  h2 {
    font-size: 16px;  
  }
}'
;
$as_str.='
</style>';
echo $as_str;
?>
