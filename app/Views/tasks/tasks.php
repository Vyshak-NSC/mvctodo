<section>
    <p>My tasks</p>
    <div class="container">
        <?php if(!empty($tasks)) :?>
            <?php foreach($tasks as $task) :?>
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
