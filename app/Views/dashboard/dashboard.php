<h1>Welcome, <?= $_SESSION['username'] ?? '' ?></h1>
<hr style="width:100%">
<section>
    <h2>Recent Projects</h2>
    <div class="container">
    <?php if(!empty($recentProjects)) :?>
        <?php foreach($recentProjects as $project) :?>
            <div class="project-item">
                
                <h3 class="project-title"><?= htmlspecialchars($project['name']) ?></h3>
                <span class="faded"><?= htmlspecialchars($project['task_count']) ?> Tasks</span>
                
                <div class="project-content">
                    <div class="project-progress-label">
                        <p>Progress</p>
                        <p class="progress-value"><?= htmlspecialchars($project['progress_percent']) ?>%</p>
                    </div>
                    <progress value="<?= $project['progress_percent']?>" max="100" ></progress>
                    
                    <p><?= $project['description'] ?></p>
                </div>
                <p class="faded elapsed-time"><i class="fa fa-clock"></i><?= $project['elapsed_time'] ?></p>

            </div>
        <?php endforeach ;?>
    <?php endif ?>  
</div>
</section>

<section>
    <p>Recent tasks</p>
    <div class="container">
    <?php if(!empty($recentTasks)) :?>
        <?php foreach($recentTasks as $task) :?>
            <div class="project-item">
                    <h3 class="project-title"><?= htmlspecialchars($task['title']) ?></h3>
                    <span class="faded"><?= htmlspecialchars($task['status']) ?></span>
                    <div class="task-content">
                        <p><?= $task['description'] ?></p>
                    </div>
                    <p class="faded elapsed-time"><i class="fa fa-clock"></i> <?= $task['elapsed_time'] ?></p>
                </div>
        <?php endforeach ;?>
    <?php endif ?>
</div>
</section>
