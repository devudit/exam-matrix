<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ExamMatrix;

/**
 * Description of installDb
 *
 * @author Udit Rawat
 */
class InstallDb {
   public function __construct(){
       add_option( "exammatrix_db_version", "1.0" );
       $this->_installTables();
   }
   private function _installTables(){
       global $wpdb, $table_prefix;
       $sql = array(
                'mapping' =>'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'ex_mapping` (
                            `regID` varchar(255) NOT NULL,
                            `testID` int(30) NOT NULL,
                            `userID` int(30) NOT NULL,
                            `date` date NOT NULL,
                            PRIMARY KEY (`regID`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;',
               'set' => 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'ex_set` (
                            `id` int(30) NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) NOT NULL,
                            `status` varchar(255) NOT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;',
               'subset' => 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'ex_subset` (
                            `id` int(30) NOT NULL AUTO_INCREMENT,
                            `parent_id` int(30) NOT NULL,
                            `name` varchar(255) NOT NULL,
                            `status` varchar(255) NOT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;',
               'questions' => 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'ex_questions` (
                                `id` int(30) NOT NULL AUTO_INCREMENT,
                                `set` int(30) NOT NULL,
                                `subset` int(30) NOT NULL,
                                `question` text NOT NULL,
                                `opt1` text NOT NULL,
                                `opt2` text NOT NULL,
                                `opt3` text NOT NULL,
                                `opt4` text NOT NULL,
                                `answer` varchar(255) NOT NULL,
                                PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;',
                'session' => 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'ex_session` (
                        `id` int(30) NOT NULL AUTO_INCREMENT,
                        `regID` varchar(255) NOT NULL,
                        `question` int(30) NOT NULL,
                        `answer` varchar(255) NOT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;',
                'result' => 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'_ex_result` (
                            `ID` int(30) NOT NULL AUTO_INCREMENT,
                            `userID` int(30) NOT NULL,
                            `regID` varchar(255) NOT NULL,
                            `total` int(30) NOT NULL,
                            `gain` int(30) NOT NULL,
                            `wrong` int(30) NOT NULL,
                            PRIMARY KEY (`ID`)
                          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;'
           );
       require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
       foreach($sql as $key=>$query){
           dbDelta( $query );
       }
   }
}
