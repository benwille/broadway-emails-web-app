$('input[type=number').each(function(){
  if ($(this)[0].value == 0) {
    $(this)[0].value = '';
  }
});
