<?php
namespace App\Classes;
use DB;
use Session;
use Carbon\Carbon;

class Booking {

	public function getData()
	{
		return 'abcdef';
	}

	public function Bangkok()
	{
		return DB::table('hotels')->select('city')->where('city','=','Bangkok')->count();

	}
	public function KualaLumpur()
	{
		return DB::table('hotels')->select('city')->where('city','=','Kuala Lumpur')->count();

	}
	public function Sihanoukville()
	{
		return DB::table('hotels')->select('city')->where('city','=','Sihanoukville')->count();

	}
	public function Pattaya()
	{
		return DB::table('hotels')->select('city')->where('city','=','Pattaya')->count();

	}

	public function DMStoDD($input)
	{
		$deg = " " ;
		$min = " " ;
		$sec = " " ;
		$inputM = " " ;
		for ($i=0; $i < strlen($input); $i++)
		{
			$tempD = $input[$i];
			if ($tempD == iconv("UTF-8", "ISO-8859-1//TRANSLIT", '°') )
			{
				$newI = $i + 1 ;
				$inputM =  substr($input, $newI, -1) ;
				break;
			}//close if degree

			$deg .= $tempD ;
		}//close for degree
		for ($j=0; $j < strlen($inputM); $j++)
		{
			$tempM = $inputM[$j];
			if ($tempM == "'")
			{
				$newI = $j + 1 ;
				//print "<br> newI is : $newI";
				$sec =  substr($inputM, $newI, -1) ;
				break;
			}//close if minute
			$min .= $tempM ;
		}//close for min
		$deg = round($deg);
		// dd($deg);
		$result =  $deg+( (( $min*60)+($sec) ) /3600 );
		// dd($result);
		// print_r($result); die;
		return $result;
	}

	public function getcities()
	{
		$cities = DB::table('cities')->get();
		return $cities;
	}
}

?>
