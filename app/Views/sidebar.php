<div class="sidebar">
    <h3><i class="fas fa-clipboard-list"></i>Task manager</h3>
    <?php $page = explode('/',$_GET['url'])[0] ;?>
    <ul>
        <li class="<?= $page == 'dashboard' ? 'active':'' ?>"><a href="<?= BASE_URL; ?>dashboard"><i class="fas fa-home"></i>Dashboard</a></li>
        <li class="<?= $page == 'projects' ? 'active':'' ?>"><a href="<?= BASE_URL; ?>projects"><i class="fas fa-folder"></i>Projects</a></li>
        <li class="<?= $page == 'tasks' ? 'active':'' ?>"><a href="<?= BASE_URL; ?>tasks"><i class="fas fa-tasks"></i>Tasks</a></li>
        <!-- <li><a href="<?= BASE_URL; ?>activity"><i class="fas fa-chart-line"></i>Activity</a></li> -->
        <li><a id="logout" href="<?= BASE_URL; ?>auth/logout">Logout</a></li>
    </ul>
</div>