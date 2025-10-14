<p>Welcome, <?= $_SESSION['username'] ?? '' ?></p>
<section>
    <p>Recent Projects</p>
    <div class="container">
    <?php if(!empty($recentProjects)) :?>
        <?php foreach($recentProjects as $project) :?>
            <div class="project-item">
                <p class="project-title"><?= htmlspecialchars($project['name']) ?></p>
                <div class="project-content">
                    <p><?= $project['description'] ?></p>
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
