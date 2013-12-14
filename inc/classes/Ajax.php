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
class Ajax {
    public function __construct($data){
        if($data['action'] == 'saveoption')
            self::SaveOption($data);
    }
    static function SaveOption($data){
        if(empty($data['answer']) || empty($data['regID']) || empty($data['qid']))
            return 'fuck';
        $em->_saveAnswer($data);
    }
}
if(isset($_POST['action']) && $_POST['action'] != '')
    $ajax = new Ajax($_POST);

