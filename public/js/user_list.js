var id;
var upitem;

$('.main__table-lists-line-delbtn').click(function () {
  upitem = $(this).parent();
  id = upitem.find('input[name="id"]').val();

  $('.dialog').css('display', 'block');
});


$('.dialog_OK').click(function () {

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

