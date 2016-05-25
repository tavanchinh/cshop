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

function getInnerTextGridView(table,has_border_row,has_padding_col){
    if(has_border_row){
        style_row = 'style="border-bottom:1px solid #dcdcdc"';
    }else{
        style_row = '';
    }
    
    if(has_padding_col){
        style_col = 'style="padding:'+has_padding_col+'px"';
    }else{
        style_col = '';
    }
    var inner_html = '<tr '+style_row+'>';
    $(table+' thead th').each(function(j,col){
        $td = $(this);
        if(!$td.hasClass('button-column') && !$td.hasClass('skip-export-column')){
            inner_html+= '<td '+style_col+'><strong style="text-align:center">' + $td.text();+ '</strong></td>';    
        }
    });
    inner_html += '</tr>';
    
    //Duyệt qua tất cả các tr của table
    $(table+' tr').each(function(i, row) {  
        $this = $(this);
        if($this.hasClass('odd') || $this.hasClass('even')){
            inner_html += '<tr '+style_row+'>';
            $this.find('td').each(function(j,col){
                $td = $(this);
                if(!$td.hasClass('button-column') && !$td.hasClass('skip-export-column')){
                    //Lấy % do không hiển thị được style CSS lên Excel
                    if($td.find('div.uk-progress').length != 0){
                        inner_html+= '<td '+style_col+'>' + $td.find('div.uk-progress').attr('title') + '</td>';
                    }else{
                        inner_html+= '<td '+style_col+'>' + $td.text() + '</td>';
                    }
                }
            });
            inner_html += '</tr>';
        }
        
    });
    
    return inner_html;
}
function fnExcelReport(table,file_name,header){
    
    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
    tab_text = tab_text + '<x:Name>Sheet</x:Name>';
    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
    tab_text = tab_text + "<table border='1px'>";
    
    if(typeof(header) != 'undefined' && header != ''){
        tab_text += header;
        
    }
    var inner_html = getInnerTextGridView(table,false,false);
    tab_text = tab_text + inner_html;
    tab_text = tab_text + '</table></body></html>';
    
    
    var data_type = 'data:application/vnd.ms-excel';
    
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        if (window.navigator.msSaveBlob) {
            var blob = new Blob([tab_text], {
                type: "application/csv;charset=utf-8;"
            });
            navigator.msSaveBlob(blob, file_name+'.xls');
        }
    } else {
        //console.log(tab_text);return;
        $('#btn_export').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
        $('#btn_export').attr('download', file_name+'.xls');
    }
    
}


function table_to_excel(table,file_name){
    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
    tab_text = tab_text + '<x:Name>Sheet</x:Name>';
    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
    tab_text = tab_text + "<table border='1px'>";
    

    var inner_html = $(table).html();
    tab_text = tab_text + inner_html;
    tab_text = tab_text + '</table></body></html>';
    
    
    var data_type = 'data:application/vnd.ms-excel';
    
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        if (window.navigator.msSaveBlob) {
            var blob = new Blob([tab_text], {
                type: "application/csv;charset=utf-8;"
            });
            navigator.msSaveBlob(blob, file_name+'.xls');
        }
    } else {
        //console.log(tab_text);return;
        $('#btn_export').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
        $('#btn_export').attr('download', file_name+'.xls');
    }
}


function printSelector(elm,title){
    var content = '<table style="border-collapse: collapse;font-size:11px;">';
    content = content + getInnerTextGridView(elm,true,3);
    content += '</table>';
    //content = encodeURIComponent(content);
    var h = screen.height;
    var w = screen.width;
    var printWindow = window.open('', '', 'height='+h+',width='+w);
    printWindow.document.write('<html><head><title>'+title+'</title>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}


function formatNumber(s) {
    if(s == ''){
        return s;
    }
    var n = parseInt(s.replace(/\D/g,''),10);
    var format = n.toLocaleString();
    if(format == 'NaN'){
        return '';
    }else{
        return format;    
    }
    
  
}

function delete_row(obj,url,id){
    
    var $tr = $(obj).parents('tr');
    var succ = function(data){
        $tr.remove();
    }
    data = {'id':id};
    
    var conf = confirm('Bạn có chắc chắn muốn xóa nó ?');
    if(conf){
        handleAjax(url,'POST','',data,succ);    
    }   
}

function toggle_feature(obj,url,id){
    var feature = $(obj).attr('data-feature');
    if(feature == 0){
        $(obj).attr('data-feature',1);
        $(obj).attr('class','material-icons active').text('star');
    }else{
        $(obj).attr('data-feature',0);
        $(obj).attr('class','material-icons').text('star_border');
    }
    var succ = function(data){
        
    }
    data = {'id':id,'feature':feature};
    
    handleAjax(url,'POST','',data,succ);    
}