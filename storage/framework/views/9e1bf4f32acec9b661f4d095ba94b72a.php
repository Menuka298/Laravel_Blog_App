<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <h1>Blog Post</h1>

    <div class='container'>
    <form action="<?php echo e(route('storeBlog')); ?>" method="POST">

        <?php echo csrf_field(); ?>
        <table class="table-auto" style="width: 100%;line-height: 45px;">
            <tbody>
                <tr>
                    <td> Name</td>
                    <td><input type="text" class="form-control" name="name"
                            aria-describedby="emailHelp" size="50"></td>
                </tr>
                <tr>
                    <td> Email</td>
                    <td><input type="text" class="form-control" name="email" size="50"></td>
                </tr>
                <tr>
                    <td> Blog Tittle</td>
                    <td><input type="text" class="form-control" name="blog_Tittle"
                            aria-describedby="emailHelp" size="50"></td>
                </tr>
                <tr>
                    <td> Blog Description</td>
                    <td><input type="text" class="form-control" name="blog_description" size="50"></td>
                </tr>
            </tbody>
        </table>

    <button class="btn btn-secondary" type="submit" >Submit</button>

    </form>

    <div>
        <table  class="table table-hover" >
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Emails</th>
                    <th>Blog Tittle</th>
                    <th>Blog Description</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $Blog_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border: 1px solid #d3d3d3;">
                        <td><?php echo e($Blog->name); ?></td>
                        <td><?php echo e($Blog->email); ?></td>
                        <td><?php echo e($Blog->blog_Tittle); ?></td>
                        <td><?php echo e($Blog->blog_description); ?></td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\ASUS\OneDrive\Desktop\Laravel Blog App\Blog_app\resources\views/Blog.blade.php ENDPATH**/ ?>