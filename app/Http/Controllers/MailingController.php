<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MailRequest;
use App\Models\Restrant;
use App\Models\User;
use App\Models\Promote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 
use App\Mail\PromoteMail; 
use App\Jobs\SendMailJob;
use Carbon\Carbon;

class MailingController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user() ;
        $restrant = Restrant::find($user->restrant_id);

        $ebody = Promote::find($user->restrant_id);
        if(!empty($ebody->send_at)) $ebody->send_at = new Carbon($ebody->send_at);
        if(empty($request->session()->get('report'))){
            $report = '';
        }else{
            $report = $request->session()->get('report');
            $request->session()->put('report','');
        }

        return view('admin.mailing',['user' => $user, 'restrant' => $restrant, 'ebody' => $ebody, 'report' => $report]);
    }

    public function update(MailRequest $request)
    {
        $form = $request->all();
        $form['send_at'] = null ;
        if(empty($request->id)){
            Promote::create($form);
        }else{
            unset($form['_token']);

            Promote::where('id', $form['id'])->update($form);
        }

        $ebody = Promote::find($user->restrant_id);

        $request->session()->put('report', '保存または更新しました。');

        return redirect('/admin/mailing');
    }

    public function sendmail(MailRequest $request)
    {
        $user = Auth::user() ;
        $restrant = Restrant::find($user->restrant_id);

        $form = $request->all();

        $tos = ['kanbye@gmail.com', 'yassyok@ymail.ne.jp', 'yskanbye@rakuten.jp'];
        $subject = $form['subject'] ;
        $from = $user->email;
        $name = $restrant->name . '店長 : ' . $user->name ;
        $message =  $form['message'] ;

        // 送信先
        $customers = User::where('type_id', 0)->get();
        $report= '' ;

        foreach($customers as $customer){
            SendMailJob::dispatch($customer->email,$from, $name, $subject, $message)->delay(now()->addSecond(4));;
        }

        $report = 'メール送信は完了しました。';

        $form['send_at'] = new Carbon() ;
        if(empty($request->id)){
            Promote::create($form);
        }else{
            unset($form['_token']);

            Promote::where('id', $form['id'])->update($form);
        }

        $request->session()->put('report', $report) ;

        return redirect('/admin/mailing');
    }
}
