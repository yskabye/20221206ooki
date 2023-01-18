<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Restrant;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $requset)
    {
        $users = User::with('restrant')
                       ->where('type_id', 5)
                       ->OrderBy('id')
                       ->get();

        $user = Auth::user();

        return view('admin.userlist',['user' =>$user, 'users' => $users]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();

        $employee = User::find($request->id);

        $restrants = Restrant::all();

        return view('admin.useredit',['user' => $user, 'employee' => $employee, 'restrants' => $restrants]);
    }

    public function create(UserRequest $request)
    {
        $form = $request->all();
        $restrant_id = $request->restrant_id;

        // 新規店舗の場合は勝手なデータを作成
        if($request->restrant_id == 0){
            $record = [];
            $record['name'] = '店舗名を設定のこと';
            $record['area_id'] = 1;
            $record['genre_id'] = 1;
            $record['overview'] = '店舗の説明を入れてください。' ;
            $record['image'] = 'sushi.jpg';
            $record['period'] = 1;
            $record['limit'] = 12;
            $record['holiday'] = 3;
            $record['rsv_start'] = new Carbon('11:00');
            $record['rsv_end']  = new Carbon('23:00');
            $record['timespan'] = 30;
            $record['rsv_min'] = 1;
            $record['rsv_max'] = 10;

            $result = Restrant::create($record);
            
            $record['id'] = $result->id;
            $record['name'] = '店舗' . $result->id;
            Restrant::find($result->id)->update($record);

            $restrant_id = $result->id ;
        }

        if($form['restrant_id'] == 0) $form['restrant_id'] = $restrant_id ;
        User::create(($form));

        $user = Auth::user();

        return route('/admin/list_user');
    }

    public function update(UserRequest $request)
    {
        $restrant_id = $request->restrant_id ;

        // 新規店舗の場合は勝手なデータを作成
        if($request->restrant_id == 0){
            $record = [];
            $record['name'] = '店舗';
            $record['area_id'] = 1;
            $record['genre_id'] = 1;
            $record['overview'] = '店舗の説明を入れてください。' ;
            $record['image'] = 'sushi.jpg';
            $record['period'] = 1;
            $record['limit'] = 12;
            $record['holiday'] = 3;
            $record['rsv_start'] = new Carbon('11:00');
            $record['rsv_end']  = new Carbon('23:00');
            $record['timespan'] = 30;
            $record['rsv_min'] = 1;
            $record['rsv_max'] = 10;

            $result = Restrant::create($record);
            
            $record['id'] = $result->id;
            $record['name'] = '店舗' . $result->id;
            Restrant::find($result->id)->update($record);

            $restrant_id = $result->id ;
        }

        if(empty($request->id)){
            $form = $request->all();
            if($form['restrant_id'] == 0) $form['restrant_id'] = $restrant_id ;
            $form['password'] = bcrypt($form['password']);
            User::create(($form));
        }else{
            $form = $request->all();
            unset($form['_token']);
            if($form['pwd_flg'] == 1){
                $form['password'] = bcrypt($form['password']);
            }else{
                unset($form['password']);
            }
            unset($form['pwd_flg']);
            if($form['restrant_id'] == 0) $form['restrant_id'] = $restrant_id ;

            User::where('id',$request->id)->update($form);
        }

        return redirect('/admin/user_list');
    }

    public function destroy(Request $request)
    {
        if (empty($request->id)) {
            return response()->json(['message' => 'Parameter not found'], 204);
        }

        $item = User::find($request->id)->delete();

        if ($item) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

}
