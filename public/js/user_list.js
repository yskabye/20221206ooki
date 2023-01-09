var id;
var upitem;

$('.main__table-lists-line-delbtn').click(function () {
  // 削除IDの取得1
  upitem = $(this).parent();
  id = upitem.find('input[name="id"]').val();

  $('.dialog').css('display', 'block');
});


$('.dialog_OK').click(function () {
  // 削除処理
 $.ajax({
    type: "DELETE",
    url: "../api/v1/user/" + id,
    data: {},
    cashe: false,
    dataType: "json",
    scriptCharaset: "utf-8",
    timespan: 1000,
  }).done(function (data) {
    $('.dialog').css('display', 'none');
    upitem.hide();
  }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest + " " + textStatus + errorThrown) ;
  });
});

$('.dialog_Cancel').click(function() {
  $('.dialog').css('display', 'none');
});

