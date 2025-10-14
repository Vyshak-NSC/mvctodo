<section>
    <p>My projects</p>
    <div class="container">
        <?php if(!empty($projects)) :?>
            <?php foreach($projects as $project) :?>
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
