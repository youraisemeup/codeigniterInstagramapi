<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use OneFileManager\Connector;
class file_manager extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
//        $this->load->model(get_class($this) . '_model', 'model');
//        permission_view();
    }

    public function index()
    {
        $connector_options = [
            "host" => DB_HOST,
            "database" => DB_NAME,
            "username" => DB_USER,
            "password" => DB_PASS,
            "charset" => 'utf8',
            "table_name" => 'files',
            "opions" => array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ),

            "user_id" => session('uid')
        ];

        $homepath = dirname(__FILE__);
//        $Connector = new OneFileManager\Connector();
//        echo"hello";


        $new_home = str_replace('app/modules/file_manager/controllers','',$homepath);

//        echo $new_home.'libraries/OneFileManager/Connector.php';

        require($new_home.'app/libraries/OneFileManager/Connector.php');
        require($new_home.'app/libraries/OneFileManager/FileManager.php');

        $Connector = new OneFileManager\Connector;
//        print_r($Connector);
        $Connector->setOptions($connector_options)->init();

//
//echo "1213";
//        die();
        /**
         * File manager configurations
         */
//        echo"hello";
        $path_to_users_directory = $new_home."assets/uploads/"
            . session('uid')
            . "/";
//        echo$path_to_users_directory;
        if (!file_exists($path_to_users_directory)) {
            mkdir($path_to_users_directory);
//            echo "no";
        }
//        echo$path_to_users_directory;
//echo"yes";

//        $user_dir_url = BASE."/assets/uploads/"
//            . session('uid')
//            . "/";
        $user_dir_url = BASE."assets/uploads/"
            . session('uid')
            . "/";
//echo $user_dir_url;
        $options = [
            "path" => $path_to_users_directory,
            "url" => $user_dir_url,

            "allow" => array("jpeg", "jpg", "png", "mp4"),
            "queue_size" => 10
        ];
//echo"1524";
//        if ($AuthUser->get("settings.storage.file") >= 0) {
//            $options["max_file_size"] = (double)$AuthUser->get("settings.storage.file") * 1024*1024;
//        }
//
//        if ($AuthUser->get("settings.storage.total") >= 0) {
//            $options["max_storage_size"] = (double)$AuthUser->get("settings.storage.total") * 1024*1024;
//        }


        $FileManager = new OneFileManager\FileManager;
        $FileManager->setOptions($options)
            ->setConnector($Connector)
            ->run();
    }

}