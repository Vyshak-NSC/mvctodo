<h1>Welcome, <?= $_SESSION['username'] ?? '' ?></h1>
<hr style="width:100%">
<section>
    <h2>Recent Projects</h2>
    <div class="container">
        <?php if(!empty($recentProjects)) :?>
            <?php foreach($recentProjects as $project) :?>
                <?php include(VIEW_PATH.'/components/_project_card.php'); ?>
            <?php endforeach; ?>
        <?php endif; ?>   
</div>
</section>

<section>
    <h2>Recent tasks</h2>
    <div class="container">
    <?php if(!empty($recentTasks)) :?>
        <?php foreach($recentTasks as $task)
            include(VIEW_PATH.'/components/_task_card.php'); 
        ?>
    <?php endif ?>
</div>
</section>
