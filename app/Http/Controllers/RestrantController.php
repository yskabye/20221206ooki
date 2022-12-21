<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restrant;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RestrantController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::id();
        $areas = Area::all();
        $genres = Genre::all();

        $shops = Restrant::with('area')->with('genre')->get();

        $db_data = Favorite::where('user_id', ($user == null ? 0 : $user))
            ->orderBy('restrant_id')->get();

        $favorites = [];
        for ($i = 0; $i < count($shops); $i++) {
            $flg = false;
            $id = 0;
            foreach ($db_data as $data) {
                if ($shops[$i]->id == $data->restrant_id) {
                    $flg = true;
                    $id = $data->id;
                    break;
                }
            }
            array_push($favorites, ['flag' => $flg, 'id' => $id]);
        }

        return view('index', ['userid' => $user, 'shops' => $shops, 'areas' => $areas, 'genres' => $genres, 'favorites' => $favorites]);
    }

    public function detail($id)
    {
        $user = Auth::id();

        $shop = Restrant::with('area')
            ->with('genre')
            ->find($id);

        $shop->rsv_date = Carbon::today();
        $shop->rsv_date->addDays($shop->period);
        $shop->rsv_limit = new Carbon($shop->rsv_date);
        $shop->rsv_limit->addMonths($shop->limit);
        $dayofweek = $shop->rsv_date->dayOfWeekIso;
        if ($dayofweek == $shop->holiday)
            $shop->rsv_date->addDays(1);
        $shop->rsv_start = new Carbon($shop->rsv_start);
        $shop->rsv_end = new Carbon($shop->rsv_end);

        return view('detail', ['userid' => $user, 'shop' => $shop]);
    }
}