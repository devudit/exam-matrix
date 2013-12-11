<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php get_header(); ?>
<?php if(!isset($_REQUEST['testId']) && $_REQUEST['testId'] == '') { ?>
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
<?php } else { 
$testID = trim($_REQUEST['testId']); 
$test = new Test($testID);
$is_test_started = FALSE;
if(isset($_POST['_startTest'])){
        $is_test_started = $test->_startTest(trim($_POST['userRegID']),$testID);
}
?>
<div class="page">
    <div class="container">
        <?php get_sidebar(); ?>
        <div class="content">
            <div class="data">
		<strong id="title"><h1><?php echo get_the_title(); ?></h1></strong>
                <hr/>
                <?php if($is_test_started['msg'] != ''){ ?>
                <div class="alert <?php echo $is_test_started['alert']; ?>"><?php echo $is_test_started['msg']; ?></div>
                <?php } ?>
                <br/><br/>
                <!-- Work Room -->
                <div id="workroom">
                    <?php if(!$is_test_started['status']){ ?>
                    <form method="post" action="">
                    <p> 
                        Your test registration id is 
                        <?php echo $test->_getUserRegID(); ?> . 
                        Please Remember this for future usage.<br/>
                    </p>
                    <input type="hidden" name="userRegID" value="<?php echo $test->_getUserRegID(); ?>" />
                    <input type="submit" class="eme_btn" name="_startTest" value="Ready To Go !" />
                    </form>
                    <?php } else { ?>
                    <form id="" method="post">
                        <ul id="testQuestion">
                            <?php $data = $is_test_started['session'];
                                    foreach($data as $subset=>$quest){
                                        //echo '<li><ul>';
                                        foreach($quest as $k=>$q){
                                            echo '<li><div class="question-item">';
                                                echo '<p class="quest">'.$q['question'].'</p>';
                                                echo '<p><input type="radio" name="answer['.$k.']" value="opt1" />'.$q['opt1'].'</p>';
                                                echo '<p><input type="radio" name="answer['.$k.']" value="opt2" />'.$q['opt2'].'</p>';
                                                echo '<p><input type="radio" name="answer['.$k.']" value="opt3" />'.$q['opt3'].'</p>';
                                                echo '<p><input type="radio" name="answer['.$k.']" value="opt4" />'.$q['opt4'].'</p>';
                                            echo '</div></li>';
                                        }
                                        //echo '</li></ul>';
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
