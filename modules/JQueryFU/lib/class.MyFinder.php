<?php


class MyFinder
{
    private $key1 = "a6ze8ehy84jr684r68ytsdf687sbdfbthrethbpppd";
    private $key2 = "fzjrkr85zerg435rv8rez315ver83v34qer38qer4v";
    private $tmp_path;

    function __construct($tmp_path)
    {
      $this->tmp_path = $tmp_path;
      if(!is_dir($this->tmp_path.'JQueryFU'))
      {
        mkdir($this->tmp_path.'JQueryFU');
      }
      if(!file_exists($this->tmp_path.'JQueryFU'.DIRECTORY_SEPARATOR.'index.html'))
      {
        $handle = fopen($this->tmp_path.'JQueryFU'.DIRECTORY_SEPARATOR.'index.html', 'w');
        if($handle !== FALSE)
          fclose($handle);
      }
    }

    function getName($parameters) {
      return md5($this->key1.serialize($parameters));
    }
    function getHash($parameters) {
      return md5($this->key2.serialize($parameters));
    }
    function makeTheFile(CMSModule $module, $config, $parameters){
      $name = $this->getName($parameters);
      $hash = $this->getHash($parameters);

      if(!file_exists($this->tmp_path.'JQueryFU'.DIRECTORY_SEPARATOR.$name.'.php')) {

        $handle = fopen($this->tmp_path.'JQueryFU'.DIRECTORY_SEPARATOR.$name.'.php', 'w');
        if($handle === FALSE) {
          echo "<h3>Error during the creation of Skeleton class</h3>";
          exit;
        }
        $module->smarty->assign("key2",$hash);


        //List of file type accepted (regex). By default : images file only
        $this->assignParam($module->smarty, $parameters, "accept_file_types", '/\.(txt|gif|jpe?g|png)$/i');

        // The maximum number of files for the upload directory: (number)
        $this->assignParam($module->smarty, $parameters, "max_number_of_files","null");

        //Min/Max width/height of the Image resolution (number)
        $this->assignParam($module->smarty, $parameters, "max_width", "null");
        $this->assignParam($module->smarty, $parameters, "max_height", "null");
        $this->assignParam($module->smarty, $parameters, "min_width", "1");
        $this->assignParam($module->smarty, $parameters, "min_height", "1");

        //Remove accents and special caracters from the name of the file
        $this->assignParam($module->smarty, $parameters, "clean_name", "true");

        //Default directory for the uploads
        $this->assignParam($module->smarty, $parameters, "dir_path", DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'jqueryfu');
        $this->assignParam($module->smarty, $parameters, "dir_url", "/uploads/jqueryfu");

        if(isset($parameters['dir_path'])){
          $value_dir_path = $parameters['dir_path'];
        } else {
          $value_dir_path = DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'jqueryfu';
        }
        $module->smarty->assign('dir_path',$value_dir_path);

        if(isset($parameters['dir_url'])){
          $value_dir_url = $parameters['dir_url'];
        } else {
          $value_dir_url = "/uploads/jqueryfu";
        }
        $module->smarty->assign('dir_url',$value_dir_url);

        //Defult root path/url
        if(isset($parameters['root_path'])){
          $value_root_path = $parameters['root_path'];
        } else {
          $value_root_path = $config['root_path'];
        }
        $module->smarty->assign('root_path',$value_root_path);

        if(isset($parameters['root_url'])){
          $value_root_url = $parameters['root_url'];
        } else {
          $value_root_url = $config['root_url'];
        }
        $module->smarty->assign('root_url',$value_root_url);

        $module->smarty->assign('DIRECTORY_SEPARATOR', DIRECTORY_SEPARATOR);

        //$this->createFolders($value_root_path.$value_dir_path);
        $this->createFolders($value_root_path.$value_dir_path.DIRECTORY_SEPARATOR.'thumbnails');

        fwrite ($handle , $module->ProcessTemplate('skeleton.tpl'));
        fclose($handle);
      }

      return array($name, $hash);
    }

    function assignParam($smarty, $parameters, $param_name, $default = null)
    {

      if(isset($parameters[$param_name])){
        $value = $parameters[$param_name];
      } else {
        $value = $default;
      }

      $smarty->assign($param_name,$value);
    }

    function createFolders($dir){
      if(is_dir($dir))
        return;

      mkdir($dir, 0755, true);


    }


}

?>