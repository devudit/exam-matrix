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
    function __construct($filename){
        $this->filename = $filename;
    }
    function Import(){
        global $wpdb, $table_prefix;
    }
}
