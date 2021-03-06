<?php
//class.date.php

class Date
{
	private $errors;
	private $db;
	private $query;
	private $date;
	private $err_client;
	
	const NAME_SELECT_DATES = "dates";
	
	function __construct()
	{
		$this->errors=Array();
		$this->con = new dbManager;
		$this->con->getConnect();
	}
	
	public function saveDate($get)
	{
		$date_now = mktime($get['hour'], 0, 0, $get['month'], $get['day'], $get['year']);
		
		//$query="INSERT INTO `dates` (`id`, `chdate`, `idcostors`, `idclient`) VALUES ('', $date_now, $get['doctor'], $get['client'])";
		$result = $this->con->selectWhere($query);
			
		if($result->rowCount()>0) 
		{
			$y=0;
			foreach ($result as $row) 
			{
				$tab_date[$y]['id'] = $row['id'];
				$tab_date[$y]['data'] = $row['chdate'];
				$tab_date[$y]['iddoctor'] = $row['iddoctors'];
				
				$y+=1;
			}
			
			$html = "<div class='list_data'>";
				
					
			foreach($tab_date as $key=>$value) 
			{
				$html .= "<div class='data10'>{$value['id']}</div><div class='data60'>{$value['data']}</div><div class='data30'><form action='administrator.php' methd='POST'><input type='hidden' value='{$value['id']}' name=idcity'></input><input type='submit' value='Usuń' name='deletecity'></input</form></div>";
			}
			$html .="<div class='box_footer'></div>";
			
			return $html;
			
		}
			
		else  
		{		
			$this->err_client .= "Brak danych w bazie";
		}
		
	}
	
	public function generateDateForm($id_doctor)
	{
		$now = date("Y-m-d H:i:s");
		$nownumericdate = strtotime($now);
		$html = "<div id='box_dates'>";
		for($i=0; $i<7; $i++)
		{	$dateactual = strtotime("+$i day", $nownumericdate);
			$date_year = date("Y", $dateactual);
			$date_month = date("m", $dateactual);
			$date_day = date("d", $dateactual);
			
			$hours = $this->getDatesFromDate($dateactual,$id_doctor);

			$html .= "
				<div class='date_window'>
					<div class='box_day'>{$date_day}</div>
					<div class='box_month'>{$date_month}</div>
					<div class='box_year'>{$date_year}</div>
					$hours
				</div>
				
				";
		}
		$html .= "</div>";
		return $html;		
	}
	
	private function getDatesFromDate($date,$id_doctor)
	{
		$datefrom = date("Y-m-d 8:0:0", $date);
		$dateto = date("Y-m-d 16:59:59", $date);
		
		$query="SELECT * FROM `dates` WHERE `iddoctors` = '$id_doctor' AND `chdate` > '$datefrom' AND `chdate` < '$dateto'";
		$result = $this->con->selectWhere($query);
			
		
			$y=0;
			$check_array = array(8,9,10,11,12,13,14,15,16);
			
			foreach ($result as $row) 
			{
				$tab_date[$y] = $row['chdate'];
				$dateH = date("H", strtotime($tab_date[$y]));
				//echo $dateH;
				$index_delete = array_search("$dateH",  $check_array); // $klucz = 2;
				unset($check_array[$index_delete]);
				$y+=1;
				
			}	
			$html = "<div class='box_hours'>";
			for($i=8; $i<17; $i++)
			{
				if(in_array($i, $check_array))
				{
					$html .= "<div class='houractive'>{$i}</div>";
				}
				else
				{
					$html .= "<div class='hourinactive'>{$i}</div>";
				}
				
			}
			$html .= "</div>";
			return $html;
			
		
		
	}
	
	public function getDatesList()
	{
		$datefrom = date("Y-m-d H:i:s");
		$dateto = strtotime($datefrom);
		$dateto = strtotime("+7 day", $dateto);
		$dateto = date('Y-m-d H:i:s', $dateto);
		
		
		$query="SELECT * FROM `dates` WHERE `chdate` > '$datefrom' AND `chdate` < '$dateto'";
		$result = $this->con->selectWhere($query);
			
		if($result->rowCount()>0) 
		{
			$y=0;
			foreach ($result as $row) 
			{
				$tab_date[$y]['id'] = $row['id'];
				$tab_date[$y]['data'] = $row['chdate'];
				$tab_date[$y]['iddoctor'] = $row['iddoctors'];
				
				$y+=1;
			}
			
			$html = "<div class='list_data'>";
				
					
			foreach($tab_date as $key=>$value) 
			{
				$html .= "<div class='data10'>{$value['id']}</div><div class='data60'>{$value['data']}</div><div class='data30'><form action='administrator.php' methd='POST'><input type='hidden' value='{$value['id']}' name=idcity'></input><input type='submit' value='Usuń' name='deletecity'></input</form></div>";
			}
			$html .="<div class='box_footer'></div>";
			
			return $html;
			
		}
			
		else  
		{		
			$this->err_client .= "Brak danych w bazie";
		}
		
	}
	
	public function getDatesListSelect()
	{
		$datefrom = date("Y-m-d H:i:s");
		$dateto = strtotime($datefrom);
		$dateto = strtotime("+7 day", $dateto);
		$dateto = date('Y-m-d H:i:s', $dateto);
		
		
		$query="SELECT * FROM `dates` WHERE `chdate` > '$datefrom' AND `chdate` < '$dateto'";
		$result = $this->con->selectWhere($query);
			
		if($result->rowCount()>0) 
		{
			$y=0;
			foreach ($result as $row) 
			{
				$tab_date[$y]['id'] = $row['id'];
				$tab_date[$y]['data'] = $row['chdate'];
				$tab_date[$y]['iddoctor'] = $row['iddoctors'];
				
				$y+=1;
			}
			
			$html = "<div class='list_data'>";
				
					
			foreach($tab_date as $key=>$value) 
			{
				$html .= "<div class='data10'>{$value['id']}</div><div class='data60'>{$value['data']}</div><div class='data30'><form action='administrator.php' methd='POST'><input type='hidden' value='{$value['id']}' name=idcity'></input><input type='submit' value='Usuń' name='deletecity'></input</form></div>";
			}
			$html .="<div class='box_footer'></div>";
			
			return $html;
			
		}
			
		else  
		{		echo "brak";
			$this->err_client .= "Brak danych w bazie";
		}
		
	}
	
	public function addDates($date_tab)
	{
		
		
		foreach($date_tab as $key=>$value)
		{
			$value=Functions::correctValue($value);
			$date_tab[$key]=$value;
		}
		$date = date("$date_tab[year]-$date_tab[month]-$date_tab[day], $date_tab[hour]:0:0");   
		
		$query="INSERT INTO `dates` (`ID`, `CHDATE`, `IDDOCTORS`, `IDCLIENT`) VALUES ('', '$date', '$date_tab[doctor]', '$date_tab[client]')";
		$result = $this->con->selectWhere($query);
		
		if($result->rowCount()>0) 
		{
			
			
			header("Location: rejestracja.php?id=6");
			
		}
			
		else  
		{		
			$this->err_client .= "Nie można dodać rekordu";
		}
		
		
	}
	
	public function removeDates($id)
	{}
	
	public function changeDates($id,$date)
	{}
	
	public function getDates($id)
	{}
	
	function __destruct()
	{
		$this->con->closeConnection();
	}	
	
	
}

?>