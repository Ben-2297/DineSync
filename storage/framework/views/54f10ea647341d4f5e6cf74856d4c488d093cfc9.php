<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(setting('site_title')); ?> | <?php echo e(setting('site_name')); ?></title>

    <!-- favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('logo/Logo1.png')); ?>">

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo e(asset('authentication/fonts/material-icon/css/material-design-iconic-font.min.css')); ?>">

    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('authentication/css/style.css')); ?>">
</head>
<body>

    <div class="main">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- JS -->
    <script src="<?php echo e(asset('authentication/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('authentication/js/main.js')); ?>"></script>
</body>
</html><?php /**PATH D:\Dynamic Website Project\SAWMS\SAROS-orderSYS\resources\views/template.blade.php ENDPATH**/ ?>