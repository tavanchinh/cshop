<?php
   
/**
 * class string
 * 
 * @author CTB
 * @since 8/11/2013
*/

class Str{
   
   /**
    * Default contrucstor
    * 
    * @param string
   */
   public function __construct($string = null){
   }
   
   /**
    * 
    * Remove HTMT to Text
    * @param String HTML
    * @param Tags allow
   */
   static public function removeHTML($string,$allowTags = null){
      if(!self::isHTML($string)){
         return $string;
      }else{
         if($allowTags != null){
            $string = strip_tags($string,$allowTags);
         }else{
            $string = strip_tags($string);
         }
         return $string;
      }
   }
   
   public static function removeSpecialChar($str){
      return  preg_replace('~[^a-zA-Z0-9 ]+~', '', $str);
   }
   
   public static function removeTitle($string,$keyReplace = "-"){
		$string =  str_replace(" ",$keyReplace,$string);
		$string = str_replace("--",$keyReplace,$string);
		return strtolower($string);
	}
   
   /**
    * Calculate the similarity between two strings
    * 
    * @param String first
    * @param String seconds
    * @return int percen similar bettewn two strings
   */
   static public function similarText($firstString,$secondString){
      $firstString    = trim($firstString);
      $secondString  = trim($secondString);
      if($firstString == '' && $secondString == ''){
         return 0;
      }
      if(($firstString != '' && $secondString == '') || ($firstString == '' && $secondString != '')){
         return 0;
      }else{
         similar_text($firstString,$secondString,$percen);
         return number_format($percen,0);
      }
   }
   /**
    * Validate email
   */
   public static function validateEmail($email){ 
      // Set up regular expression strings to evaluate the value of email variable against
      $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
      // Run the preg_match() function on regex against the email address
      if (preg_match($regex, $email)) {
         return true;
      } else { 
         return false; 
      } 
   }
   
   public static function mb_ucwords($str){
      $str = mb_strtolower($str,"UTF-8");
      $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");  
      return ($str); 
   }
   /**
    * Calculate the similarity between two keyword search
    * 
    * @param String first
    * @param String seconds
    * @return int percen similar bettewn two keyword search
   */
   static public function similarKeyword($firstKeyword,$secondKeyword){
      $firstKeyword    = $this->convertUTF8($firstKeyword);
      $firstKeyword    = $this->removeWhitespace($firstKeyword);
      $firstKeyword    = strtolower($firstKeyword);  
      $secondKeyword  = $this->convertUTF8($secondKeyword);
      $secondKeyword  = $this->removeWhitespace($secondKeyword);
      $secondKeyword  = strtolower($secondKeyword);
      if($firstKeyword == '' && $secondKeyword == ''){
         return 0;
      }
      if(($firstKeyword != '' && $secondKeyword == '') || ($firstKeyword == '' && $secondKeyword != '')){
         return 0;
      }else{
         similar_text($firstKeyword,$secondKeyword,$percen);
         return number_format($percen,0);
      }
   }
   
   /**
    * Convert UTF-8 to ASCII
    * 
    * @param String utf-8
    * @return String ascii
    * 
   */
   static public function convertUTF8($str) {
   	if(!$str) return false;
   	$utf8 = array(
               'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
               'd'=>'đ|Đ',
               'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
               'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
               'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
               'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
               'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
   			);
   	foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
      return $str;
   }
   
   /**
    * 
    * Remove whitespace string
    * @param String
    * @return String not contain whitespace
   */
   static public function removeWhitespace($string){
      if(!$string)
         return false;
      else{
         $string = trim($string);
         $string = str_replace(' ','',$string);
         return $string;
      }
   }
   
   /**
    * Remove MySql Injection
    * 
    * @param string
    * @return string
   */
   static public function removeInjection($string){
      if(get_magic_quotes_gpc()){
         return mysql_real_escape_string(stripslashes($string));
      }else{
         return mysql_real_escape_string($string);
      } 
   }
   
   
   /**
    * Check is HTML
    * 
    * @param string
    * @return bool. If is html return true else return false
   */
   
   static protected function isHTML($string){
      return preg_match("/<[^<]+>/",$string) != 0;
   }
   
   /**
    * 
    * Format number
    * @param int 
    * @return string 
   */
   static function formatNumber($number,$type = 0,$decimals = 0,$des_point = ',', $thousands_sep = '.'){
      if($number > 999 && $type == 1){
         return round($number/1000,1) . 'k';
      }else{
         return number_format($number,$decimals,$des_point,$thousands_sep);   
      }
   }
   
   /**
    * 
    * Cut string 
    * @param string 
    * @param int limit char
    * @param string end char
   */
   
   static public function cutString($str, $length, $char=" ..."){
   	//Nếu chuỗi cần cắt nhỏ hơn $length thì return luôn
   	$strlen	= mb_strlen($str, "UTF-8");
   	if($strlen <= $length) return $str;
   
   	//Cắt chiều dài chuỗi $str tới đoạn cần lấy
   	$substr	= mb_substr($str, 0, $length, "UTF-8");
   	if(mb_substr($str, $length, 1, "UTF-8") == " ") return $substr . $char;
   
   	//Xác định dấu " " cuối cùng trong chuỗi $substr vừa cắt
   	$strPoint= mb_strrpos($substr, " ", "UTF-8");
   
   	//Return string
   	if($strPoint < $length - 20) return $substr . $char;
   	else return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
   }
   
   /**
    * 
    * Encode id
    * @param int
    * @return string encoded
   */
   static public function IDEncode($id){
      $id = $id + 2830991;
      return dechex($id);
   }
   
   /**
    * 
    * Decode id
    * @param string
    * @return string decoded
   */
   static public function IDDecode($str){
      $str = hexdec($str);
      return $str - 2830991;
   }
   public static function formatDuration($seconds) {
      $t = round($seconds);
      $h = floor($t/3600);
      $m = $t/60%60;
      $s = $t%60;
      if($h == 0 && $m != 0){
         $m = ($m < 10) ? '0'.$m : $m;
         $s = ($s < 10) ? '0'.$s : $s;
         return $m . ":" . $s;
      }elseif($h == 0 && $m == 0){
         $s = ($s < 10) ? '0'.$s : $s;
         return $s;
      }else{
         $h = ($h < 10) ? '0'.$h : $h;
         $m = ($m < 10) ? '0'.$m : $m;
         $s = ($s < 10) ? '0'.$s : $s;
         return $h . ":" . $m . ":" . $s;
      }
   }
   
   public static function notificationBox($type,$content,$title){
      return '<div class="notification-box '.$type.'-box ">
               <div class="ic-notifi info"></div>
               <p class="title">'.$title.'</p>
               <div>'.$content.'</div>
            </div>';
   }
   
   //Remove UTF8 Bom
   public static function remove_utf8_bom($text)
   {
       $bom = pack('H*','EFBBBF');
       $text = preg_replace("/^$bom/", '', $text);
       return $text;
   }
   
   public static function check_start_charecter($string){
      $string = trim($string);
      $string = self::remove_utf8_bom($string);
      
      if($string =='' || $string == '1'){
         return false;
      }
      $str_start = substr($string,0,1);
      //Nếu bắt đầu bằng 1 ký tự số
	  if(is_numeric($str_start)){
		 //Nếu độ dài < 4 thì coi đó là thứ tự khoảng sub
		 if(strlen($string) <= 4){
			return false;
		 }else{ // Ngược lại phải kiểm tra xem đó là time hay subtitle
         
			if(strpos($string,'-->')){
            return false;
			}else{
            return true;
            
			}
		 }		
         return false;
      }else{
         return true;
      }
  }

  /**
   * Ma hoa file bang thuat toan aes_128
   * @param  string  $file            duong dan full
   * @param  boolean $create_new_file Neu = true se tao file moi, neu = false se ghi de file
   * @return void                   
   */
  public static function encode_aes_file($file,$create_new_file = false){
      $exp = explode('/',$file);
      $file_name = end($exp);
      if($create_new_file){
        $exp2 = explode('.',$file);
        $ext = end($exp2);
        $exp[count($exp)-1] = md5($file).'.'.$ext;
        $new_file = implode('/',$exp);  
      }else{
        $new_file = $file;
      }
      
      
      $handle = @fopen($file, "r");
      $content = 'Encrypted'."\n";
      if ($handle) {
          while (($buffer = fgets($handle, 4096)) !== false) {
              if(self::check_start_charecter($buffer)){
                  $content .= GibberishAES::enc($buffer,$file_name);
                  $content .= "\n";
              }else{
                  $content .= $buffer;
              }
          }
          if (!feof($handle)) {
              echo "Error: unexpected fgets() fail\n";
          }
          fclose($handle);
      }
      file_put_contents($new_file,$content);
   }

   /**
    * Doc noi dung cua file da duoc ma hoa
    * @param string $file Full path
    * @param string $key
    * @return string
   */
   public static function read_file_and_decode($file,$key = ''){
      if($key == ''){
         $exp = explode('/',$file);
         $key = end($exp);
      }
      $handle = @fopen($file, "r");
      $content = '';
      if ($handle) {
          while (($buffer = fgets($handle, 4096)) !== false) {
              if(self::check_start_charecter($buffer)){
                  //echo $buffer;die;
                  $content .= GibberishAES::dec($buffer,$key);
                  $content .= "\n";
              }else{
                  $content .= $buffer;
              }
          }
          if (!feof($handle)) {
              echo "Error: unexpected fgets() fail\n";
          }
          fclose($handle);
      }
      return $content;
   }
   
    public static function clear_keyword($keyword){
        $arr_search = array('"','\\');
        $keyword = str_replace($arr_search,'',$keyword);
        return trim($keyword);
    }
}
   
?>