<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;
use App\Models\Restrant;
use Carbon\Carbon;

class ReserveController extends Controller
{
  public function create(ReserveRequest $request)
  {
    $form = $request->all();
    Reserve::create(($form));

    $user = Auth::user();

    return view('done', ['user' => $user]);
  }

  public function update(ReserveRequest $request)
  {
    $form = $request->all();
    unset($form['_token']);   
    unset($form['holiday']);
    unset($form['holiday']);
    Reserve::where('id', $request->id)->update($form);

    $user = Auth::user();

    return view('redone', ['user' => $user]);
  }

  public function destroy(Reserve $reserve)
  {
    $item = Reserve::where('id', $reserve->id)->delete();
    if ($item) {
      return response()->json([
        'message' => 'Deleted successfully',
      ], 200);
    } else {
      return response()->json([
        'message' => 'Not found',
      ], 404);
    }
  }

  public function correct(Request $request)
  {
    $user = Auth::user();

    $reserve = Reserve::with('restrant')
        ->find($request->reserve_id);

    $reserve->reserve_date = new Carbon($reserve->reserve_date);
    $reserve->reserve_time = new Carbon($reserve->reserve_time);

    $shop = Restrant::with('area')
        ->with('genre')
        ->find($reserve->restrant_id);

    $shop->rsv_limit = new Carbon(Carbon::today());
    $shop->rsv_sdate = new Carbon(Carbon::today());
    $shop->rsv_sdate->addDays($shop->period);
    $shop->rsv_limit->addMonths($shop->limit);
    $shop->rsv_start = new Carbon($shop->rsv_start);
    $shop->rsv_end = new Carbon($shop->rsv_end);

    return view('update', ['user' => $user, 'reserve' => $reserve, 'shop' => $shop]);
  }

  public function listing(Request $request)
  {
    $user = Auth::user();
    if(empty($user->restrant_id)){
      route('/');
    }

    $restrant = Restrant::find($user->restrant_id) ;

    $query = Reserve::with('user')
                    ->where('restrant_id', $user->restrant_id);
    if(!empty($request->str_date) && !empty($request->end_date)){
      $query->whereBetween('reserve_date', [$request->str_date, $request->end_date]);
    }else if(!empty($request->str_date)){
      $query->whereDate('reserve_date','>=',$request->str_date);
    }else if(!empty($request->end_date)){
      $query->whereDate('reserve_date','<=',$request->end_date);
    }

    if(!empty($request->str_time) && !empty($request->end_time)){
      $query->whereBetween('reserve_time', [$request->str_time, $request->end_time]);
    }else if(!empty($request->str_time)){
      $query->whereTime('reserve_time', '>=', $request->str_time);
    }else if(!empty($request->end_time)){
      $query->whereTime('reserve_time', '<=', $request->end_time);
    }

    $reserves = $query->OrderBy('reserve_date')
                      ->OrderBy('reserve_time')
                      ->OrderBy('id')
                      ->get();

    foreach ($reserves as $reserve) {
        $reserve->reserve_date = new Carbon($reserve->reserve_date);
        $reserve->reserve_time = new Carbon($reserve->reserve_time);
    }

    $timespan = $restrant->timespan * 60;

    $key = [];
    if(!empty($request->str_date)) $key += array('str_date' => $request->str_date);
    if(!empty($request->end_date)) $key += array('end_date' => $request->end_date);
    if(!empty($request->str_time)) $key += array('str_time' => $request->str_time);
    if(!empty($request->end_time)) $key += array('end_time' => $request->end_time);

    return view('admin.rsvlist',['user' => $user, 'key' => $key, 'restrant' => $restrant, 'reserves' => $reserves, 'timespan' => $timespan]);
  }

}