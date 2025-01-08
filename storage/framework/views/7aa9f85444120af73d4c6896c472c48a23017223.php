<div>
    <section class="team" id="team">
		<div class="center-text">
			<h3>Team</h3>
			<h2>Our Experience Chefs</h2>
		</div>

		<div class="team-content">
            <?php $__empty_1 = true; $__currentLoopData = $chefs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chef): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="row">
				<div class="team-img">
					<?php if(!empty($chef->avatar)): ?>
						<img src="<?php echo e(url('storage/avatars/'.$chef->avatar)); ?>" alt="">
					<?php else: ?>
						<img src="<?php echo e(asset('avatar.jpg')); ?>" alt="">
					<?php endif; ?>
				</div>
				<h4><?php echo e($chef->fname); ?> <?php echo e($chef->lname); ?></h4>
				<p>Executive Chef</p>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			<div class="row">
				<div class="team-img">
					<img src="<?php echo e(asset('avatar.jpg')); ?>">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
			<div class="row">
				<div class="team-img">
					<img src="<?php echo e(asset('avatar.jpg')); ?>">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
			<div class="row">
				<div class="team-img">
					<img src="<?php echo e(asset('avatar.jpg')); ?>">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
			<div class="row">
				<div class="team-img">
					<img src="<?php echo e(asset('avatar.jpg')); ?>">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
            <?php endif; ?>
		</div>
	</section>
</div>
<?php /**PATH D:\Dynamic Website Project\SAWMS\SAROS-orderSYS\resources\views/livewire/homepage/team-section.blade.php ENDPATH**/ ?>