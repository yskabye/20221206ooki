$('select[name="image"]').change(function () {
  $('.main__input1-right img').attr('src', '../images/store/' + $('select[name="image"]').val());
});