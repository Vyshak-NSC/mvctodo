<h1>Welcome, <?= $_SESSION['username'] ?? '' ?></h1>
<hr style="width:100%">
<section>
    <h2>Recent Projects</h2>
    <div class="container">
    <?php if(!empty($recentProjects)) :?>
        <?php foreach($recentProjects as $project)
            include(VIEW_PATH.'/components/_project_card.php');
        ?>
    <?php endif ?>  
</div>
</section>

<section>
    <p>Recent tasks</p>
    <div class="container">
    <?php if(!empty($recentTasks)) :?>
        <?php foreach($recentTasks as $task)
            include(VIEW_PATH.'/components/_task_card.php'); 
        ?>
    <?php endif ?>
</div>
</section>
