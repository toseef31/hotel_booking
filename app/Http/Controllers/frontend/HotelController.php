<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
use Carbon;
use Session;
class HotelController extends Controller
{

  public function hotel_listing(Request $request)
  {
    $all_data = json_encode($request->all());
    // $all_data = $request->all();
    // dd($all_data);
      $date='';
      $from_date='';
      $to_date='';
      $min='';
      $max='';
      $min_price='';
      $max_price='';
      if($request->input('header-search') !=""){
      $date = $request->input('header-search');
      }elseif($request->input('dates') !=""){
      $date = $request->input('dates');
    }elseif ($request->input('main-input-search') !="") {
      $date = $request->input('main-input-search');
    }
    // dd($date);

      if ($date !="") {
      $result_explode = explode('-', $date);
      $from_date = trim($result_explode[0]);
      // 2020-01-01
      $from_date=date("Y-m-d", strtotime($from_date));
      $to_date = trim($result_explode[1]);
      $to_date=date("Y-m-d", strtotime($to_date));
    }

      $city = $request->input('city');
      $bed = $request->input('bed');
      $room = $request->input('room');
      $adult = $request->input('adult');
      $child = $request->input('child');
      $age = $request->input('age');
      $total_person = $child+$adult;
      $price = $request->input('price');
      $room_type = $request->input('room_type');
      $rating = $request->input('rating');
      if ($price !="") {
      $result_explode2 = explode(';', $price);
      $min_price = trim($result_explode2[0]);
      $max_price = trim($result_explode2[1]);
    }

      if ($age !="") {
        $min = min($age);
        $max = max($age);
      }
     // dd($rating);

      $hotels=DB::table('hotels')
      ->join('rooms','rooms.hid','=','hotels.hid')
      // ->join('hotel_quotations','hotel_quotations.rid','=','rooms.rid')
      ->join('hotel_photos','hotel_photos.hid','=','hotels.hid')
      ->select('hotels.*','hotel_photos.*','rooms.units_type','rooms.number_of_bedrooms');
      // if ($bed !="") {
      //   $hotels->where('rooms.number_of_bedrooms','=',$bed);
      //   }
      if ($city !="") {
        $hotels->where('hotels.city','like','%'.$city.'%');
      }
      if ($room_type !="") {
        $hotels->where('rooms.units_type','like','%'.$room_type.'%');
      }
      if ($min !="") {
        $hotels->where('hotels.child_age_from','>=',$min);
      }
      if ($max !="") {
        $hotels->where('hotels.child_age_to','<=',$max);
      }
      if ($min_price !="" && $max_price !="") {
        $hotels->whereBetween('hotels.low_rate',[$min_price, $max_price]);
      }
      if ($rating !="") {
        foreach ($rating as $rate) {
          $hotels->orwhere('hotels.rate','=',$rate);
        }
      }
      if ($total_person !="") {
        $hotels->where('rooms.permitted_occupants','=',$total_person);
      }
      // if ($from_date !="") {
      //   $hotels->where('hotel_quotations.from_date','>=',$from_date.' 00:00:00');
      //   $hotels->where('hotel_quotations.to_date','<=',$to_date.' 00:00:00');
      // }
    $hotels=$hotels->groupBy('hotels.hid')->orderBy('hotels.hid','asc')->limit(10)->get();
      // dd($hotels);
    foreach ($hotels as $rec) {
      $rec->decription_en = DB::table('hotel_description_en')->where('hid',$rec->hid)->first();
      $rec->decription_ru = DB::table('hotel_description_ru')->where('hid',$rec->hid)->first();
    }
    // $searchResult=DB::table('hotels')->join('rooms','rooms.hid','=','hotels.hid')
    // ->join('hotel_quotations','hotel_quotations.rid','=','rooms.rid')
    // ->where('hotels.city','=','Pattaya')->select('hotels.*')->where('hotels.child_age_from','>=',3)->where('hotels.child_age_to','<=',12)->where('hotel_quotations.from_date','>=','2020-01-01')->where('hotel_quotations.to_date','<=','2022-11-01')->where('rooms.permitted_occupants','>=',4)->groupBy('hotels.hid')->get();
    // dd($searchResult);
    // $hotels=$hotels[4];
    // dd($city);
    return view('frontend.listing',compact('hotels','city','all_data'));

  }

  public function hotel_listing_ajax(Request $request)
  {
    $data2= $request->input('data');
    dd($data2);
    $date='';
    $from_date='';
    $to_date='';
    $min='';
    $max='';
    $min_price='';
    $max_price='';
    if($request->input('header-search') !=""){
    $date = $request->input('header-search');
    }elseif($request->input('dates') !=""){
    $date = $request->input('dates');
    }

    if ($date !="") {
    $result_explode = explode('-', $date);
    $from_date = trim($result_explode[0]);
    // 2020-01-01
    $from_date=date("Y-m-d", strtotime($from_date));
    $to_date = trim($result_explode[1]);
    $to_date=date("Y-m-d", strtotime($to_date));
  }

    $city = $request->input('city');
    $bed = $request->input('bed');
    $room = $request->input('room');
    $adult = $request->input('adult');
    $child = $request->input('child');
    $age = $request->input('age');
    $total_person = $child+$adult;
    $price = $request->input('price');
    $room_type = $request->input('room_type');
    $rating = $request->input('rating');
    if ($price !="") {
    $result_explode2 = explode(';', $price);
    $min_price = trim($result_explode2[0]);
    $max_price = trim($result_explode2[1]);
  }

    if ($age !="") {
      $min = min($age);
      $max = max($age);
    }
   // dd($rating);

    $hotels=DB::table('hotels')
    ->join('rooms','rooms.hid','=','hotels.hid')
    // ->join('hotel_quotations','hotel_quotations.rid','=','rooms.rid')
    ->join('hotel_photos','hotel_photos.hid','=','hotels.hid')
    ->select('hotels.*','hotel_photos.*','rooms.units_type','rooms.number_of_bedrooms');
    // if ($bed !="") {
    //   $hotels->where('rooms.number_of_bedrooms','=',$bed);
    //   }
    if ($city !="") {
      $hotels->where('hotels.city','like','%'.$city.'%');
    }
    if ($room_type !="") {
      $hotels->where('rooms.units_type','like','%'.$room_type.'%');
    }
    if ($min !="") {
      $hotels->where('hotels.child_age_from','>=',$min);
    }
    if ($max !="") {
      $hotels->where('hotels.child_age_to','<=',$max);
    }
    if ($min_price !="" && $max_price !="") {
      $hotels->whereBetween('hotels.low_rate',[$min_price, $max_price]);
    }
    if ($rating !="") {
      foreach ($rating as $rate) {
        $hotels->orwhere('hotels.rate','=',$rate);
      }
    }
    if ($total_person !="") {
      $hotels->where('rooms.permitted_occupants','=',$total_person);
    }
    $id = $request->input('id');
    $hotels=$hotels->where('hotels.hid','>',$id)->groupBy('hotels.hid')->orderBy('hotels.hid','asc')->limit(10)->get();

    // $hotels = DB::table('hotels')->join('hotel_photos','hotel_photos.hid','=','hotels.hid')->where('hotels.hid','>',$id)->orderBy('hotels.hid','asc')->limit(10)->get();
    foreach ($hotels as $rec) {
      $rec->decription_en = DB::table('hotel_description_en')->where('hid',$rec->hid)->first();
      $rec->decription_ru = DB::table('hotel_description_ru')->where('hid',$rec->hid)->first();
    }
    // dd($hotels);
    return view('frontend.listing-ajax',compact('hotels'));

  }


  public function hotel_detail(Request $request,$id)
  {
    //dd($request->all());
    $hotel = DB::table('hotels')->join('hotel_photos','hotel_photos.hid','=','hotels.hid')->where('hotels.hid',$id)->first();
    // dd($hotel);
      $hotel_decription_en = DB::table('hotel_description_en')->where('hid',$id)->get();
      $hotel_decription_ru = DB::table('hotel_description_ru')->where('hid',$id)->get();
      $hotel_distance = DB::table('hotel_distance')->where('hid',$id)->get();
      $hotel_remarks = DB::table('hotel_remarks')->where('hid',$id)->get();
      $hotel_gallery = DB::table('hotel_gallery_title')->where('hid',$id)->get();
      foreach ($hotel_gallery as $rec) {
        $rec->photos = DB::table('hotel_gallery_photos')->where('hptid',$rec->hptid)->first();
      }
      // dd($hotel_remarks);
      $rooms = DB::table('rooms')->where('hid',$id)->get();
      foreach ($rooms as $rec) {
        $rec->quotation = DB::table('hotel_quotations')->where('rid',$rec->rid)->get();
        $rec->description_en = DB::table('room_description_en')->where('rid',$rec->rid)->first();
        $rec->description_ru = DB::table('room_description_ru')->where('rid',$rec->rid)->first();
        $rec->photos = DB::table('room_photos')->where('rid',$rec->rid)->first();
      }
      $similar_list = DB::table('hotels')->join('hotel_photos','hotel_photos.hid','=','hotels.hid')->where('hotels.city',$hotel->city)->where('hotels.hid','<>',$id)->limit(5)->get();

    // dd($similar_list);
    return view('frontend.detail',compact('hotel','hotel_decription_en','hotel_decription_ru','hotel_distance','hotel_gallery','rooms','similar_list','hotel_remarks'));

  }

  public function room_detail(Request $request,$id)
  {
    $room_info = DB::table('rooms')->where('rid',$id)->first();
    $room_description_en = DB::table('room_description_en')->where('rid',$id)->first();
    $room_description_ru = DB::table('room_description_ru')->where('rid',$id)->first();
    $room_photos = DB::table('room_photos')->where('rid',$id)->first();
    $room_quotation = DB::table('hotel_quotations')->where('rid',$id)->where('to_date','>=',Carbon\Carbon::now())->get();
    // dd(Carbon\Carbon::now());
    // dd($room_quotation);
    return view('frontend.room-details-ajax',compact('room_info','room_photos','room_quotation','room_description_en','room_description_ru'));

  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
