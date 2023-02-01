$('button[name="items__list-card-btn-save"]').click(function () {
  var topitem = $(this).parent().parent();
  var key = topitem.find('input[name="reserve_id"]').val();

  $.ajax({
    type: "post",
    url: "api/v1/review",
    data: {
      'reserve_id': Number(key),
      'values' : $(topitem.find('input[name="values"]')).val(),
      'comment': $(topitem.find('textarea[name="comment"]')).val(),
    },
    cashe: false,
    dataType: "json",
    scriptCharaset: "utf-8",
    timespan: 1000,
  }).done(function (data) {
    topitem.find('.items__list-card-btn').hide();
    var comment = $(topitem.find('textarea[name="comment"]')).val();
    var html = topitem.find('.items__list-card-lne3').html();
    html = html.replace('textarea name="comment" maxlength="255"', 'p class="items__list-card-lne3-comment"');
    html = html.replace('/textarea', '/p');
    html = html.replace('><', '>' + comment + '<');
    topitem.find('.items__list-card-lne3').html(html);
  }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest + " " + textStatus + errorThrown) ;
  });

});

$('button[name="items__list-card-btn-norec"]').click(function () {
  var topitem = $(this).parent().parent();
  var key = topitem.find('input[name="reserve_id"]').val();

  $.ajax({
    type: "post",
    url: "api/v1/review",
    data: {
      'reserve_id': Number(key),
      'values'  : null,
      'comment' : null,
    },
    cashe: false,
    dataType: "json",
    scriptCharaset: "utf-8",
    timespan: 1000,
  }).done(function (data) {
    topitem.find('.items__list-card-btn').hide();

    topitem.find('input[name="values"]').val(0);
    for (var i = 1; i < 6; i++){
      topitem.find('img[level=' + i + ']').attr("src", "images/staroff.svg");
    }

    var html = topitem.find('.items__list-card-lne3').html();
    html = html.replace('textarea name="comment" maxlength="255"', 'p class="items__list-card-lne3-comment"');
    html = html.replace('/textarea', '/p');
    topitem.find('.items__list-card-lne3').html(html);
  }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest + " " + textStatus + errorThrown) ;
  });

});

$('.items__list-card-lne2-star-img').click(function () {
  var value = $(this).attr('level');
  var upitem = $(this).parent().parent();
  var topitem = upitem.parent();

  var button = topitem.find('.items__list-card-btn');
  if (button.length == 0)
    return;
  else if (!button.is(":visible"))
    return;

  $('input[name="values"]').val(value);
  
  var num = 0;
  
  for (var i = 0; i < Number(value); i++){
    num = i + 1;
    upitem.find('img[level=' + num + ']').attr("src", "images/staron.svg");
  }
  for (var i = Number(value); i < 5; i++){
    num = i + 1;
    upitem.find('img[level=' + num + ']').attr("src", "images/staroff.svg");
  }
});
