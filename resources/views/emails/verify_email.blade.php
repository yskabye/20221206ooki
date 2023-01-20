@component('mail::message')
# ご登録ありがとうございます

この度はご登録いただき、ありがとうございます。<br>
ご登録を続けるには、以下のボタンをクリックしてください。

@component('mail::button', ['url' => $verify_url])
登録を続ける
@endcomponent

何かご不明点などがありましたら、下記よりお問い合わせください。<br>
[{{ url('contact') }}]({{ url('contact') }})

※こちらのメールは送信専用のメールアドレスより送信しております。恐れ入りますが、直接ご返信しないようお願いいたします。

Resa
@endcomponent