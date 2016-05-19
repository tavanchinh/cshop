<?php
   class Captcha{
      
      public $session_var = 'captcha';
      public $text_color = '#000000';
      public $background_color = '#ffffff';
      public $line_color = '#ffffff';
      public $width_line = 1;
      public $opacity = 50;
      public $width = 90;
      public $height = 40;
      
      /**
       * Convert Hex Color to RGB
      */
      protected function hex2rgb($hex) {
         $hex = str_replace("#", "", $hex);
      
         if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
         } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
         }
         $rgb = array($r, $g, $b);
         //return implode(",", $rgb); // returns the rgb values separated by commas
         return $rgb; // returns an array with the rgb values
      }
      
      function imagelinethick($image, $x1, $y1, $x2, $y2, $color, $thick = 1){
          /* this way it works well only for orthogonal lines
          imagesetthickness($image, $thick);
          return imageline($image, $x1, $y1, $x2, $y2, $color);
          */
          if ($thick == 1) {
              return imageline($image, $x1, $y1, $x2, $y2, $color);
          }
          $t = $thick / 2 - 0.5;
          if ($x1 == $x2 || $y1 == $y2) {
              return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
          }
          $k = ($y2 - $y1) / ($x2 - $x1); //y = kx + q
          $a = $t / sqrt(1 + pow($k, 2));
          $points = array(
              round($x1 - (1+$k)*$a), round($y1 + (1-$k)*$a),
              round($x1 - (1-$k)*$a), round($y1 - (1+$k)*$a),
              round($x2 + (1+$k)*$a), round($y2 - (1-$k)*$a),
              round($x2 + (1-$k)*$a), round($y2 + (1+$k)*$a),
          );
          imagefilledpolygon($image, $points, 4, $color);
          return imagepolygon($image, $points, 4, $color);
      }  
      
      /**
       * Create image
      */
      public function CreateImage(){
         $strings = '123456789';
         $i = 0;
         $characters = 5;
         $code = '';
         while ($i < $characters)
         { 
             $code .= substr($strings, mt_rand(0, strlen($strings)-1), 1);
             $i++;
         } 
         
         Yii::app()->session[$this->session_var] = $code;
         //generate image
         $arr_text_color = $this->hex2rgb($this->text_color);
         $arr_background_color = $this->hex2rgb($this->background_color);
         $arr_shadow = $this->hex2rgb($this->text_color);
         $alpha = (127/100)*(100-$this->opacity); 
         
         $im = imagecreatetruecolor($this->width, $this->height);
         $foreground = imagecolorallocate($im, $arr_text_color[0], $arr_text_color[1], $arr_text_color[2]);
         $shadow = imagecolorallocatealpha ($im, $arr_shadow[0], $arr_shadow[1], $arr_shadow[2],$alpha);
         
         $background = imagecolorallocate($im, $arr_background_color[0], $arr_background_color[1], $arr_background_color[2]);
         
         imagefilledrectangle($im, 0, 0, 200, 200, $background);
         
         // use your own font!
         $font = Yii::getPathOfAlias('webroot').'/assets/fonts/RobotoCondensed-Regular.ttf';
         
         //draw text:
         //imagettftext($im, 25, 0, 9, 28, $shadow, $font, $code);
         
         $arr_line_color = $this->hex2rgb($this->line_color);
         $line_color = imagecolorallocate($im, $arr_line_color[0], $arr_line_color[1], $arr_line_color[2]);
         $number_line = 20;
         for($i = 1; $i< $number_line;$i++){
            $this->imagelinethick($im,rand(0,$this->width),rand(0,$this->height),rand(0,$this->width),rand(0,$this->height),$line_color,$this->width_line);   
         }
         imagettftext($im, 25, 0, 2, 32, $foreground, $font, $code);     
         
         // prevent client side  caching
         header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
         header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
         header("Cache-Control: no-store, no-cache, must-revalidate");
         header("Cache-Control: post-check=0, pre-check=0", false);
         header("Pragma: no-cache");
         
         //send image to browser
         header ("Content-type: image/png");
         imagepng($im);
         imagedestroy($im);
      }
      
}
?>