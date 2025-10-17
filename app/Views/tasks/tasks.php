<section>
    <h1>My tasks</h1>
    <div class="container">
        <?php if(!empty($tasks))
            foreach($tasks as $task) 
                include(VIEW_PATH.'/components/_task_card.php'); 
        ?>
    </div>
</section>
