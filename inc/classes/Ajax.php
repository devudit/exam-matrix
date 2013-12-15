<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ExamMatrix;

/**
 * Description of Ajax
 *
 * @author Emerico
 */
include_once('../../../../../wp-load.php');
class Ajax {
    public function __construct($data){

    }
    public static function SaveOption($data){
        global $wpdb, $table_prefix;
        $tbl = $table_prefix.'ex_session';
        if(empty($data['answer']) || empty($data['regID']) || empty($data['qid']))
            die();
        if(!self::TestStatus($data['regID'])){
            $wpdb->update( 
                    $tbl, 
                    array( 
                            'answer' => $data['answer']
                    ), 
                    array( 
                            'regID' => $data['regID'],
                            'question' => $data['qid'] 
                    )
            );
        } else {
            die();
        }
    }
    private static function TestStatus($ref){
        global $wpdb, $table_prefix;
        $tbl = $table_prefix.'ex_mapping';
        $chk = $wpdb->get_var("SELECT status FROM $tbl WHERE regID='$ref'");
        return $chk;
    }
    // Stop Undefined functions
    public static function __callStatic($name, $arguments){
        die();
    }
}
if(isset($_POST['action']) && $_POST['action'] != ''){
    call_user_func(__NAMESPACE__ .'\Ajax::'.$_POST['action'],$_POST);
}
