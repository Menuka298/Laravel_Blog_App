<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Boostrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- css Links -->
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">

    <title>Document</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Blog Post</a>
    </div>
    </nav>
    <div class='container mt-4'>
    
    <div class='container'>

        <!-- search error message -->
            <?php if(Session::has('searchError')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo e(Session::get('searchError')); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
        
        <!-- search error message -->

        <!-- ... (existing code) ... -->

        <!-- Search bar and button -->
        <form  action="<?php echo e(route('searchBlog')); ?>" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <!-- ... (existing code) ... -->
    </div>

        <!-- success message -->
        <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo e($message); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- success message -->

        <!-- ... (existing code) ... -->

        <!-- store error message -->
        <?php if($errors->storeError->any()): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <ul>
                <?php $__currentLoopData = $errors->storeError->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?> Please Enter Your Details</li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </ul>
               <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <!-- store error message -->

        <!-- ... (existing code) ... -->

            <form action="<?php echo e(route('storeBlog')); ?>" method="POST" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                
                <table class="table-auto" style="width: 100%;line-height: 45px;">
                    <tbody> 
                        <tr>
                            <td> Email : </td>
                            <td><input type="text" class="form-control" name="email" size="50"></td>
                        </tr>
                        <tr>
                            <td> Blog Tittle : </td>
                            <td><input type="text" class="form-control" name="blog_Tittle"
                                    aria-describedby="emailHelp" size="50"></td>
                        </tr>
                        <tr>
                            <td> Blog Description : </td>
                            <td><input type="text" class="form-control" name="blog_description" size="100"></td>
                        </tr>

                        <tr>
                            <td>Select Images : </td>
                            <td><input type="file" name="images[]" id="inputImage" multiple
                                    class="form-control <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            </td>

                            <!-- image error message -->
                            <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <!-- image error message -->
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-secondary" type="submit" >Submit</button>
            </form>

        <!-- ... (existing code) ... -->

        <!-- Table -->
        <div class='mt-4'>
        
        <!-- Display the table only if $Blog_list has elements -->
        <?php if(isset($Blog_list) && count($Blog_list) > 0): ?>
            <table  class="table table-hover" >
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Emails</th>
                        <th>Blog Tittle</th>
                        <th>Blog Description</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $Blog_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border: 1px solid #d3d3d3;">
                            
                            <td><img src="<?php echo e(asset('images/' . $Blog->name)); ?>" width="300px"></td>
                            <td><?php echo e($Blog->email); ?></td>
                            <td><?php echo e($Blog->blog_Tittle); ?></td>
                            <td><?php echo e($Blog->blog_description); ?></td>

                            <!-- delete button -->
                            <td>
                                <form action="<?php echo e(route('deleteBlog')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($Blog->id); ?>">
                                    <button class="btn btn-danger" type="submit" formmethod="post" >Delete</button>
                                </form>
                            </td>
                            <!-- delete button -->

                            <!-- ... (existing code) ... -->

                            <!-- update bar and update button -->
                            <td>
                                <form action="<?php echo e(route('updateBlog')); ?>" method="post" >
                                    <input type="text" id="email" name="email" size="40"
                                        value="<?php echo e($Blog->email); ?>">
                                        <br>

                                    <input type="text" id="email" name="blog_Tittle" size="40"
                                        value="<?php echo e($Blog->blog_Tittle); ?>">
                                        <br>
                                        
                                    <input type="text" id="email" name="blog_description" size="40"
                                        value="<?php echo e($Blog->blog_description); ?>">
                                        <br>

                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($Blog->id); ?>">
                                    <button class="btn btn-primary mt-2" type="submit" formmethod="post" >Update</button>
                                </form>
                            </td>
                            <!-- update bar and update button -->

                            <!-- ... (existing code) ... -->

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <!-- Table -->

            <!-- Pagination links -->

            <?php echo e($Blog_list->links('pagination::bootstrap-4')); ?> <!-- Use the Bootstrap paginator template -->

            <!-- Or if you're using Bootstrap 5 -->
            <?php echo e($Blog_list->links('pagination::bootstrap-5')); ?>



            <!-- Pagination links -->

            <!-- Tabele has'nt elements Display the alert massage -->
            <?php else: ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><p>No items found.</p></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
        </div>
        <!-- ... (existing code) ... -->
    </div>
</body>
</html><?php /**PATH C:\Users\ASUS\OneDrive\Desktop\Laravel Blog App\Blog_app\resources\views/blog.blade.php ENDPATH**/ ?>