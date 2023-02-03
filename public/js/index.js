const KEY = "RESE.Favorite";
  
$(window).on("load", function () {
  var allnum = $('input[name="allnum"]').val();

  if ($.cookie(KEY) != undefined) {
    var user_id = $('input[name="user_id"').val();
    if (user_id != '' && user_id != null) {
      var keyval = $.cookie(KEY);

      for (var i = 0; i < allnum; i++){
        if ($('#box' + i + ' input[name="restrant_id"]').val() == keyval) {
          var button = $('#box' + i + ' .heart_off');
          if (button.length > 0) {
            $.ajax({
              type: 'POST',
              url: 'api/v1/favorite',
              data: {
                'user_id' : user_id,
                'restrant_id' : keyval,
              },
              cashe: false,
              dataType: "json",
              scriptCharaset: "utf-8",
              timespan: 2000,
            }).done(function (data) {
                $('#box' + i + ' input[name="favorite_id"]').val(data.data['id']);
                button.removeClass('heart_off');
                button.addClass('heart_on'); 
            }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
              alert(XMLHttpRequest + " " + textStatus + errorThrown) ;
            });

            break;
          }
        }
      }
    }
    
    $.removeCookie(KEY); 
  }
});

$('select[name="area_id"]').change(function () {
  displayBox();
});

$('select[name="genre_id"]').change(function () {
  displayBox();
});

$('input[name="word"]').keyup(function () {
  displayBox();
});

$('.heart').click(function () {
  var button = $(this);
  $(this).prop("disabled", true);
  var key = $(this).parent().find('input[name="favorite_id"]');
  var parent = $(this).parent().parent();
  var user_id = parent.find('input[name="user_id"]').val()
  var restrant_id = parent.find('input[name="restrant_id"]').val();
  var flag = button.hasClass('heart_on');

  if (user_id == null || user_id == '') {
    $.removeCookie(KEY); 
    $.cookie(KEY, restrant_id, { expires: 1 });
    window.location.href = "/login";
    return;
  }

  $.ajax({
    type: (flag ? 'DELETE' : 'POST'),
    url: 'api/v1/favorite' + (flag ? '/' + key.val() : ''),
    data: flag ? {} : {
      'user_id' : user_id,
      'restrant_id' : restrant_id,
    },
    cashe: false,
    dataType: "json",
    scriptCharaset: "utf-8",
    timespan: 2000,
  }).done(function (data) {
    if (flag) {
      key.val(0);
      button.removeClass('heart_on');
      button.addClass('heart_off');
    } else {
      key.val(data.data['id']);
      button.removeClass('heart_off');
      button.addClass('heart_on');     
    }
  }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest + " " + textStatus + errorThrown) ;
  });
  $(this).prop("disabled", false);
});

function displayBox() {
  var elements = $('.box');
  var area_id = $('select[name="area_id"]').val();
  var genre_id = $('select[name="genre_id"]').val();
  var word = $('input[name="word"]').val();

  var allnum = 0;

  for (var i = 0; i < elements.length; i ++) {
    var status = selectBox(i, area_id, genre_id, word);
    if (status) {
      $('#box' + i).show();
      allnum++;
    } else {
      $('#box' + i).hide();
    }
  }
}

function selectBox(num, area_id, genre_id, word)
{
  if (area_id != 0) {
    var box_area = $('#box' + num + ' input[name="area_id"]').val();
    if (box_area != area_id) return false;
  }

  if (genre_id != 0) {
    var box_genre = $('#box' + num + ' input[name="genre_id"]').val();
    if (box_genre != genre_id) return false;
  }

  if (word.length > 0) {
    var box_name = $('#box' + num + ' input[name="shop_name"]').val();
    if (box_name.indexOf(word) < 0) return false; 
  }

  return true;
}
