<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php get_header(); ?>
<?php if(!isset($_REQUEST['testId']) && $_REQUEST['testId'] == '' && !isset($_REQUEST['status'])) { ?>
<div class="page">
    <div class="container">
        <?php get_sidebar(); ?>
        <div class="content">
            <div class="data">
                <?php while ( have_posts() ) : the_post(); ?>
		<strong id="title"><h1><?php the_title(); ?></h1></strong>
                <hr/>
                <?php if ( has_post_thumbnail() ): ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                <?php endif ?>
		<div id="textpreview"><?php the_content(); ?></div>
		<?php endwhile; // end of the loop. ?>
            </div>
        </div>
    </div>
</div>
<?php } elseif(isset($_REQUEST['status'])){ ?>
<div class="page">
    <div class="container">
        <?php get_sidebar(); ?>
        <div class="content">
            <div class="data">
                <h3>Your Test Is Submitted Contact Administrator For Detailed Result !!</h3><br/><br/><br/>
                <!-- testing -->
                <?php
                    $result = $em->Result($_REQUEST['activeRegID']);
                    echo '<p style="text-align:center"><strong>You have got '.$result['gain'].' marks out of '.$result['total'].'</strong></p><br/>';
                    echo '<p style="text-align:center">Total number of wrong question are '.$result['wrong'].'</p>';
                ?>
                <!-- end testing -->
            </div>
        </div>
    </div>
</div>  
<?php } else  { 
$testID = trim($_REQUEST['testId']); 
$is_test_started = FALSE;
$is_test_started = $em->ETest(trim($testID));
?>
<div class="page">
    <div class="container">
        <?php get_sidebar(); ?>
        <div class="content">
            <div class="data">
		<strong id="title"><h1><?php echo get_the_title(); 
                        if($is_test_started['status']){
                            $em->DigiClock('activeForm');
                        }
                ?></h1></strong>
                <hr/>
                <?php if($is_test_started['msg'] != ''){ ?>
                <div class="alert <?php echo $is_test_started['alert']; ?>"><?php echo $is_test_started['msg']; ?></div>
                <?php } ?>
                <br/><br/>
                <!-- Work Room -->
                <div id="workroom">
                    <?php if($is_test_started['status']) { ?>
                    <form id="activeForm" method="post" action="<?php echo get_permalink(get_the_Id()); ?>?status=submit">
                        <input type="hidden" name="activeRegID" id="activeRegID" value="<?php echo $em->GetUserRegID(); ?>" />
                        <ul id="testQuestion">
                            <?php $data = $is_test_started['session'];
                                    if(!empty($data)){
                                    foreach($data as $subset=>$quest){
                                        //echo '<li><ul>';
                                        foreach($quest as $k=>$q){
                                            echo '<li><div class="question-item">';
                                                echo '<input type="hidden" name="questionId" class="questionId" value="'.$k.'" />';
                                                echo '<p class="quest">'.$q['question'].'</p>';
                                                echo '<p><input type="radio" id="q'.$k.'-opt1" name="answer-'.$k.'" value="opt1" />';
                                                    echo '<label for="q'.$k.'-opt1">'.$q['opt1'].'</label></p>';
                                                echo '<p><input type="radio" id="q'.$k.'-opt2" name="answer-'.$k.'" value="opt2" />';
                                                    echo '<label for="q'.$k.'-opt2">'.$q['opt2'].'</label></p>';
                                                echo '<p><input type="radio" id="q'.$k.'-opt3" name="answer-'.$k.'" value="opt3" />';
                                                    echo '<label for="q'.$k.'-opt3">'.$q['opt3'].'</label></p>';
                                                echo '<p><input type="radio" id="q'.$k.'-opt4" name="answer-'.$k.'" value="opt4" />';
                                                    echo '<label for="q'.$k.'-opt4">'.$q['opt4'].'</label></p>';
                                            echo '</div></li>';
                                        }
                                        //echo '</li></ul>';
                                    }
                                    echo '<li><div class="question-item"><h3>I am done !!</h3></div></li>';
                                } else {
                                    echo '<p><strong>No Question Defined In This Set</strong></p>';
                                }
                             } ?>
                        </ul>
                    </form>
                </div>
                <!-- End Work Room -->
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>
