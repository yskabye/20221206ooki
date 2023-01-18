$('select[name="image"]').change(function () {
  $('.main__input1-right img').attr('src', '../storage/images/' + $('select[name="image"]').val());
});

$('select[name="timespan"]').change(function () {
  var value = Number($('select[name="timespan"]').val());
  value *= 60;
  $('input[name="rsv_start"]')[0]['step'] = value;
  $('input[name="rsv_end"]')[0]['step'] = value;
});
  
$('#upload').change(function (e) {
  var file = e.target.files[0];
  if(file.type.indexOf('jpg') < 0 && file.type.indexOf('jpeg') < 0){
    alert("JPEG画像ファイルを指定してください。");
    return false;
  }

  // すでにサーバーにあるファイルかどうか？
  var path = $('#upload').val();
  var fname = path.split(/[\\\/]/).pop();

  $('select[name="image"] option').each(function () {
    if (fname == $(this).text()) {
      $('.dialog p').text("すでに同一名がアップロード済みです。");
      $('#upload').val('');
      $('.dialog').css('display','block');
      return;
    }
  });
});

$('.dialog_OK').click(function () {
  $('.dialog').hide();
});