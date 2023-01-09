<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Restrant;
use App\Http\Requests\UserRequest;

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
        User::create(($form));

        $user = Auth::user();

        return route('/admin/list_user');
    }

    public function update(UserRequest $request)
    {
        
        if(empty($request->id)){
            $form = $request->all();
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
