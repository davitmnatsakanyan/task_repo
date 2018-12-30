<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo  asset('css/style.css'); ?>">

    <title>Task System</title>
</head>
<body>
<?php
    $nav_path = view_path('admin/layouts/navbar.php');
    include($nav_path);
?>
<div class="container">
    <h2>Edit Task</h2>
    <form action="<?php echo  url('admin/task/update'); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
        <div class="form-group">
            <label for="user_name">User Name:</label>
            <input disabled value="<?php echo  $task['user_name']; ?>" type="text" class="form-control" id="user_name" placeholder="Enter User Name" name="user_name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input disabled value="<?php echo $task['email']; ?>" type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="text">Text:</label>
            <textarea class="form-control" id="text" placeholder="Text" name="text"><?php echo $task['text']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>