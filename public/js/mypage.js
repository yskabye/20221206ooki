$(window).on("load", function () {
  /*$('.tooltip').hide();
  $('.main__items-left-list-card-top-left-icon').hover(
    function () {
      $(this).children('.tooltip').fadeIn('fast')
    },
    function () {
      $(this).children('.tooltip').fadeOut('fast');
    }
  );

  $('.main__items-left-list-card-top-link').hover(
    function () {
      $(this).children('.tooltip').fadeIn('fast');
    },
    function () {
      $(this).children('.tooltip').fadeOut('fast');  
    }
  );2022.12.23 保留*/

	// 再度、横幅と高さを取得
	width = $(window).width();
  height = $(window).height();
  
  adjustDummy(width);
});

$(window).on("resize", function () {
	// 再度、横幅と高さを取得
	width = $(window).width();
  height = $(window).height();
  
  adjustDummy(width);
});

$('.main__items-left-list-card-top-link').click(function () {
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
    // 予約番号の変更
    var max = $('input[name="reserve_num"]').val();
    var keyname = mybox.attr('id');
    keyname = keyname.substr(3);
    var min =  Number(keyname) + 1;
    var sno = min;
    for (var i = min; i < max; i++){
      var idname = '#rsv' + i; 
      var box = $(idname);
      if (box.is(":visible")){
        var target = box.find('.main__items-left-list-card-top p');
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

function adjustDummy(width) {
  var cut = 1;
  if (width >= 1702)
    cut = 3;
  else if (width >= 1372)
    cut = 2;
  
  var allnum = $('input[name="favorite_num"]').val();
  
  var remain = allnum % cut;

  if (cut - remain > 0) {
    $('.dumybox1').css('display', 'inline-block');
    if (cut - remain > 1) {
      $('.dumybox2').css('display', 'inline-block');
    }
  }
}


