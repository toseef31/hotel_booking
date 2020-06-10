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

	public function makecalculation($data)
	{
		dd($data);
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

	public function possibilities($rid,$adult,$child,$days)
	{
		$room = DB::table('rooms')->where('rid',$rid)->first();
		$quote = DB::table('hotel_quotations')->where('rid',$rid)->first();
		// dd($quote);
		if ($quote !="") {
			if ($quote) {
				// code...
			}
			$single = $quote->single;
			$double = $quote->double_twin;

			if ($adult == 1 ) {
				$bed_price = $single;
			}else {
				$bed_price =$double;
			}

			$extra_bed_ad = $quote->extra_bed_ad;
			$extra_bed_ch = $quote->extra_bed_ch;
			$abf_ch = $quote->abf_ch;
			// dd($abf_ch);

			// dd($abf_ch);

			// dd($extra_bed_ad);
			$permitted_occupants =$room->permitted_occupants;
			if ($permitted_occupants !=null) {
				$extra_bed =$room->extra_bed;
				$total =$adult+$child;
				$all = $total/$permitted_occupants;
				$adult2 = $adult/$permitted_occupants;
				$child2 = $child/$permitted_occupants;
				// dd($all);
				$cal1 = $this->calculation1($all,$adult,$child,$permitted_occupants,$extra_bed,$bed_price,$extra_bed_ad,$extra_bed_ch,$abf_ch,$days);
				$cal2 = $this->calculation2($adult2,$child2,$adult,$child,$permitted_occupants,$extra_bed,$bed_price,$extra_bed_ad,$extra_bed_ch,$abf_ch,$days);
				$main_obj = array(
					"cal1" => $cal1,
					"cal2"=> $cal2
				);
				return $main_obj;
			}else {
				return "No Data";
			}

		}else {
			return "No Data";
		}

	}

	public function calculation1($all,$adult,$child,$permitted_occupants,$extra_bed,$bed_price,$extra_bed_ad,$extra_bed_ch,$abf_ch,$days)
	{
		// dd($all,$permitted_occupants,$extra_bed,$bed_price,$extra_bed_ch,$abf_ch,$days);
		// dd($all,$permitted_occupants,$child);
		$bed_price_total = $bed_price*$days;
		$extra_bed_ad_total=$extra_bed_ad*$days;
		$extra_bed_ch_total=$extra_bed_ch*$days;
		$abf_ch_total=$abf_ch*$days;
		if ($all == 0.5) {
			// 1 Adult
			$message = "1 Room";
			$total = $bed_price_total;
			$obj = [
				"message" => $message,
				"bed_price"=> $bed_price,
				"days"=> $days,
				"abf_ch"=>'',
				"extra_bed_ch"=> '',
				"total"=> $total
			];
			return $obj;
		}elseif ($all == 1 && $permitted_occupants == 2) {
			$message = "1 Room";
			$obj = array(
				"message" => $message,
			);
			return $obj;
		}elseif ($all == 1.5 && $permitted_occupants == 2 && $extra_bed == 0 ) {
			// 2 Adult 1 Child
			if ($abf_ch != null) {
				$message = "1 Room + 1 ABF for Child";
				$total = $bed_price_total+$abf_ch_total;
				$abf_ch= $abf_ch;
			}else {
				$message = "2 Rooms";
				$total = $bed_price_total*2;
				$abf_ch='';
			}
			$obj = [
				"message" => $message,
				"bed_price"=> $bed_price*2,
				"days"=> $days,
				"abf_ch"=>$abf_ch,
				"extra_bed_ch"=> '',
				"total"=> $total
			];
			return $obj;
		}elseif ($all == 1.5 && $permitted_occupants == 2 && $extra_bed == 1 && $child !='0') {
			// 2 Adult 1 Child with Extrabed
			$message = "1 Room + 1 Extrabed for Child";
			$total = $bed_price_total+$extra_bed_ch_total;
			$obj = array(
				"message" => $message,
				"bed_price"=> $bed_price,
				"abf_ch"=>'',
				"extra_bed_ch"=> $extra_bed_ch,
				"days"=> $days,
				"total"=> $total
			);
			return $obj;
		}elseif ($all == 2 && $permitted_occupants == 2) {
			// 2 Adult 2 Child
			$message = "2 Rooms";
			$total = $bed_price_total*2;
			$obj = array(
				"message" => $message,
				"bed_price"=> $bed_price*2,
				"abf_ch"=>'',
				"extra_bed_ch"=> '',
				"days"=> $days,
				"total"=> $total
			);
			return $obj;
		}elseif ($all == 2.5 && $permitted_occupants == 2 && $extra_bed == 0) {
			// 2 Adult 3 Child
			if ($abf_ch != null) {
				$message = nl2br("1 Rooms + 1 ABF for Child \n1 Room");
				$total = $bed_price_total*2+$abf_ch_total;
				$abf_ch= $abf_ch;
			}else {
				$message = "3 Rooms";
				$total = $bed_price_total*3;
				$abf_ch='';
			}
			$obj = array(
				"message" => $message,
				"bed_price"=> $bed_price*3,
				"abf_ch"=>$abf_ch,
				"extra_bed_ch"=> '',
				"days"=> $days,
				"total"=> $total
			);
			return $obj;
		}elseif ($all == 2.5 && $permitted_occupants == 2 && $extra_bed == 1) {
			// 2 Adult 3 Child with Extrabed

			$message = nl2br("1 Rooms + 1 Extrabed.\n1 Room");
			$total = $bed_price_total*2+$extra_bed_ch_total;
			$obj = array(
				"message" => $message,
				"bed_price"=> $bed_price*2,
				"abf_ch"=>'',
				"extra_bed_ch"=> $extra_bed_ch,
				"days"=> $days,
				"total"=> $total
			);
			return $obj;
		}elseif ($all == 1.5 && $permitted_occupants == 2  && $child == 0) {
			// dd($all);
			// 3 Adult 0
			$message = "2 Rooms";
			$total = $bed_price_total*2;
			$obj = array(
				"message" => $message,
				"bed_price"=> $bed_price*2,
				"abf_ch"=>'',
				"extra_bed_ch"=> '',
				"days"=> $days,
				"total"=> $total
			);
			return $obj;
		}
		else {
			$obj = array(
				"message" => '',
				"bed_price"=> '',
				"abf_ch"=>'',
				"extra_bed_ch"=> '',
				"days"=> '',
				"total"=> ''
			);
		}
	}

	public function calculation2($adult2,$child2,$adult,$child,$permitted_occupants,$extra_bed,$bed_price,$extra_bed_ad,$extra_bed_ch,$abf_ch,$days)
	{
		// dd($adult2,$permitted_occupants,$child2,$abf_ch);
		// dd($adult2,$child2,$permitted_occupants,$extra_bed,$bed_price,$extra_bed_ch,$abf_ch,$days);
		$bed_price_total = $bed_price*$days;
		$extra_bed_ad_total=$extra_bed_ad*$days;
		$extra_bed_ch_total=$extra_bed_ch*$days;
		$abf_ch_total=$abf_ch*$days;
		if ($adult2 == 0.5) {
			// 1 Adult
			$obj = [
				"message" => '',
				"bed_price"=> '',
				"days"=> '',
				"abf_ch"=>'',
				"extra_bed_ch"=> '',
				"total"=> ''
			];
			return $obj;
		}elseif ($adult2 == 0.5 && $permitted_occupants == 2 && $child2== 1 && $abf_ch != null) {
			// 1 Adult 2 Child
			$message = "1 Room + 1 ABF for Child";
			$total = $bed_price_total+$abf_ch_total;
			$abf_ch= $abf_ch;
			$obj = array(
				"message" => $message,
				"bed_price"=> $bed_price,
				"abf_ch"=>$abf_ch,
				"extra_bed_ch"=> '',
				"days"=> $days,
				"total"=> $total
			);
		return $obj;
			$obj = array(
				"message" => '',
				"bed_price"=> '',
				"abf_ch"=>'',
				"extra_bed_ch"=> '',
				"days"=> '',
				"total"=> ''
			);
			return $obj;
		}elseif ($adult2 == 1 && $permitted_occupants == 2 && $child2==0.5 && $abf_ch != null) {
			// dd($adult2);
			// 2 Adult 1 Child
				$message = "1 Room + 1 ABF for Child";
				$total = $bed_price_total+$abf_ch_total;
				$abf_ch= $abf_ch;
				$obj = array(
					"message" => $message,
					"bed_price"=> $bed_price,
					"abf_ch"=>$abf_ch,
					"extra_bed_ch"=> '',
					"days"=> $days,
					"total"=> $total
				);
			return $obj;
		}elseif ($adult2 == 1 && $permitted_occupants == 2 && $child2==1 && $extra_bed == 1 && $abf_ch != null) {
			// 2 Adult 2 Child
				$message = "1 Room + 1 ABF for Child + 1 Extrabed for Child";
				$total = $bed_price_total+$abf_ch_total+$extra_bed_ch_total;
				$abf_ch= $abf_ch;
				$obj = array(
					"message" => $message,
					"bed_price"=> $bed_price,
					"abf_ch"=>$abf_ch,
					"extra_bed_ch"=> $extra_bed_ch,
					"days"=> $days,
					"total"=> $total
				);
			return $obj;
		}elseif ($adult2 == 1 && $permitted_occupants == 2 && $child2==1.5  && $abf_ch != null) {
			// 2 Adult 3 Child
				$message = nl2br("1 Rooms + 1 ABF for Child\n1 Room");
				$total = $bed_price_total*2+$abf_ch_total;
				$abf_ch= $abf_ch;
				$obj = array(
					"message" => $message,
					"bed_price"=> $bed_price*2,
					"abf_ch"=>$abf_ch,
					"extra_bed_ch"=> '',
					"days"=> $days,
					"total"=> $total
				);
			return $obj;
		}elseif ($adult2 == 1.5 && $permitted_occupants == 2 && $child2==1  && $abf_ch != null) {
			// 3 Adult 2 Child
				$message = nl2br("1 Rooms + 1 ABF for Child\n1 Room");
				$total = $bed_price_total*2+$abf_ch_total;
				$abf_ch= $abf_ch;
				$obj = array(
					"message" => $message,
					"bed_price"=> $bed_price*2,
					"abf_ch"=>$abf_ch,
					"extra_bed_ch"=> '',
					"days"=> $days,
					"total"=> $total
				);
			return $obj;
		}
		else {
			$obj = array(
				"message" => '',
				"bed_price"=> '',
				"abf_ch"=>'',
				"extra_bed_ch"=> '',
				"days"=> '',
				"total"=> ''
			);
		}
	}

	public function getHotelCalculation($hid,$from_date,$to_date,$adult,$child,$age)
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
			// $single = $rec->quote->single*$days*$adult;
			// $double = $rec->quote->double_twin*$days*$adult;
			$single = $rec->quote->single*$days;
			$double = $rec->quote->double_twin*$days;
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
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
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
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
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
			}elseif ($adult == 3 && $child == 1 && $rec->permitted_occupants == 2) {
				$rec->totalprice =$double+$single;
				$rec->room =2;
			}elseif ($adult == 3 && $child == 1 && $rec->permitted_occupants > 2 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$rec->totalprice =$double+$extra_bed_ad;
			}elseif ($adult == 3 && $child == 2 && $rec->permitted_occupants == 2 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$rec->totalprice =$double+$extra_bed_ad+$double;
				$rec->room =2;
			}elseif ($adult == 3 && $child == 2 && $rec->permitted_occupants == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$single;
				$rec->room =3;
			}elseif ($adult == 3 && $child == 3 && $rec->permitted_occupants == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$total2= $double+$extra_bed_ad;
				$rec->totalprice =$total1+$total2;
				$rec->room =2;
			}elseif ($adult == 3 && $child == 3 && $rec->permitted_occupants == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$double;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 0) {
				$rec->totalprice =$double+$double;
				$rec->room =2;
			}elseif ($adult == 4 && $child == 1 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days*$child;
				$rec->childprice = $extra_bed_ch;
				$rec->totalprice =$double+$extra_bed_ch+$double;
				$rec->room =2;
			}elseif ($adult == 4 && $child == 1 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$single;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 =$double+$extra_bed_ch;
				$total2 =$double+$extra_bed_ch;
				$rec->totalprice =$total1+$total2;
				$rec->room =2;
			}elseif ($adult == 4 && $child == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$double;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 3 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total = $double*3;
				$rec->totalprice =$total+$extra_bed_ch;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 3 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*3+$single;
				$rec->room =4;
			}elseif ($adult == 5 && $child == 0 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$total = $double*2;
				$rec->totalprice =$total+$extra_bed_ad;
				$rec->room =2;
			}elseif ($adult == 5 && $child == 0 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*2+$single;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 1 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$total2 = $double+$extra_bed_ad;
				$rec->totalprice =$total1+$total2;
				$rec->room =2;
			}elseif ($adult == 5 && $child == 1 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*3;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$total2 = $double*2;
				$rec->totalprice =$total1+$total2;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*3+$single;
				$rec->room =4;
			}elseif ($adult == 5 && $child == 3 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$total2 = $double+$extra_bed_ch;
				$total3 = $double;
				$rec->totalprice =$total1+$total2+$total3;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 3 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*4;
				$rec->room =4;
			}

		}

		}
		// dd($room_info);
		return $room_info;
	}

	public function getRoomsCalculation($rid,$from_date,$to_date,$adult,$child,$age)
	{
		// dd($rid." ".$from_date." ".$to_date." ".$adult." ".$child." ".$age);
		$datediff = strtotime($to_date) - strtotime($from_date);
		$days = round($datediff / (60 * 60 * 24));
		// dd($child);
		$room_info = DB::table('rooms')->where('rid',$rid)->limit(1)->get();
		// dd($room_info);
		foreach ($room_info as $key => &$rec) {
			$rec->quote = DB::table('hotel_quotations')->where('rid',$rec->rid)->where('to_date','>=',Carbon\Carbon::now())->first();
			// $rec->days = (int)$days;
			$rec->days = (int)$days;
			$rec->extra_price_ad='';
			$rec->childprice='';
			$rec->totalprice='';
			$rec->room='';
			if ($rec->quote !="") {
			// $single = $rec->quote->single*$days*$adult;
			// $double = $rec->quote->double_twin*$days*$adult;
			$single = $rec->quote->single*$days;
			$double = $rec->quote->double_twin*$days;
			// $extra_bed_ch = $rec->quote->extra_bed_ch*$days;
			// $extra_bed_ad = $rec->quote->extra_bed_ad*$days;
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
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
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
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
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
			}elseif ($adult == 3 && $child == 1 && $rec->permitted_occupants == 2) {
				$rec->totalprice =$double+$single;
				$rec->room =2;
			}elseif ($adult == 3 && $child == 1 && $rec->permitted_occupants > 2 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$rec->totalprice =$double+$extra_bed_ad;
			}elseif ($adult == 3 && $child == 2 && $rec->permitted_occupants == 2 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$rec->totalprice =$double+$extra_bed_ad+$double;
				$rec->room =2;
			}elseif ($adult == 3 && $child == 2 && $rec->permitted_occupants == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$single;
				$rec->room =3;
			}elseif ($adult == 3 && $child == 3 && $rec->permitted_occupants == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$total2= $double+$extra_bed_ad;
				$rec->totalprice =$total1+$total2;
				$rec->room =2;
			}elseif ($adult == 3 && $child == 3 && $rec->permitted_occupants == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$double;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 0) {
				$rec->totalprice =$double+$double;
				$rec->room =2;
			}elseif ($adult == 4 && $child == 1 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days*$child;
				$rec->childprice = $extra_bed_ch;
				$rec->totalprice =$double+$extra_bed_ch+$double;
				$rec->room =2;
			}elseif ($adult == 4 && $child == 1 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$single;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 =$double+$extra_bed_ch;
				$total2 =$double+$extra_bed_ch;
				$rec->totalprice =$total1+$total2;
				$rec->room =2;
			}elseif ($adult == 4 && $child == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double+$double+$double;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 3 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total = $double*3;
				$rec->totalprice =$total+$extra_bed_ch;
				$rec->room =3;
			}elseif ($adult == 4 && $child == 3 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*3+$single;
				$rec->room =4;
			}elseif ($adult == 5 && $child == 0 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$total = $double*2;
				$rec->totalprice =$total+$extra_bed_ad;
				$rec->room =2;
			}elseif ($adult == 5 && $child == 0 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*2+$single;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 1 && $rec->extra_bed == 1) {
				$extra_bed_ad = $rec->quote->extra_bed_ad*$days;
				$rec->extra_price_ad = $extra_bed_ad;
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$total2 = $double+$extra_bed_ad;
				$rec->totalprice =$total1+$total2;
				$rec->room =2;
			}elseif ($adult == 5 && $child == 1 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*3;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 2 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$total2 = $double*2;
				$rec->totalprice =$total1+$total2;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 2 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*3+$single;
				$rec->room =4;
			}elseif ($adult == 5 && $child == 3 && $rec->extra_bed == 1) {
				$extra_bed_ch = $rec->quote->extra_bed_ch*$days;
				$rec->childprice = $extra_bed_ch;
				$total1 = $double+$extra_bed_ch;
				$total2 = $double+$extra_bed_ch;
				$total3 = $double;
				$rec->totalprice =$total1+$total2+$total3;
				$rec->room =3;
			}elseif ($adult == 5 && $child == 3 && $rec->extra_bed == 0) {
				$rec->totalprice =$double*4;
				$rec->room =4;
			}

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
