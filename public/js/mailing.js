$(window).on('load', function () {
  if ($('.dialog p').text().length > 0){
    $('.dialog_btn').hide();
    $('.dialog_btn2').show();
    $('.dialog').show();
  } 
});

$('.main__btn-sendbtn').click(function () {
  $('.dialog_btn2').hide();
  $('.dialog_btn').show();
  $('.dialog p').text("メール送信を実行しますか？");
  $('.dialog').show();
});
  
$('.dialog_OK').click(function () {

  if ($('.dialog_btn').is(':visible')) {
    $('.dialog').hide();
    
    /*$('.dialog_btn2').hide();
    $('.dialog_btn').hide();
    $('.dialog p').text("メール転送中！ ...");
    $('.dialog').show();*/

    // ポスト実行
    $('form').attr('action', $('.main__btn-sendbtn').attr("formaction"));
    const form = $('form');
    form.submit();

  } else {
    $('.dialog').hide();
  }

});

$('.dialog_Cancel').click(function () {
  $('.dialog').hide();
});