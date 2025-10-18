<section>
    <h2><?= $project['name'] ?? 'Project Name missing' ?></h2>
    <p><?= $project['description'] ?></p>
    <div class="project-summary">
        <div class="summary-item">
            <h3>Task count</h3>
            <p class="faded"><?= $project['task_count']?></p>
        </div>

        <div class="summary-item">
            <h3>Last Updated</h3>
            <p class="faded"><?= $project['updated_at']?></p>
        </div>

        <div class="summary-item">
            <h3>Created on</h3>
            <p class="faded"><?= $project['created_at']?></p>
        </div>
    </div>
</section>

<section>
    <h2>Tasks</h2>
    <div class="task-filters">
        <div class="filter-button">
            <input class="filter-input" type="checkbox" id="show-all" data-status="all" name="all">
           
        </div>
        <input type="checkbox" id="show-completed" value="completed">
        <input type="checkbox" id="show-pending" value="pending">
    </div>
    <div class="container">
        <?php if(!empty($tasks)): ?>
            <?php foreach($tasks as $task): ?>
                <div class="task-item">
                    <input type="checkbox" value="<?= $task['status'] == 'completed' ? 'checked':'' ?>">
                    <div class="task-body">
                        <h3 class="task-title"><?= $task['title']?></h3>
                        <p class="faded"><?= $task['elapsed_time'] ?></p>
                    </div>
                    <p class="task-status <?= htmlspecialchars($task['status']) ?>"><?= $task['status'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tasks found for this project.</p>
        <?php endif; ?>
</section>

<script src="<?= BASE_URL . 'js/scripts.js' ?>"></script>