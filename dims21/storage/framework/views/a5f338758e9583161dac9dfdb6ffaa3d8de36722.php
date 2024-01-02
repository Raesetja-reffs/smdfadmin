

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="color:black;font-weight: 900">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('UserName') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="UserName" type="text" class="form-control" name="UserName" value="<?php echo e(old('UserName')); ?>" required autofocus autocomplete="off" style="color:black;font-weight: 900">

                                <?php if($errors->has('UserName')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('UserName')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="off" style="color:black;font-weight: 900">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group" >
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a style="display: none;" class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\deadl\Downloads\smdfmerchieadmin (3)\smdfmerchieadmin\dims21\resources\views/auth/login.blade.php ENDPATH**/ ?>