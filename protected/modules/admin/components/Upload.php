<?php
   
   class Upload{
      
      private $CUploadedFile;     
      public function __construct($CUploadedFile){      
         $this->CUploadedFile = $CUploadedFile;
      }
      
      /**
       * Move file and return name file
       * @param string $path_to_upload
      */
      
      public function save($path_to_upload){
         $type = $this->CUploadedFile->type;
         $fileName = date('YmdHis',time());
         switch($type){
            case 'image/jpeg':
               $fileName .= '.jpg';
               break;
            case 'image/png':
               $fileName .= '.png';
               break;
            case 'image/gif':
               $fileName .= '.gif';
               break;
            default:
               $fileName .= '.jpg'; 
         }
         $this->CUploadedFile->saveAs($path_to_upload.'/'.$fileName);
         return $fileName;
      }
         
   }
?>