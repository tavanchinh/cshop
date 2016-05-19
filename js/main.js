$(document).ready(function(){
   var searchValue = "";
   var lastTimeQuery = null;
   var lastQuery = "";
   var timer = null;
   var xTriggered = 0;
   var frirstpos = 0;
   var lastpos = 0;
   var offs = 0;
   function suggesstionFunc() {
	   $.ajax({
		   url: "/suggest",
		   data: {
			   q: $("#keyword").val()
		   }
	   }).done(function(data) {
		   $("#suggestions").html(data).show();
		});

   }
   $('#keyword').blur(function (event) {
	   setTimeout("$('#suggestions').fadeOut(50);", 300);
   });
   $('#keyword').keyup(function (e) {
	   if(e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13) {
		   if ($('#suggestions').css('display') != 'block')
			   return;
		   var allItem = $('#suggestions li a');
		   var activeItem = $('#suggestions li a.active');
		   var totalItem = allItem.size();
		   var firstItem = allItem.eq(0);
		   var lastItem = allItem.eq(totalItem - 1);
		   var idx = allItem.index(activeItem);

		   if (!totalItem) {
			   return;
		   }
		   switch (e.keyCode) {
			   case 38:
				   if (idx == -1) {
					   lastItem.addClass('active');
				   } else {
					   var prevItem = allItem.eq(idx - 1);
					   activeItem.removeClass('active');
					   prevItem.addClass('active');
				   }
				   break;
			   case 40:
				   if (idx == -1) {
					   firstItem.addClass('active');
				   } else if (idx == (totalItem - 1)) {
					   // Item cuoi cung
					   activeItem.removeClass('active');
					   firstItem.addClass('active');
				   } else {
					   var nextItem = allItem.eq(idx + 1);
					   activeItem.removeClass('active');
					   nextItem.addClass('active');
				   }

				   break;
			   case 13:
				   if (idx >= 0 && activeItem.attr('href') != "") {
					   $(location).attr('href', activeItem.attr('href'));
				   } else {
					   return true;
				   }
		   }
		   return false;
	   } else {
		   var timerCallback = function () {
			   suggesstionFunc();
		   };
		   clearTimeout(timer);
		   timer = setTimeout(timerCallback, 200);
	   }

   });
   function msuggesstionFunc() {
	   $.ajax({
		   url: "/suggest",
		   data: {
			   q: $("#mkeyword").val()
		   }
	   }).done(function(data) {
				   $("#msuggestions").html(data).show();
			   });

   }
   $('#mkeyword').keyup(function (e) {
	   if(e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13) {
		   if ($('#msuggestions').css('display') != 'block')
			   return;
		   var allItem = $('#msuggestions li a');
		   var activeItem = $('#msuggestions li a.active');
		   var totalItem = allItem.size();
		   var firstItem = allItem.eq(0);
		   var lastItem = allItem.eq(totalItem - 1);
		   var idx = allItem.index(activeItem);

		   if (!totalItem) {
			   return;
		   }
		   switch (e.keyCode) {
			   case 38:
				   if (idx == -1) {
					   lastItem.addClass('active');
				   } else {
					   var prevItem = allItem.eq(idx - 1);
					   activeItem.removeClass('active');
					   prevItem.addClass('active');
				   }
				   break;
			   case 40:
				   if (idx == -1) {
					   firstItem.addClass('active');
				   } else if (idx == (totalItem - 1)) {
					   // Item cuoi cung
					   activeItem.removeClass('active');
					   firstItem.addClass('active');
				   } else {
					   var nextItem = allItem.eq(idx + 1);
					   activeItem.removeClass('active');
					   nextItem.addClass('active');
				   }

				   break;
			   case 13:
				   if (idx >= 0 && activeItem.attr('href') != "") {
					   $(location).attr('href', activeItem.attr('href'));
				   } else {
					   return true;
				   }
		   }
		   return false;
	   } else {
		   var timerCallback = function () {
			   msuggesstionFunc();
		   };
		   clearTimeout(timer);
		   timer = setTimeout(timerCallback, 200);
	   }

   });
});