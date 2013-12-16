<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ExamMatrix;

/**
 * Description of Result
 *
 * @author Emerico
 */
class Result {
    //put your code here
    private $tblSession;
    private $tblMapping;
    private $tblQuestion;
    private $tblResult;
    public function __construct(){
        global $table_prefix;
        $this->tblSession = $table_prefix.'ex_session';
        $this->tblMapping = $table_prefix.'ex_mapping';
        $this->tblQuestion = $table_prefix.'ex_questions';
        $this->tblResult = $table_prefix.'ex_result';
    }
    public static function ValidateResult($REGID){
        global $wpdb, $table_prefix, $post;
        date_default_timezone_set('Indian/Christmas');
        $tbl = $table_prefix.'ex_mapping';
        $start = $wpdb->get_var("SELECT date FROM $tbl WHERE regID='$REGID'");
        $limit = intval(get_post_meta($post->ID,'_eme_estimated_time',true))/60;
        $limit = date('H:i:s',  strtotime($start)+$limit*3600);
        $end = date("H:i:s");
        $diff = self::TimeDifference($limit,$end);
        if($diff['h']>0){
            return FALSE;
        } elseif ($diff['h']==0) {
            if($diff['m'] > 10){
                return FALSE;
            }
        }
        return TRUE;
    }
    private static function TimeDifference($limit,$end){
        $seconds = strtotime($end) - strtotime($limit);
        if($seconds < 0)
            return array('h'=>0,'m'=>0,'s'=>0);
        $hours   = floor($seconds / 3600);
        $minutes = floor(($seconds - ($hours * 3600))/60);
        $seconds = floor(($seconds - ($hours * 3600) - ($minutes*60)));
        $difference = array(
                        'h' => $hours,
                        'm' => $minutes,
                        's' => $seconds
                    );
        return $seconds;
    }
    public function CalculateResult($REGID){
        global $wpdb, $table_prefix, $post;
        $correct = 0;
        $wrong = 0;
        if(self::ValidateResult($REGID)){
            $result = $wpdb->get_results(
                            "SELECT * 
                            FROM  $this->tblSession 
                            WHERE regID = '$REGID'"
                        );
            $userID = $wpdb->get_var(
                            "SELECT userID
                            FROM  $this->tblMapping 
                            WHERE regID = '$REGID'"
                        );
            $testID = $wpdb->get_var(
                            "SELECT testID
                            FROM  $this->tblMapping 
                            WHERE regID = '$REGID'"
                        );
            $numQ = count($wpdb->get_results(
                            "SELECT *
                            FROM  $this->tblQuestion 
                            WHERE `set` = 22"
                        ));
            foreach($result as $k=>$v){
                $x = $wpdb->get_var("SELECT answer FROM $this->tblQuestion WHERE `id`={$v->question} AND `set`={$testID}");
                if(trim($x) == trim($v->answer)){
                    $correct += 1;
                }
            }
            $total = get_post_meta($post->ID,'_eme_total_marks',TRUE);
            $total = empty($total)?0:$total;
            $perQ = get_post_meta($post->ID,'_eme_marks_per_question',TRUE);
            $perQ = empty($perQ)?0:$perQ;
            $negative = get_post_meta($post->ID,'_eme_negative_marking',TRUE);
            if($negative == 'Y'){
                $wrong = $numQ - $correct;
                if($wrong)
                    $gain = ($correct * $perQ) - ($wrong * $perQ);
                
            } else{
                $gain = $correct * $perQ;
            }
            $wpdb->insert( 
                    $this->tblResult, 
                    array( 
                            'userID' => $userID, 
                            'regID' => $REGID,
                            'total' => $total,
                            'gain' => $gain,
                            'wrong' => $wrong
                    )
            );
        }
        return array( 
                    'userID' => $userID, 
                    'regID' => $REGID,
                    'total' => $total,
                    'gain' => $gain,
                    'wrong' => $wrong
                    );
    }
}
