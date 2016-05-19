(function($){
 	$.fn.extend({ 
 		
		// truyền biến options vào hàm
 		ajaxupload: function(options) {

			// Đặt các giá trị mặc định, sử dụng dấu phẩy để chia từng giá trị
			var defaults = {
				urlUpload: "#"
			}

			var options =  $.extend(defaults, options);
         
    		return this.each(function() {
				var opts = options;
				$(this).change(function(){
		  		   var $this = $(this)
               var files = $this.prop('files'); 
               var form_data = new FormData();
               form_data.append("watermarks",opts.watermarks);          
               for (index = 0; index < files.length; ++index) {
                  var $input = $("#general-input-"+index);
                  form_data.append('file[]', files[index]);
                  $this.parents(".item-upload").find("div.preview").css("background-image","url(/images/loading.gif)");
                  $this.parents(".item-upload").find("div.preview").css("background-size","inherit");
               }
               
               var success_function = function(result){
                  images = result.image;
                  errors = result.error;
                  if(errors.length > 0){
                     var mes = '';
                     for(i = 0; i < errors.length; ++i){
                        mes += errors[i] + '\n';
                     }
                     alert(mes);
                     $this.parents(".item-upload").find("div.preview").css("background-image","none");
                  }else{
                     var start_number = parseInt($this.attr('stt'));
                     for(i = 0; i < images.length; ++i){
                        start_number += parseInt(i);         
                        var $input = $("#general-input-"+start_number);
                        $input.parents(".item-upload").find("div.preview").css("background-image","url(" + result.path+images[i] + ")");
                        $input.parents(".item-upload").find("div.preview").css("background-size","100%");
                        $input.parents(".item-upload").find(".hidden-input").val(images[i]);
                        $input.attr('disabled','disabled');
                        $input.parents(".item-upload").append('<i class="fa fa-times-circle"></i>');           
                     }
                  }
                  
                  
                  
               }
               var before_function = function(){
                  $input.parents(".item-upload").find("div.preview").css("background-image","url(/images/loading.gif)");
                  $input.parents(".item-upload").find("div.preview").css("background-size","inherit");
               }
               $.ajax({
                  url: opts.urlUpload, 
                  dataType: 'json',  
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,                         
                  type: 'post',
                  success: success_function,
                  /*
                  success: function(php_script_response){
                    alert(php_script_response); // display response from the PHP script, if any
                  }
                  */
               });
               
                    
				})
				//Thêm mã xử lý ở đây
				
			
    		});
    	}
	});
	
})(jQuery);