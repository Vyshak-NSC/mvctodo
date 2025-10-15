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
                    <p class="faded"><?= $project['elapsed_time'] ?></p>
                </div>

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
            <div class="task-item">
                <p class="task-title"><?= htmlspecialchars($task['title']) ?></p>
                <div class="task-content">
                    <p><?= $task['description'] ?></p>
                </div>
            </div>
        <?php endforeach ;?>
    <?php endif ?>
</div>
</section>
