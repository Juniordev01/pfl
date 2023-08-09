
<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<!-- <div class="container ">
    <div class="row">
        <div class="col-lg-3 d-flex justify-content-center">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><?php echo e($product->name); ?></h6>
                    <p class="card-text "><strong>Price</strong><?php echo e($product->price); ?></p>
                    <!-- <?php echo DNS2D::getBarcodeHTML(strval($product->id) . ' - ' . $product->name, 'QRCODE',3,2); ?> -->
<!-- <div class="barcode">
                        <?php echo DNS1D::getBarcodeHTML($product->product_id . "123" , "C128",1.4,22); ?>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div> -->



<div class="container mt-5">
    <div class="row d-block" id="product-cards">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
            <div class="card mb-3 shadow-lg p-3 ">
                <div class="card-body">
                    <h5 class="card-title">Name: <?php echo e($product->name); ?></h5>
                    <p class="card-text"><strong>Price:</strong> <?php echo e($product->price); ?></p>
                    <!-- <span><?php echo DNS1D::getBarcodeHTML($product->product_id . "123", "C128", 1.4, 22); ?></span> -->
                    <div class="row">
                        <?php
                        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($product->product_id, "C128", 1.4, 22) . '" alt="barcode"   />';
                        ?>
                        <span><?php echo e($product->product_id); ?></span>
                        <span><?php echo e($product->code); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>








<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PFL\pfl\resources\views/backend/barcode/barcode.blade.php ENDPATH**/ ?>