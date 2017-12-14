﻿<?php
include('settings/settings.php');
include("class/class.functions.php");
include("class/class.dbmanager.php");
include("class/class.city.php");
include("class/class.clinic.php");
include("class/class.date.php");
include("class/class.doctor.php");

if(isset($_POST['addcity']))
{
		$city = new City;
		$city->addCity($_POST['addcityname']);
}	

?>
<!DOCTYPE html>
<html>
   <head>
   
	<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,800|Open+Sans:300,400,700" rel="stylesheet"> 
	<link rel="Stylesheet" type="text/css" href="css/style.css" />
   
   </head>
  <body style="background: none">
		<div id="box_page">
			<div id="logo">
				D&A
			</div>
			<div id="content">
				<div class="incontent">
					<h2>Panel administracyjny</h2>
					<?php 
					if($_SESSION['communicate']['status'])
					{
						echo $_SESSION['communicate']['text'];
					}
					?>
			
					<div class="row33">
						<div class="row100"><div class="inrow">
							<h3>Lista miast</h3>
							<div class="list">
								<form action="administrator.php" method="POST">
									<input type="text" name="addcityname"></input>
									<input type="submit" name="addcity" value="Dodaj miasto"></input>
								</form>
								<?php
								$city = new City;
								echo($city_list = $city->getCitiesListSelect(false));
								?>
							</div>
						</div></div>
						
						<div class="row100"><div class="inrow">
							<h3>Lista klinik</h3>
							<div class="list">
								<form action="administrator.php" method="GET">
									<input type="submit" name="addclinic" value="Dodaj klinikę"></input>
								</form>
								kliniki
							</div>
						</div></div>
						
						<div class="row100"><div class="inrow">
							<h3>Lista lekarzy</h3>
							<div class="list">
								<form action="administrator.php" method="GET">
									<input type="submit" name="adddoctor" value="Dodaj lekarza"></input>
								</form>
								kliniki
							</div>
						</div></div>
					</div>
					<div class="row66"><div class="inrow">
						<h3>Lista rejestracji</h3>
						<div class="list">
							<form action="administrator.php" method="GET">
								<input type="submit" name="adddate" value="Dodaj rejestrację"></input>
							</form>
							rejestracje
						</div>
					</div></div>
				
				</div>
			</div>	
			
		
			
		</div>
   </body>
</html>
