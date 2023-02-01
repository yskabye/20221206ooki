<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FavoriteController extends Controller
{
    public function mypage(Request $request)
    {
        $user = Auth::user();

        $reserves = Reserve::with('restrant')
            ->where('user_id', $user->id)
            ->where('reserve_date', '>=', Carbon::today())
            ->orderBy('reserve_date')
            ->orderBy('reserve_time')
            ->orderBy('reserves.id')
            ->get();
        
        foreach ($reserves as $reserve) {
            $reserve->reserve_date = new Carbon($reserve->reserve_date);
            $reserve->reserve_time = new Carbon($reserve->reserve_time);
            if(!empty($reserve->visit_at)) $reserve->visit_at = new Carbon($reserve->visit_at);
        }

        $sql = 'select favorites.id, favorites.user_id, favorites.restrant_id, ' .
            'restrants.name, restrants.image, ' .
            'areas.name area_name, genres.name genre_name ' .
            'from favorites, restrants ' .
            'inner join areas on areas.id = restrants.area_id ' .
            'inner join genres on genres.id = restrants.genre_id ' .
            'where favorites.restrant_id = restrants.id ' .
            'and favorites.user_id = ? ' .
            'order by restrants.id';

        $favorites = \DB::select($sql, [$user->id]);

        return view('mypage', ['user' => $user, 'reserves' => $reserves, 'favorites' => $favorites]);
    }

    public function index()
    {
        $item = Favorite::with('restrant')
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $item], 200);
    }

    public function store(Request $request)
    {
        $item = Favorite::create($request->all());

        return response()->json(['data' => $item], 200);
    }

    public function show(Favorite $favorite)
    {
        $item = Favorite::find($favorite->id);
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    public function shows(Request $request)
    {
        $items = Favorite::where('user_id', $request->id)
            ->orderBy('restrant_id')
            ->get();
        if (count($items) > 0) {
            return response()->json([
                'data' => $items
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    public function destroy(Request $request)
    {
        if (empty($request->id)) {
            return response()->json(['message' => 'Parameter not found'], 204);
        }

        $item = Favorite::find($request->id)->delete();
        if ($item) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}