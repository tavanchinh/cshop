<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   
   <title>jQuery Tokeninput</title>
   
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>  
   
   <script type="text/javascript" src="/select22/select2.js"></script>
   <link rel="stylesheet" href="/select22/select2.css" type="text/css" />   
</head>

<body>
   <p>
      <input type="hidden" id="demo_select2" style="width: 200px;" />
   </p> 
   <div class="demo_select2_log">
   </div>     
</body>
</html>
<script type="text/javascript">
   $(document).ready(function(){
      var $eventLog = $(".demo_select2_log");
      var $eventSelect = $("#demo_select2");
      
      $eventSelect.on("select2:open", function (e) { log("select2:open", e); });
      $eventSelect.on("select2:close", function (e) { log("select2:close", e); });
      $eventSelect.on("select2:select", function (e) { log("select2:select", e); });
      $eventSelect.on("select2:unselect", function (e) { log("select2:unselect", e); });
      
      $eventSelect.on("change", function (e) { log("change"); });
      
      function log (name, evt) {
        if (!evt) {
          var args = "{}";
        } else {
          var args = JSON.stringify(evt.params, function (key, value) {
            if (value && value.nodeName) return "[DOM node]";
            if (value instanceof $.Event) return "[$.Event]";
            return value;
          });
        }
        var $e = $("<li>" + name + " -> " + args + "</li>");
        $eventLog.append($e);
        $e.animate({ opacity: 1 }, 10000, 'linear', function () {
          $e.animate({ opacity: 0 }, 2000, 'linear', function () {
            $e.remove();
          });
        });
      }

      $("#demo_select2").val(1).select2({
         multiple: true,
         placeholder: "Please enter tags",
         tokenSeparators: [','],
         createSearchChoice: function (term, data) {
            return { id: '_TEMP_', text: term + ' (new tag)', isTemp: true };
         },
         ajax:{
           url: "/select22/aja_select2.php",
           dataType: "json",
           type: "POST",
           data: function (term, page) {
               return {
                 key_word: term,
               };
           },
           results: function (data, page) {
               lastResults = data.results;
               return {
                 results: data
               };
               
           }
         },
         initSelection: function (element, callback) {
            var data = [{id:1,text:'Tags 1'}]
            callback(data);
        },
      }).on('select2-selecting',function(e){
         var __this = $(this);
         var item = e.choise;
         console.log(item);
         /**
         if (item.isTemp) {
            e.preventDefault();
            var dataPost = {
                "name": $.trim(item.text.replace(' (new tag)', '')),
            };
         }
         **/
      });
   });
</script>

