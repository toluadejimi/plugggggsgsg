<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-6">
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex flex-wrap  px-0">
                        <div class="row mt-12">


                                <p>Resolve pending transactions by using your bank session ID / Refrence
                                    No on your transaction
                                    recepit</p>

                                <form action="resolve-now" method="POST">
                                    <?php echo csrf_field(); ?>

                                    <label class="my-3">Enter Session ID</label>
                                    <div>
                                        <input type="text" name="session_id" required
                                            class="form-control" placeholder="Enter session ID">
                                        <input hidden type="text" name="trx_ref"
                                            value="<?php echo e($trx); ?>" required class="form-control">

                                    </div>


                                    <div class="footer fixed">

                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-danger my-4">
                                                <ul>
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($error); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(session()->has('message')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(session()->has('error')): ?>
                                            <div class="alert alert-danger mt-2">
                                                <?php echo e(session()->get('error')); ?>

                                            </div>
                                        <?php endif; ?>


                                        <div class="container">


                                            <button type="submit" style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); color:#ffffff;"  class="btn btn-primary text-start w-100 btn-rounded">

                                                <svg class="cart me-4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.5158 2.01275C17.9478 0.81775 16.7898 -0.34025 15.5948 0.0927503L0.989804 5.37475C-0.209196 5.80875 -0.354196 7.44475 0.748804 8.08375L5.4108 10.7828L9.5738 6.61975C9.76241 6.43759 10.015 6.3368 10.2772 6.33908C10.5394 6.34135 10.7902 6.44652 10.9756 6.63193C11.161 6.81734 11.2662 7.06815 11.2685 7.33035C11.2708 7.59255 11.17 7.84515 10.9878 8.03375L6.8248 12.1968L9.5248 16.8587C10.1628 17.9617 11.7988 17.8158 12.2328 16.6178L17.5158 2.01275Z" fill="white"/>
                                                </svg>

                                                CONTINUE
                                            </button>
                                        </div>
                                    </div>



                                </form>


                        </div>
                        <strong> </strong>
                    </li>
                </ul>


            </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make($activeTemplate.'layouts.nofooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/project/aacelogs/core/resources/views/templates/basic/user/resolve_deposit.blade.php ENDPATH**/ ?>