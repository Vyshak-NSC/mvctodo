<section>
    <h2>My projects</h2>
    <div class="container">
        <?php if(!empty($projects)) :?>
            <?php foreach($projects as $project) :?>
                <?php include(VIEW_PATH.'/components/_project_card.php'); ?></a>
            <?php endforeach; ?>
        <?php endif; ?>  
    </div>
</section>
