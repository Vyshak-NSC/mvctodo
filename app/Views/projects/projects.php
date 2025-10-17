<section>
    <h2>My projects</h2>
    <div class="container">
        <?php if(!empty($projects))
            foreach($projects as $project)
                include(VIEW_PATH.'/components/_project_card.php');
        ?>  
    </div>
</section>
