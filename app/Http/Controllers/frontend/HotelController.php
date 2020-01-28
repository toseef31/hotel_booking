<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
use Carbon;
class HotelController extends Controller
{

  public function hotel_listing(Request $request)
  {
    // dd($request->all());
    if ($request->isMethod('post')) {
      $date = $request->input('header-search');
      $result_explode = explode('-', $date);
      $from_date = trim($result_explode[0]);
      // 2020-01-01
      $from_date=date("Y-m-d", strtotime($from_date));
      $to_date = trim($result_explode[1]);
      $to_date=date("Y-m-d", strtotime($to_date));
      $room = $request->input('room');
      $adult = $request->input('adult');
      $child = $request->input('child');
      $age = $request->input('age');
      $total_person = $child+$adult;
      $min = min($age);
     $max = max($age);
     // dd($from_date);
     // $searchResult=DB::table('hotels')->join('rooms','rooms.hid','=','hotels.hid')
     // ->join('hotel_quotations','hotel_quotations.rid','=','rooms.rid')
     // ->where('hotels.city','=','Pattaya')->select('hotels.*')->where('hotels.child_age_from','>=',1)->where('hotels.child_age_to','<=',5)->where('hotel_quotations.from_date','>=','2020-01-28')->where('hotel_quotations.to_date','<=','2020-01-29')->where('rooms.permitted_occupants','>=',4)->groupBy('hotels.hid')->get();
     // dd($searchResult);
      $hotels=DB::table('hotels')->join('rooms','rooms.hid','=','hotels.hid')
      ->join('hotel_quotations','hotel_quotations.rid','=','rooms.rid')
      ->join('hotel_photos','hotel_photos.hid','=','hotels.hid')->where('hotels.city','=','Pattaya')->select('hotels.*','hotel_photos.*')->where('hotels.child_age_from','>=',$min)->where('hotels.child_age_to','<=',$max)->where('hotel_quotations.from_date','>=',$from_date)->where('hotel_quotations.to_date','<=',$to_date)->where('rooms.permitted_occupants','>=',$total_person)->groupBy('hotels.hid')->get();
      // dd($hotels);
  }else {

    // $searchResult=DB::table('hotels')->join('rooms','rooms.hid','=','hotels.hid')
    // ->join('hotel_quotations','hotel_quotations.rid','=','rooms.rid')
    // ->where('hotels.city','=','Pattaya')->select('hotels.*')->where('hotels.child_age_from','>=',3)->where('hotels.child_age_to','<=',12)->where('hotel_quotations.from_date','>=','2020-01-01')->where('hotel_quotations.to_date','<=','2022-11-01')->where('rooms.permitted_occupants','>=',4)->groupBy('hotels.hid')->get();
    // dd($searchResult);
    $hotels = DB::table('hotels')->join('hotel_photos','hotel_photos.hid','=','hotels.hid')->orderBy('hotels.hid','asc')->limit(10)->get();
  }
    foreach ($hotels as $rec) {
      $rec->decription_en = DB::table('hotel_description_en')->where('hid',$rec->hid)->first();
      $rec->decription_ru = DB::table('hotel_description_ru')->where('hid',$rec->hid)->first();
    }

    // dd($hotels);
    return view('frontend.listing',compact('hotels'));

  }

  public function hotel_listing_ajax(Request $request)
  {
    // dd($request->all());
    $id = $request->input('id');
    $hotels = DB::table('hotels')->join('hotel_photos','hotel_photos.hid','=','hotels.hid')->where('hotels.hid','>',$id)->orderBy('hotels.hid','asc')->limit(10)->get();
    foreach ($hotels as $rec) {
      $rec->decription_en = DB::table('hotel_description_en')->where('hid',$rec->hid)->first();
      $rec->decription_ru = DB::table('hotel_description_ru')->where('hid',$rec->hid)->first();
    }
    // dd($hotels);
    return view('frontend.listing-ajax',compact('hotels'));

  }


  public function hotel_detail(Request $request,$id)
  {
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
    $room_quotation = DB::table('hotel_quotations')->where('rid',$id)->where('from_date','>=',Carbon\Carbon::now())->get();
    // dd(Carbon\Carbon::now());
    // dd($room_description_en);
    return view('frontend.room-details-ajax',compact('room_info','room_photos','room_quotation','room_description_en','room_description_ru'));

  }

  public function get_cities(Request $request)
  {
    // dd($request->all());
    $keyword = $request->input('search');
    $cities = DB::table('cities');
    if ($keyword !="") {
      $cities->Where('name','like','%'.$keyword.'%');
    }
    $result=$cities->limit(15)->get();
    // dd($cities);
    $template='';
       foreach($result as $serarch){
          if($serarch->cid != null){
            // $url=url('shoppingmall/product/'.$serarch->product_id);
              $template .= '<li style="display: list-item;border-bottom: 2px solid #3838381a;padding: 8px;text-align:left;">'.$serarch->name.' </li>';
              // $template .= '<option value="'.$serarch->name.'">'.$serarch->name.'</option>';
              }
             }
             // dd($template);
        return json_encode($template);
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
