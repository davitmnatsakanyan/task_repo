<div id="tasks">
    <?php
    if (get_flash_message()) {
        foreach (get_flash_message() as $message) {
            echo '<p class="message bg-success py-3 pl-3"> ' . $message . '</p>';
        }
    }
    ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">USER NAME</th>
            <th scope="col">EMAIL</th>
            <th scope="col">TEXT</th>
            <th scope="col">STATUS</th>
            <th scope="col">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks['items'] as $k => $task){ ?>
            <tr data-id="<?php echo  $task['id']; ?>">
                <th scope="row"><?php echo $task['id']; ?></th>
                <td><?php echo  $task['user_name'] ?></td>
                <td><?php echo  $task['email']; ?></td>
                <td><?php echo  $task['text']; ?></td>
                <td class="status"><?php echo  $task['status'] ? 'Completed' : 'In Progress' ?></td>
                <td>
                    <a href="<?php echo url('admin/task/edit').'?id='.$task['id']; ?>">
                        <i title="Edit" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a title="Toggle Status" href="#" class="toggle_status">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if($tasks['last_page'] > 1){ ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination mt-5 mx-auto w-50">
                <?php if($tasks['current_page'] > 1){ ?>
                    <li data-url="<?php echo  url('admin/index').'?page='.($tasks['current_page'] - 1); ?>" class="page-item"><a class="page-link" href="#">Previous</a></li>
                <?php }
                for($i = 1; $tasks['last_page'] >= $i; $i++){
                    ?>
                    <li data-url="<?php echo  url('admin/index').'?page='.$i; ?>" class="page-item <?php echo  $tasks['current_page'] == $i ? 'active' : ''; ?>"><a class="page-link" href="#"><?php echo  $i; ?></a></li>
                <?php }
                if($tasks['current_page'] < $tasks['last_page']){
                    ?>
                    <li data-url="<?php echo  url('admin/index').'?page='.($tasks['current_page'] + 1); ?>" class="page-item"><a class="page-link" href="#">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
</div>