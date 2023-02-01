<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestrantRequest;
use App\Models\Restrant;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

define("IMAGEDIR", "../public/storage/images");

class RestrantController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $areas = Area::all();
        $genres = Genre::all();

        $shops = Restrant::with('area')->with('genre')->get();

        $db_data = Favorite::where('user_id', ($user == null ? 0 : $user->id))
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

        // レビュー追加 2023.1.16
        $sql = "select reviews.values, reviews.comment, users.name, " .
               "reserves.reserve_date, reserves.reserve_time from reviews " .
               "inner join reserves on reserves.id = reviews.reserve_id " .
               "and reserves.restrant_id = " . $id .
               " inner join users on reserves.user_id = users.id " .
               "order by reserves.reserve_date, reserves.reserve_time";

        $reviews = \DB::select($sql,[$id]);
        $total = count($reviews);

        foreach($reviews as $review){
            $review->reserve_date = new Carbon($review->reserve_date);
            $review->reserve_time = new Carbon($review->reserve_time);
        }

        $currentPage = Paginator::resolveCurrentPage();
        $perPage = 5;
        $results = \DB::select("{$sql} LIMIT :per_page OFFSET :offset", [
            'per_page' => $perPage,
            'offset' => $currentPage * $perPage - $perPage
        ]);

        // LengthAwarePaginatorのインタスタンスを取得
        $pagination = new  \Illuminate\Pagination\LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => sprintf(
                    '%s%s',
                    request()->url(),
                    request()->except('page')
                        ? '?' . http_build_query(request()->except('page'))
                        : ''
                )
            ]
        );

        return view('detail', ['user' => $user, 'shop' => $shop, 'reviews' => $pagination]);
    }

    public function editstore(Request $request)
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
                         ['id' => 7, 'name' => '日'],
                         ['id' => 1, 'name' => '月'],
                         ['id' => 2, 'name' => '火'],
                         ['id' => 3, 'name' => '水'],
                         ['id' => 4, 'name' => '木'],
                         ['id' => 5, 'name' => '金'],
                         ['id' => 6, 'name' => '土'] );

        $dir = resource_path(IMAGEDIR) ;
        $files = glob($dir . '/{*.jpg,*.jpeg}', GLOB_BRACE) ;
        $images = [];

        foreach($files as $file){
            $images[] = basename($file); 
        }

        return view('admin.storeinfo',['user' => $user, 'restrant' => $restrant, 'areas' => $areas, 'genres' => $genres, 'holidays' => $holiday,'images' => $images]);
    }

    public function update(RestrantRequest $request)
    {
        $form = $request->all();

        // 画像ファイルがサーバーにない場合はアップロードする
        $dir = resource_path(IMAGEDIR) ;
        if(!(file_exists($dir . '/' . $form['image']))){
            if(!empty($form['upfile'])){
                $fname = $request->file('upfile')->getClientOriginalName();
                $request->file('upfile')->storeAs('public/images', $fname);
            }
        }        

        unset($form['_token']);
        unset($form['upfile']);

        Restrant::where('id', $request->id)->update($form);

        return redirect('/admin/store_edit');
    }

}