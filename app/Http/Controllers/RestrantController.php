<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RestrantRequest;
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
        $user = Auth::user();
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

        return view('index', ['user' => $user, 'shops' => $shops, 'areas' => $areas, 'genres' => $genres, 'favorites' => $favorites]);
    }

    public function detail($id)
    {
        $user = Auth::user();

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

        return view('detail', ['user' => $user, 'shop' => $shop]);
    }

    public function editstore()
    {
        $user = Auth::user();
        if(empty($user->restrant_id)) {
            route('/');
        }
        
        $restrant = Restrant::find($user->restrant_id);
        $restrant->rsv_start = new Carbon($restrant->rsv_start);
        $restrant->rsv_end = new Carbon($restrant->rsv_end);       

        $areas = Area::all();
        $genres = Genre::all();

        $holiday = array(['id' => 0, 'name' => 'なし'],
                         ['id' => 1, 'name' => '日'],
                         ['id' => 2, 'name' => '月'],
                         ['id' => 3, 'name' => '火'],
                         ['id' => 4, 'name' => '水'],
                         ['id' => 5, 'name' => '木'],
                         ['id' => 6, 'name' => '金'],
                         ['id' => 7, 'name' => '土'] );

        $dir = resource_path('../public/images/store') ;
        $files = glob($dir . '/*.jpg') ;
        $images = [];

        foreach($files as $file){
            $images[] = basename($file); 
        }

        $restrant->profile = str_replace($restrant->profile, '¥¥n', '¥n');

        return view('admin.storeinfo',['user' => $user, 'restrant' => $restrant, 'areas' => $areas, 'genres' => $genres, 'holidays' => $holiday,'images' => $images]);
    }

    public function update(RestrantRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);

        Restrant::where('id', $request->id)->update($form);

        return redirect('/admin/store_edit');
    }

}