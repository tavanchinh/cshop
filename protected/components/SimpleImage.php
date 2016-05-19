<?php

class SimpleImage
{

    var $image;
    var $image_type;
    public $folder_upload = 'uploads';
    function load($filename)
    {
        $file = explode('.', $filename);
        $ext = end($file);

        if (!file_exists($filename) || $ext == 'jpeg')
        {
            $filename = Yii::getPathOfAlias('webroot') . '/images/logo.png';
            //var_dump($filename);die();
        }
        $file_content = file_get_contents($filename);
        if ($file_content)
        {
            //echo $filename;die();
            $image_info = getimagesize($filename);
            $this->image_type = $image_info[2];
            if ($this->image_type == IMAGETYPE_JPEG)
            {

                $this->image = imagecreatefromjpeg($filename);
            } elseif ($this->image_type == IMAGETYPE_GIF)
            {

                $this->image = imagecreatefromgif($filename);
            } elseif ($this->image_type == IMAGETYPE_PNG)
            {

                $this->image = imagecreatefrompng($filename);
            }
        }

    }
    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 90, $permissions = null)
    {
        if ($this->image != null)
        {
            if ($image_type == IMAGETYPE_JPEG)
            {
                imagejpeg($this->image, $filename, $compression);
            } elseif ($image_type == IMAGETYPE_GIF)
            {

                imagegif($this->image, $filename);
            } elseif ($image_type == IMAGETYPE_PNG)
            {

                imagepng($this->image, $filename);
            }
            if ($permissions != null)
            {

                chmod($filename, $permissions);
            }
        }

    }
    function output($image_type = IMAGETYPE_JPEG)
    {

        if ($image_type == IMAGETYPE_JPEG)
        {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF)
        {

            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG)
        {

            imagepng($this->image);
        }
    }
    function getWidth()
    {
        if ($this->image != null)
            return imagesx($this->image);
    }
    function getHeight()
    {
        if ($this->image != null)
            return imagesy($this->image);
    }
    function resizeToHeight($height)
    {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width)
    {
        if ($this->getWidth() > 0)
        {
            $ratio = $width / $this->getWidth();
            $height = $this->getheight() * $ratio;
            $this->resize($width, $height);
        }

    }

    function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->
            getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    /**
     * Resize and fill background white
     */
    function resize_and_fill_background($source_image, $destination, $tn_w, $tn_h, $quality =
        100, $wmsource = false)
    {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);

        #assuming the mime type is correct
        switch ($imgtype)
        {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                die('Invalid image type.');
        }

        #Figure out the dimensions of the image and the dimensions of the desired thumbnail
        $src_w = imagesx($source);
        $src_h = imagesy($source);


        #Do some math to figure out which way we'll need to crop the image
        #to get it proportional to the new size, then crop or adjust as needed

        $x_ratio = $tn_w / $src_w;
        $y_ratio = $tn_h / $src_h;

        if (($src_w <= $tn_w) && ($src_h <= $tn_h))
        {
            $new_w = $src_w;
            $new_h = $src_h;
        } elseif (($x_ratio * $src_h) < $tn_h)
        {
            $new_h = ceil($x_ratio * $src_h);
            $new_w = $tn_w;
        } else
        {
            $new_w = ceil($y_ratio * $src_w);
            $new_h = $tn_h;
        }

        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        $final = imagecreatetruecolor($tn_w, $tn_h);
        $backgroundColor = imagecolorallocate($final, 255, 255, 255);
        imagefill($final, 0, 0, $backgroundColor);
        //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
        imagecopy($final, $newpic, (($tn_w - $new_w) / 2), (($tn_h - $new_h) / 2), 0, 0,
            $new_w, $new_h);

        #if we need to add a watermark
        if ($wmsource)
        {
            #find out what type of image the watermark is
            $info = getimagesize($wmsource);
            $imgtype = image_type_to_mime_type($info[2]);

            #assuming the mime type is correct
            switch ($imgtype)
            {
                case 'image/jpeg':
                    $watermark = imagecreatefromjpeg($wmsource);
                    break;
                case 'image/gif':
                    $watermark = imagecreatefromgif($wmsource);
                    break;
                case 'image/png':
                    $watermark = imagecreatefrompng($wmsource);
                    break;
                default:
                    die('Invalid watermark type.');
            }

            #if we're adding a watermark, figure out the size of the watermark
            #and then place the watermark image on the bottom right of the image
            $wm_w = imagesx($watermark);
            $wm_h = imagesy($watermark);
            imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);

        }
        if (imagejpeg($final, $destination, $quality))
        {
            return true;
        }
        return false;
    }

    public static function addWaterMarks($image, $compression = 90)
    {
        $info = getimagesize($image);
        $imgtype = image_type_to_mime_type($info[2]);
        $wmsource = Yii::getPathOfAlias('webroot') . '/images/watermarks.png';
        $watermark = imagecreatefrompng($wmsource);

        $imgtype = image_type_to_mime_type($info[2]);

        #assuming the mime type is correct
        switch ($imgtype)
        {
            case 'image/jpeg':
                $im = imagecreatefromjpeg($image);
                break;
            case 'image/gif':
                $im = imagecreatefromgif($image);
                break;
            case 'image/png':
                $im = imagecreatefrompng($image);
                break;
            default:
                die('Invalid image type.');
        }
        $wm_w = imagesx($watermark);
        $wm_h = imagesy($watermark);
        $marge_right = 10;
        $marge_bottom = 10;
        $marge_top = 10;
        imagecopy($im, $watermark, imagesx($im) - $wm_w - $marge_right, $marge_top, 0, 0,
            $wm_w, $wm_h);

        switch ($imgtype)
        {
            case 'image/jpeg':
                imagejpeg($im, $image, $compression);
                break;
            case 'image/gif':
                imagegif($im, $image, $compression);
                break;
            case 'image/png':
                imagepng($im, $image, $compression);
                break;
        }
        return $image;

    }


    /**
     * Get path save image by name
     * @param string image_name
     * @return string path_image
     */
    public function getFullPathImageByName($image_name)
    {
        $prefix = '/' . $this->folder_upload . '/';
        $default = '/images/df_image.png';
        $explode = explode('-', $image_name);
        if (count($explode) > 0)
        {
            $last_elm = end($explode);
            $explode = explode(".", $last_elm);
            $date_folder = substr($explode[0], 0, 4) . "/" . substr($explode[0], 4, 2) . '/';
            return $prefix . $date_folder . $image_name;
        } else
        {
            return $default;
        }
    }

    /**
     * Lay duong dan anh dua vao ten anh
     */
    public function getOnlyPathImageByName($image_name)
    {
        $prefix = '/' . $this->folder_upload . '/';
        $explode = explode('-', $image_name);
        if (count($explode) > 0)
        {
            $last_elm = end($explode);
            $explode = explode(".", $last_elm);
            $date_folder = substr($explode[0], 0, 4) . "/" . substr($explode[0], 4, 2) . '/';
            return $prefix . $date_folder;
        } else
        {
            return null;
        }
    }

    /**
     * Tao thumbnail cho anh
     */
    public function makeThumbnail($file_name, $sizes = array('380'))
    {
        if (strpos($file_name, 'http://') === false)
        {
            $source_file = Yii::getPathOfAlias('webroot') . $this->getFullPathImageByName($file_name);
            //echo $source_file;die();
            foreach ($sizes as $width)
            {
                $this->load($source_file);
                $this->resizeToWidth($width);
                $path_to_save = Yii::getPathOfAlias('webroot') . $this->getOnlyPathImageByName($file_name) .
                    $width;
                if (!is_dir($path_to_save))
                {
                    mkdir($path_to_save, 0777, true);
                    chmod($path_to_save, 0777);
                }

                $this->save($path_to_save . '/' . $file_name);
            }
        }
    }

    /**
     * Get thumbnail
     */
    public function getThumbnail($file_name, $size = 380)
    {
        $default = Yii::app()->request->baseUrl . '/images/default.jpg';
        if ($file_name == '')
        {
            return $default;
        }
        if (strpos($file_name, 'http://') !== false)
        {
            return $file_name;
        }
        $folder = $this->getOnlyPathImageByName($file_name);

        $relative_image = $folder . $size . '/' . $file_name;
        $file = Yii::getPathOfAlias('webroot') . $relative_image;
        if (file_exists($file))
        {
            //return 'http://media.bilutv.com'.$relative_image;
            return $relative_image;            
        } else
        {
            $this->makeThumbnail($file_name, array($size));
            if (file_exists($file))
            {
                //return 'http://media.bilutv.com'.$relative_image;
                return $relative_image;                                
            } else
            {
                return $default;
            }
        }
    }

    /**
     * Ham lay anh goc
     * @param string filename
     */

    public function getOriginalImage($file_name)
    {
        $folder = $this->getOnlyPathImageByName($file_name);
        return $folder . $file_name;
    }
    
    
    /**
     * Convert string base64 to jpeg image
    */
    function base64_to_jpeg($base64_string, $output_file)
    {
        $ifp = fopen($output_file, "wb");
        fwrite($ifp, base64_decode($base64_string));
        fclose($ifp);
        return $output_file;
    }


    public static function model()
    {
        $simple_image = new SimpleImage;
        return $simple_image;
    }

}

?>