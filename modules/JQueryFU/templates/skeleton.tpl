{literal}<?php

if(!isset($_GET['hash']) ||  "{/literal}{$key2}{literal}" != $_GET['hash'])
  exit;

class CmsUploadHandler extends UploadHandler
{ 
  function __construct()
  {
    $replace = array(
      {/literal}
      'accept_file_types'   => "{$accept_file_types}",
      'max_number_of_files' => {$max_number_of_files},

      'max_width'           => {$max_width},
      'max_height'          => {$max_height},
      'min_width'           => {$min_width},
      'min_height'          => {$min_height},
      
      'upload_dir'          => '{$root_path}{$dir_path}'.DIRECTORY_SEPARATOR,
      'upload_url'          => '{$root_url}{$dir_url}/',

      'image_versions'      => array(
        'thumbnail'           => array(
          'upload_dir'          => '{$root_path}{$dir_path}'.DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR,
          'upload_url'          => '{$root_url}{$dir_url}/thumbnails/',
          )
        ),
      {literal}
    );
    parent::__construct($replace);

  }

   protected function trim_file_name($name, $type, $index){
      $file_name = parent::trim_file_name($name, $type, $index);
      
      {/literal}{if $clean_name}
      $file_name = $this->jqfu_remove_accents($file_name);

      $file_name = $this->jqfu_clean_filename($file_name);
      {/if}{literal}

      return $file_name;
    }

    {/literal}{if $clean_name}{literal}
    private function jqfu_remove_accents($str, $charset='utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
        
        return $str;
    }

    private function jqfu_clean_filename($str){
       $str = preg_replace('#[^A-za-z0-9\._\-]#', '_', $str);
       return $str;
    }
     {/literal}{/if}{literal}
  
} 
?>{/literal}