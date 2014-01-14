<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
if(isset($_REQUEST['questionIdForDelete'])){
    $alert = $db->deleteQuestion($_REQUEST['questionIdForDelete']);
}
$questions = $db->getRecentQuestions();
$sets = $db->getAllSet();
if(isset($_REQUEST['selectedSetIdForFilter'])){
    $selectedSetId = $_REQUEST['selectedSetIdForFilter'];
    $subset = $db->showAllSubset($_REQUEST['selectedSetIdForFilter']);
}
if(isset($_REQUEST['submitFilter'])){
    $questions = $db->applyFilter($_REQUEST['set'],$_REQUEST['subset']);
    if(isset($questions['alert'])){
        $alert = $questions;
        $questions = 0;
    }
}
?>
<div class="qWrap">
<br/><p><h1> Manage Questions </h1></p><hr/><br/><br/>
<?php if($alert['msg'] != ''){ ?>
<div class="alert <?php echo $alert['alert']; ?>">
    <p><strong><?php echo $alert['msg']; ?></strong></p>
</div>
<?php } ?>
<!-- Hidden Form -->
<div style="display:none !important;">
    <form id="submitSelectedSetId" method="post" action="">
        <input type="hidden" id="selectedSetId" name="selectedSetIdForFilter" value="" />
    </form>
</div>
<!-- End Hidden Form -->
<!-- Filter -->
<div class="ex-question">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Question Filter</h3>
      </div>
      <div class="panel-body">
          <form method="post" action="">
              <ul class="filter">
                  <li>
                    <label for="superSet">Parent Set : </label>
                    <select id="superSet" name="set">
                          <option value="NOSELECT">Select Set</option>
                        <?php foreach($sets as $key => $value){ ?>
                          <option <?php if($selectedSetId==$value->id){ echo 'selected="selected"'; } ?> value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                         <?php } ?>
                    </select>
                  </li>
                  <li>
                    <label for="set">Subset Name : </label>
                    <select id="subSet" name="subset">
                        <option value="NOSELECT">Select Subset</option>
                        <?php foreach($subset as $key => $value){ ?>
                          <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                         <?php } ?>
                    </select>
                  </li>
                  <li>
                    <input type="submit" class="btn btn-sm btn-primary" name="submitFilter" value="Filter Questions" />
                  </li>
              </ul>
          </form>
      </div>
    </div>
</div>
<!-- Recent Questions -->    
<?php if($questions){ ?>
<div class="questions">
    <div class="list-group">
        <ul>
            <li class="list-group-item active" style="font-size:16px;">Available Questions</li>
            <?php foreach($questions as $key => $value){ ?>
                <li class="list-group-item item-set">
                    <ul>
                        <li> <?php echo $value->id; ?> </li>
                        <li style="width: 450px;"><?php echo substr($value->question,0,50); ?></li>
                        <li><?php echo $db->getSetName($value->set); ?></li>
                        <li><?php echo $db->getSubsetName($value->subset); ?></li>
                    </ul>
                        <?php echo $value->name; ?>
                    <form class="deleteQuestion" id="deleteQuestion-<?php echo $value->id; ?>" action="" method="post">
                        <input type="hidden" name="questionIdForDelete" value="<?php echo $value->id; ?>" />
                        <a class="close">x</a>
                    </form>
                </li>
             <?php } ?> 
        </ul>
    </div>
</div>
<?php } ?>
</div>