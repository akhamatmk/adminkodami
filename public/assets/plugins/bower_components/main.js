$(function() {
	$(".date").datepicker({
       dateFormat: 'yy-mm-dd',
       minDate: 0,
   });

	$('.money').maskMoney();
	
});