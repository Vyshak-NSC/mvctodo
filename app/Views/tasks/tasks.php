<section>
    <h2>My tasks</h2>
    <div class="container">
        <?php if(!empty($tasks)) :?>
            <?php foreach($tasks as $task) :?>
                <div class="project-item">
                    <h3 class="project-title"><?= htmlspecialchars($task['title']) ?></h3>
                    <span class="faded"><?= htmlspecialchars($task['status']) ?></span>
                    <div class="task-content">
                        <p><?= $task['description'] ?></p>
                    </div>
                    <p class="faded elapsed-time"><i class="fa fa-clock"></i><?= $task['elapsed_time'] ?></p>
                </div>
            <?php endforeach ;?>
        <?php endif ?>
    </div>
</section>
