<div class="project-item">
    <a href="<?= BASE_URL . 'projects/show/' . $project['project_id'] ?>">
        <h3 class="project-title"><?= htmlspecialchars($project['name']) ?></h3>
        <span class="faded"><?= htmlspecialchars($project['task_count']) ?> Tasks</span>

        <div class="project-content">
            <div class="project-progress-label">
                <p>Progress</p>
                <p class="progress-value"><?= htmlspecialchars($project['progress_percent']) ?>%</p>
            </div>
            <progress class="<?= $project['progress_percent'] == 0? 'no-progress':'' ?>" value="<?= $project['progress_percent']?>" max="100" ></progress>
            
            <p><?= $project['description'] ?></p>
        </div>
        <p class="faded elapsed-time"><i class="fa fa-clock"></i><?= $project['elapsed_time'] ?></p>
    </a>
</div>