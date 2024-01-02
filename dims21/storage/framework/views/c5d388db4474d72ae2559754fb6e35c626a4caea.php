<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

    <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a style="background: chocolate;padding: 6px;" href='<?php echo url("/merchieorderid"); ?>/<?php echo e($val->ID); ?>'><?php echo e($val->OrderNumber); ?>: Time <?php echo e($val->dtm); ?>: <?php echo e($val->UserName); ?></a><br><br><br>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</body>
</html>
<?php /**PATH C:\wamp64\www\smdfmerchieadmin\dims21\resources\views/merchie/orderheaders.blade.php ENDPATH**/ ?>