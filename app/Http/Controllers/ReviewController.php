<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function dsphistory()
    {
        $user = Auth::user();

        $reserves = Reserve::with('restrant')
                            ->with('review')
                            ->where('user_id', $user->id)
                            ->where('reserve_date', '<', Carbon::now())
                            ->orderBy('reserves.id')
                            ->get();

        foreach ($reserves as $reserve) {
            $reserve->reserve_date = new Carbon($reserve->reserve_date);
            $reserve->reserve_time = new Carbon($reserve->reserve_time);
        }

        return view('history', ['user' => $user, 'reserves' => $reserves]);        
    }

    public function store(Request $request)
    {
        $item = Review::create($request->all());
        
        return response()->json(['data' => $item], 200);
    }
}
