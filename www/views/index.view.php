<?php
//include "includes/header.php";
?>
<h1>My Tasks</h1>

<ul>
    <?php foreach ($tasks as $task) : ?>
        <li>
        <?php if($task->complete) : ?>
            <strike>
                <?= $task->description; ?>
            </strike>
            <?php
            else :
                echo $task->description;
            endif;
            ?>
        </li>
    <?php endforeach; ?>
</ul>

<?php
include "includes/footer.php";
?>