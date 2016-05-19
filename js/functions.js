/*-- Handle Ajax --*/
function handleAjax(url,method,dataType,data,success,beforesend,error){
   if(url != ''){
      if (typeof(method) == 'undefined'){
         method = 'POST'
      }
      if(typeof(beforesend) == 'undefined'){
         beforesend = function(){};
      }
      if(typeof(error) == 'undefined'){
         error = function(){};
      }
      if(typeof(success) == 'undefined'){
         success = function(){};
      }
      $.ajax({
         url:url,
         type:method,
         dataType: dataType,
         data:data,
         beforeSend: beforesend,
         success:success,
         error:error, 
         
      });  
   }
}

function formatNumber(s) {
   if(s == ''){
      return s;
   }
   var n = parseInt(s.replace(/\D/g,''),10);
   var format = n.toLocaleString();
   return format;
}
function NewCaptcha(elm){
   new_captcha = '/captcha?' + Math.random();
   $(elm).attr('src',new_captcha);
}
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}