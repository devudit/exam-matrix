<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImportExport
 *
 * @author Emerico
 */
namespace ExamMatrix;
class ImportExport {
    private $filename = null;
    private $upload_path = null;
    function __construct(){
        $this->createUploadDirectory();
    }
    function Import(){
        global $wpdb, $table_prefix;
        $alert = $this->uploadFile();
        if(trim($alert['msg'])=='Success'){
            $db = new Database();
        } else {
            return $alert;
        }
    }
    // uploading file
    function uploadFile(){
        $extension = end(explode(".", $_FILES["exCsvToImport"]["name"]));
        $upload_path = $this->getUploadPath();
        if($extension == 'csv'){
            if ($_FILES["exCsvToImport"]["error"] > 0){
                    return array('alert'=>'alert-danger','msg'=>'FILE ERROR:: '.$_FILES["file"]["error"]);
                }
            else{
                $this->filename = 'File_'.rand(5000,50000).'.csv';
                if (file_exists($upload_path.$this->filename)){
                    return array('alert'=>'alert-info','msg'=>'File Already Exist');
                  }
                else{
                  move_uploaded_file($_FILES["exCsvToImport"]["tmp_name"],$upload_path.$this->filename);
                    return array('alert'=>'alert-success','msg'=>'Success');
                  }
            }
        } else {
            return array('alert'=>'alert-danger','msg'=>'FILE ERROR:: Invalid file extension ! ');
        }
    }
    // creating upload directory
    function createUploadDirectory(){
        $upload_path = wp_upload_dir();
        $upload_path = $upload_path['basedir'];
        $dir_name = 'ExamMatrixUploads';
        $full_path = $upload_path.'/'.$dir_name;
        try{
            if (!file_exists($full_path)) {
                mkdir($full_path, 0777, true);
            }
        } catch(Exception $e){
            return;
        }
    }
    // upload path
    function getUploadPath(){
        $upload_path = wp_upload_dir();
        $upload_path = $upload_path['basedir'];
        $dir_name = 'ExamMatrixUploads';
        $full_path = $upload_path.'/'.$dir_name.'/';
        $this->upload_path = $full_path;
        return $full_path;
    }
    // example file url
    function getExampleCSV(){
        $plugin_dir_name = explode('/',plugin_basename(__FILE__));
        $plugin_dir_name = $plugin_dir_name[0];
        return plugins_url( $plugin_dir_name.'/lib/csv/example.csv');
    }
}
