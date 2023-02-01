$('.main__left-list-card-top-link').click(function () {
  var key = $(this).parent().find('input[name="reserve_id"]');
  var mybox = $(this).parent().parent();

  $.ajax({
    type: "DELETE",
    url: "api/v1/reserve/" + key.val(),
    data: {},
    cashe: false,
    dataType: "json",
    scriptCharaset: "utf-8",
    timespan: 2000,
  }).done(function (data) {
    mybox.hide();
    var max = $('input[name="reserve_num"]').val();
    var keyname = mybox.attr('id');
    keyname = keyname.substr(3);
    var min =  Number(keyname) + 1;
    var sno = min;
    for (var i = min; i < max; i++){
      var idname = '#rsv' + i; 
      var box = $(idname);
      if (box.is(":visible")){
        var target = box.find('.main__left-list-card-top p');
        target.text('予約' + sno);
        sno++;
      }
    }
  }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest + " " + textStatus + errorThrown) ;
  });
});

$('.heart').click(function () {
  var key = $(this).parent().find('input[name="favorite_id"]');
  var parent = $(this).parent().parent().parent();

  $.ajax({
    type: "DELETE",
    url: "api/v1/favorite/" + key.val(),
    data: {},
    cashe: false,
    dataType: "json",
    scriptCharaset: "utf-8",
    timespan: 1000,
  }).done(function (data) {
    parent.hide();
  }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest + " " + textStatus + errorThrown) ;
  });
});


