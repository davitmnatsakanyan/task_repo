<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo asset('fonts/font_awesome/css/font-awesome.min.css'); ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo  asset('css/style.css'); ?>">

    <title>Task System</title>
    <script>
        var BASE_URL = '<?php echo url('/') ?>';
    </script>
</head>
<body>

<?php
    $nav_path = view_path('task/layouts/navbar.php');
    include($nav_path);
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="pull-left">
                <label for="sort" >Order By</label>
                <select name="order">
                    <option value="">Select</option>
                    <option value="user_name">User Name</option>
                    <option value="email">Email</option>
                    <option value="status">Status</option>
                </select>
                <i data-type="asc" title="ASC | DESC" class="fa fa-sort-amount-asc type" aria-hidden="true"></i>
            </div>
        </div>
    </div>
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
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks['items'] as $k => $task){ ?>
            <tr>
                <th scope="row"><?php echo $task['id']; ?></th>
                <td><?php echo  $task['user_name'] ?></td>
                <td><?php echo  $task['email']; ?></td>
                <td><?php echo  $task['text']; ?></td>
                <td class="status"><?php echo  $task['status'] ? 'Completed' : 'In Progress' ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php if($tasks['last_page'] > 1){ ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination mt-5 mx-auto w-50">
                <?php if($tasks['current_page'] > 1){ ?>
                <li data-url="<?php echo  url('/').'?page='.($tasks['current_page'] - 1); ?>" class="page-item"><a class="page-link" href="#">Previous</a></li>
                <?php }
                for($i = 1; $tasks['last_page'] >= $i; $i++){
                ?>
                <li data-url="<?php echo  url('/').'?page='.$i; ?>" class="page-item <?php echo  $tasks['current_page'] == $i ? 'active' : ''; ?>"><a class="page-link" href="#"><?php echo  $i; ?></a></li>
                <?php }
                if($tasks['current_page'] < $tasks['last_page']){
                ?>
                <li data-url="<?php echo  url('/').'?page='.($tasks['current_page'] + 1); ?>" class="page-item"><a class="page-link" href="#">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
        <?php } ?>
    </div>
    <a href="<?php echo url('task/create'); ?>">New Task</a>
</div>

<!-- Optional JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.page-item', function(e){
            e.preventDefault();
            var order_by = $(document).find('select[name="order"]').val();
            var type = $(document).find('.type').data('type');

            var url = $(this).data('url')+'&order_by='+order_by+'&type='+type;
            $.ajax({
                url: url,
                type: 'get',
                success: function(response){
                    $('#tasks').replaceWith(response);
                }
            })
        });

        $(document).on('change', 'select[name="order"]', function(e){
            e.preventDefault();

            var order_by = $(this).val();
            var type = $('.type').data('type');

            var url = BASE_URL+'?order_by='+order_by+'&type='+type;
            $.ajax({
                url: url,
                type: 'get',
                success: function(response){
                    $('#tasks').replaceWith(response);
                }
            })
        });

        $(document).on('click', '.type', function(){
            let sort = $(this).data('type');

            if(sort === 'asc'){
                $(this).data('type', 'desc');
                $(this).removeClass('fa-sort-amount-asc');
                $(this).addClass('fa-sort-amount-desc')
            }
            else{
                $(this).data('type', 'asc');
                $(this).removeClass('fa-sort-amount-desc');
                $(this).addClass('fa-sort-amount-asc')
            }

            var order_by = $(document).find('select[name="order"]').val();
            var url = BASE_URL+'?order_by='+order_by+'&type='+$(this).data('type');
            $.ajax({
                url: url,
                type: 'get',
                success: function(response){
                    $('#tasks').replaceWith(response);


                }
            })
        })
    });
</script>
</body>
</html>