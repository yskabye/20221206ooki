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

    $userid = Auth::id();

    return view('done', ['userid' => $userid]);
  }

  public function update(ReserveRequest $request)
  {
    $form = $request->all();
    unset($form['_token']);   
    unset($form['holiday']);
    unset($form['holiday']);
    Reserve::where('id', $request->id)->update($form);

    $userid = Auth::id();

    return view('redone', ['userid' => $userid]);
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
      $user = Auth::id();

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

      return view('update', ['userid' => $user, 'reserve' => $reserve, 'shop' => $shop]);
  }

}