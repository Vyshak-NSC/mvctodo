<div class="task-item">
    <span class="project-name"><?= htmlspecialchars($task['project_name']) ?></span>
    <h3 class="task-title"><?= htmlspecialchars($task['title']) ?></h3>
    <span class="<?= htmlspecialchars($task['status']) ?>"><?= htmlspecialchars($task['status']) ?></span>
    <div class="task-content">
        <p><?= $task['description'] ?></p>
    </div>
    <p class="faded elapsed-time"><i class="fa fa-clock"></i><?= $task['elapsed_time'] ?></p>
</div>