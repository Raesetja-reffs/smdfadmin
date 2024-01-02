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
            padding: 1px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h3><?php echo e($header[0]->StoreName); ?></h3>
<h3>OrderDate:<?php echo e($header[0]->OrderDate); ?></h3>
<h3>DeliveryDate:<?php echo e($header[0]->DeliveryDate); ?></h3>
<h3>By:<?php echo e($header[0]->UserName); ?></h3>
<h3><?php echo e($header[0]->dtm); ?></h3>

<table>
    <tr>
        <th>Code</th>
        <th>Description</th>
        <th>Quantity</th>
    </tr>

    <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($val->strPartNumber); ?></td>
        <td><?php echo e($val->PastelDescription); ?></td>
        <td><?php echo e($val->Quantity); ?></td>
    </tr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

</body>
</html>
<?php /**PATH C:\wamp64\www\smdfmerchieadmin\dims21\resources\views/merchie/orderlines.blade.php ENDPATH**/ ?>