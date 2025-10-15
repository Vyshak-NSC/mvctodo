<section>
    <h2>My projects</h2>
    <div class="container">
        <?php if(!empty($projects)) :?>
            <?php foreach($projects as $project) :?>
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
                    <p class="faded"><i class="fa fa-clock"></i><?= $project['elapsed_time'] ?></p>

                </div>
            <?php endforeach ;?>
        <?php endif ?>  
    </div>
</section>
