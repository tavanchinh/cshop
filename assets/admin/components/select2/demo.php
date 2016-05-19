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
   <p><input type="hidden" id="demo_select2"  style="width: 200px;"/></p>      
</body>
</html>
<?php
$arrDef = array(array("id" => "1", "text" => "tag 1"),
                  array("id" => "2", "text" => "tag 2")
                  );
$arrDef  = json_encode($arrDef);
$valDef  =  "1,2";
?>
<script type="text/javascript">
   $(document).ready(function(){
      var def_val = '<?=$valDef?>';
      var def_arr = <?=$arrDef?>;
      $("#demo_select2").val(def_val).select2({
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
            var data = def_arr
            callback(data);
        },
      }).on('select2-selecting', function (e) {
        var $select = $(this),
         item = e.choice;
        if (item.isTemp) {
            e.preventDefault();
            var dataPost = {
                "name": $.trim(item.text.replace(' (new tag)', '')),
            };
            $.ajax({
                type: "POST",
                async: false,
                url: "/select22/aja_select2_insert.php",
                data: dataPost,
                dataType: 'json',
                cache: false,
                success: function (done) {
                  console.log(done.id);
                  var data = $select.select2('data');
                  data.push({
                      id: done.id,
                      text: done.text + ' (new tag)'
                  });
                  $select.select2('data', data);                    
                },
                complete: function () {
                    $select.select2('close');
                }
            });
        }
    });
                  
      
   });
</script>

