<?php
if(isset($_GET['clinic']))
{
	$doctor = new Doctor;
	$doctors_list = $doctor->getDoctorsListSelect($_GET['clinic']);
}
else
{
	$doctors_list = "Blędny parametr GET";
}
?>

<div id="box_navigation">
	<ul>
		<li>Miasto</li>
		<li>Klinika</li>
		<li class="liactive">Lekarz</li>
		<li>Data</li>
		<li>Dane osobowe</li>
	</ul>
</div>
<div id="box_form">
	<form method="GET" action="rejestracja.php">
		<?php echo $doctors_list; ?>
		<input type="hidden" name="id" value="4"></input>	
		<input class="i_allforms" type="submit" value="Dalej" name="send"></input>
	</form>			
</div>