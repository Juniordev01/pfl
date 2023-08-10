
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
    <div class="row d-flex" id="product-cards">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-5">
            <div class="card mb-3 shadow-lg p-3 ">
                <div class="card-body">
                    <h5 class="card-title">Name: <?php echo e($product->name); ?></h5>
                    <!-- <span><?php echo DNS1D::getBarcodeHTML($product->product_id . "123", "C128", 1.4, 22); ?></span> -->
                    <?php $__currentLoopData = $product->productVariants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="card-text"><strong>Price:</strong> <?php echo e($variant->price); ?></p>
                    <?php if(!empty($variant->barcode)): ?>
                    <?php
                    // echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($variant->id, "C128", 1.4, 22) . '" alt="barcode"   />';
                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($product->id."|".$variant->barcode, "C128", 1, 22) . '" alt="barcode"  width="250" />';
                    // echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($product->code.",".$variant->barcode, "C128", 1, 22) . '" alt="barcode" width="250" height="20"   />';
                    ?>
                    
                    <?php endif; ?>
                    <!-- <h5 class="card-title">Title: <?php echo e($variant->barcode); ?></h5> -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>








<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PFL\pfl\resources\views/backend/barcode/barcode.blade.php ENDPATH**/ ?>