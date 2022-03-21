<?php
$day = $_REQUEST['dayformated'];
$user_id = $_REQUEST['user'];

$sql = "SELECT t.*, tr.user_id, tr.timestamp, tr.response FROM tasks t
        Inner JOIN 
        (SELECT * FROM task_responses WHERE user_id = '$user_id' AND  DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT('$day', '%Y-%m-%d')) tr ON tr.task_id = t.id
        WHERE t.`status` = 1";

$tasks = Yii::$app->db->createCommand($sql)->queryAll();
if(count($tasks)>0){
?>
<div class="row1">

 <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="preopening-tab" data-toggle="tab" href="#preopening" role="tab" aria-controls="preopening" aria-selected="true">Pre Opening</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="preptab-tab" data-toggle="tab" href="#preptab" role="tab" aria-controls="preptab" aria-selected="false">Prep</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="closing-tab" data-toggle="tab" href="#closing" role="tab" aria-controls="closing" aria-selected="false">Closing</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="preopening" role="tabpanel" aria-labelledby="preopening-tab">
  
        <br />
        <h2>Pre Opening</h2>   
        <hr />          
        <form id="pre_opening_form">
        <?php
            foreach($tasks as $task){
                if($task['task_group'] == '0'){ 
        ?>
            <input type="checkbox" id="<?=$task['id']?>" class="check1" name="pre_opening[<?=$task['id']?>]" value="1"  <?= ($task['response'])?'checked':''; ?> > &nbsp; <label for="pre_opening"> <?=$task['task']?></label><br>      
        <?php } } ?>
        <hr />
         <!-- <button type="submit" class="btn btn-primary" onclick="preopeningsave()">Submit</button> 
          <hr />
          <div id="wait0" style="display:none; z-index: 1000;" class="justify-content-center align-items-center"> <img src='/img/ajaxloader.gif'/> Loading...</div>
          <div class="row"><div id="results0" style="width: 100%;"></div></div>-->
        </form>
  </div>
  <div class="tab-pane fade" id="preptab" role="tabpanel" aria-labelledby="preptab-tab">
        <br />
        <h2>Prep</h2>   
        <hr />          
        <form id="prep_form">
        <?php
            foreach($tasks as $task){
                if($task['task_group'] == '1'){
        ?>
            <input type="checkbox" id="<?=$task['id']?>" class="check2" name="prep[<?=$task['id']?>]" value="1" <?= ($task['response'])?'checked':''; ?> > &nbsp; <label for="prep"> <?=$task['task']?></label><br>      
        <?php } } ?>
        <hr />
         <!-- <button type="submit" class="btn btn-primary" onclick="prepsave()">Submit</button> 
          <hr />
          <div id="wait1" style="display:none; z-index: 1000;" class="justify-content-center align-items-center"> <img src='/img/ajaxloader.gif'/> Loading...</div>
          <div class="row"><div id="results1" style="width: 100%;"></div></div>-->
        </form>
  
  </div>
  <div class="tab-pane fade" id="closing" role="tabpanel" aria-labelledby="closing-tab">
        <br />
        <h2>Closing</h2>   
        <hr />          
        <form id="closing_form">
        <?php
            foreach($tasks as $task){
                if($task['task_group'] == '2'){
        ?>
            <input type="checkbox" id="<?=$task['id']?>" class="check3" name="closing[<?=$task['id']?>]" value="1" <?= ($task['response'])?'checked':''; ?> > &nbsp; <label for="closing"> <?=$task['task']?></label><br>      
        <?php } } ?>
        <hr />
          <!--<button type="submit" class="btn btn-primary" onclick="closingsave()">Submit</button> 
          <hr />
          <div id="wait2" style="display:none; z-index: 1000;" class="justify-content-center align-items-center"> <img src='/img/ajaxloader.gif'/> Loading...</div>
          <div class="row"><div id="results2" style="width: 100%;"></div></div>-->
        </form>
  </div>
</div>
           
</div>

<script>
    $("#pre_opening_form input").prop("disabled", true);
    $("#prep_form input").prop("disabled", true);
    $("#closing_form input").prop("disabled", true);
</script>
<?php }else{ 
    	echo "<center><img style='height: 100%;' src='".Yii::getAlias('/img/nodata.png')."'/></center>";
    
} ?>