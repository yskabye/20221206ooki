$(function () {
  if ($('input[name="reserve_date"]').text() == ''){
    $('input[name="reserve_date"]').val($('input[name="reserve_date"]').attr('min'));
  }

  $('#err_holiday').hide();

  $('#inp_date').text($('input[name="reserve_date"]').val());

  $('#inp_time').text($('select[name="reserve_time"]').val());

  $('#inp_num').text($('select[name="people_num"]').val() + "人");
});

$('input[name="reserve_date"]').change(function () {
  $('#inp_date').text($('input[name="reserve_date"]').val());

  // Check
  if ($('input[name="holiday"]').val() > 0){
    $('#err_holiday').hide();
    var inpdate = new Date($('input[name="reserve_date"]').val());
    var weekofday = inpdate.getDay();
    weekofday = (weekofday == 0 ? 7 : weekofday);
    var holiday = $('input[name="holiday"]').val();
    if (weekofday == holiday) {
      $('#err_holiday').show();
    }
  }
});

$('select[name="reserve_time"]').change(function() {
  $('#inp_time').text($('select[name="reserve_time"]').val());
});

$('select[name="people_num"]').change(function() {
  $('#inp_num').text($('select[name="people_num"]').val() + "人");
});

$('form').submit(function (e) {
  if ($('#err_holiday').is(":visible")) {
    return e.preventDefault();
  } else {
    return true;
  }
});

