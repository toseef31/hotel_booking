<?php
namespace App\Classes;
use DB;
use Session;
use Carbon;

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
		// dd($input);
		$input = str_replace("'' ", '"', $input);

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
	public function getcountries()
	{
		$countries = DB::table('countries')->get();
		return $countries;
	}
	public function getRoomType()
	{
		$rooms = DB::table('rooms_type')->get();
		return $rooms;
	}
	public function getPriceWithoutChild($room_id,$from_date,$to_date,$adult,$child)
	{
		$room_info = DB::table('rooms')->where('rid',$room_id)->first();
		$quote = DB::table('hotel_quotations')->where('rid',$room_id)->where('to_date','>=',Carbon\Carbon::now())->first();
		// dd($quote);
		$single=$quote->single;
    $double=$quote->double_twin;
    $extra_bf_child=$quote->abf_ch;
    // $extra_bed_ad=$quote->extra_bed_ad;
    // $extra_bed_ch=$quote->extra_bed_ch;
		$datediff = strtotime($to_date) - strtotime($from_date);
    $days = round($datediff / (60 * 60 * 24));
		if ($days == 0) {
			$days=1;
		}
		if ($child > 0) {
    $result = $days*$double+$extra_bf_child;
		// dd($double);
	}else {
		$result = $days*$double;
	}
		// dd($adult);
		return $result;
	}
	public function getPriceWithChild($room_id,$from_date,$to_date,$adult,$child)
	{
		$room_info = DB::table('rooms')->where('rid',$room_id)->first();
		$quote = DB::table('hotel_quotations')->where('rid',$room_id)->where('to_date','>=',Carbon\Carbon::now())->first();
		// dd($quote);
		$single=$quote->single;
    $double=$quote->double_twin;
    $extra_bf_child=$quote->abf_ch;
    // $extra_bed_ad=$quote->extra_bed_ad;
    $extra_bed_ch=$quote->extra_bed_ch;
		$datediff = strtotime($to_date) - strtotime($from_date);
    $days = round($datediff / (60 * 60 * 24));
		if ($days == 0) {
			$days=1;
		}
    $result = $days*$double+$extra_bf_child+$extra_bed_ch;
		// dd($adult);
		return $result;
	}
	public function HotelDetail($hid)
	{
		$hotel=DB::table('hotels')->where('hid',$hid)->first();
		// dd($hotel);
		return $hotel;
	}

	public function getRoomsCalculation($hid,$from_date,$to_date,$adult,$child,$age)
	{
		$datediff = strtotime($to_date) - strtotime($from_date);
    $days = round($datediff / (60 * 60 * 24));
		// dd($child);
		$room_info = DB::table('rooms')->where('hid',$hid)->limit(2)->get();
		foreach ($room_info as $key => &$rec) {
			$rec->quote = DB::table('hotel_quotations')->where('rid',$rec->rid)->where('to_date','>=',Carbon\Carbon::now())->first();
			// $rec->days = (int)$days;
			$rec->days = (int)$days;
			$rec->extra_price_ad='';
			$rec->childprice='';
			$rec->totalprice='';
			$rec->room='';
			if ($rec->quote !="") {
			$single = $rec->quote->single*$days*$adult;
			$double = $rec->quote->double_twin*$days*$adult;
			if ($adult == 1 ) {
				$rec->price = $single;
			}else {
				$rec->price =$double;
			}

			if ($adult == 1 && $child == 0) {
				$rec->totalprice = $single;
			}elseif ($adult == 1 && $child == 1) {
				$rec->totalprice =$double;
			}elseif ($adult == 1 && $child == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days*$child;
				$rec->childprice = $extra_bed_ch;
				$rec->totalprice =$double+$extra_bed_ch;
			}elseif ($adult == 1 && $child == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$single;
				$rec->room =2;
			}elseif ($adult == 1 && $child == 3) {
				$rec->totalprice =$double+$double;
				$rec->room =2;
			}elseif ($adult == 2 && $child == 0) {
				$rec->totalprice = $double;
			}elseif ($adult == 2 && $child == 1 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days*$child;
				$rec->childprice = $extra_bed_ch;
				$rec->totalprice =$double+$extra_bed_ch;
			}elseif ($adult == 2 && $child == 1 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$single;
				$rec->room =2;
			}elseif ($adult == 2 && $child == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days*$child;
				$rec->childprice = $extra_bed_ch;
				$rec->totalprice =$double+$extra_bed_ch;
			}elseif ($adult == 2 && $child == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$single;
				$rec->room =2;
			}elseif ($adult == 2 && $child == 3) {
				$rec->totalprice =$double+$single;
				$rec->room =2;
			}elseif ($adult == 3 && $child == 0 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$rec->totalprice =$double+$extra_bed_ad;
			}elseif ($adult == 3 && $child == 0 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$single;
				$rec->room =2;
			}
			// if ($child > 0) {
			// 	$extra_bed_ch = $rec->quote->extra_bed_ch*$days*$child;
			// 	$rec->childprice = $extra_bed_ch;
			// 	$rec->totalprice =$double+$extra_bed_ch;
			// }else {
			// 	$rec->totalprice =$double;
			// }
			// if ($adult == 3 && $rec->extra_bed == 1) {
			// 	$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
			// 	$rec->extra_price_ad = $extra_bed_ad;
			// 	$rec->totalprice_3 =$double+$extra_bed_ad;
			// }else {
			// 	$rec->totalprice_3 = $double+$single;
			// 	$rec->room = 2;
			// }
		}

		}
		// dd($room_info);
		return $room_info;
	}

	public function getGalaDinner($hid,$from_date,$to_date)
	{
		$dinner = DB::table('gala_dinner_quotations')->where('hid',$hid)->whereBetween('date',[$from_date,$to_date])->first();
		// dd($dinner);
		return $dinner;
	}


	// public function getRoomsCalculation($hid,$from_date,$to_date,$adult,$child,$age)
	// {
	// 	$datediff = strtotime($to_date) - strtotime($from_date);
	// 	$days = round($datediff / (60 * 60 * 24));
	// 	// dd($child);
	// 	$room_info = DB::table('rooms')->where('hid',$hid)->limit(2)->get();
	// 	foreach ($room_info as $key => &$rec) {
	// 		$rec->quote = DB::table('hotel_quotations')->where('rid',$rec->rid)->where('to_date','>=',Carbon\Carbon::now())->first();
	// 		$rec->days = (int)$days;
	// 		$rec->extra_price_ad='';
	// 		if ($rec->quote !="") {
	// 		$single = $rec->quote->single*$days*$adult;
	// 		$double = $rec->quote->double_twin*$days*$adult;
	// 		$rec->price = $double;
	// 		if ($adult == 1 && $child == 1 && $rec->extra_bed == 1) {
	// 			// code...
	// 		}
	// 		if ($child > 0) {
	// 			$extra_bed_ch = $rec->quote->extra_bed_ch*$days*$child;
	// 			$rec->childprice = $extra_bed_ch;
	// 			$rec->totalprice =$double+$extra_bed_ch;
	// 		}else {
	// 			$rec->totalprice =$double;
	// 		}
	// 		if ($adult == 3 && $rec->extra_bed == 1) {
	// 			$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
	// 			$rec->extra_price_ad = $extra_bed_ad;
	// 			$rec->totalprice_3 =$double+$extra_bed_ad;
	// 		}else {
	// 			$rec->totalprice_3 = $double+$single;
	// 			$rec->room = 2;
	// 		}
	// 	}
	//
	// 	}
	// 	// dd($room_info);
	// 	return $room_info;
	// }
}

?>
