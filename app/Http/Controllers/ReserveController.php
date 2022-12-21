<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
  public function create(ReserveRequest $request)
  {
    $form = $request->all();
    Reserve::create(($form));

    $userid = Auth::id();

    return view('done', ['userid' => $userid]);
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

}