<?php ($array=[]); ?>

<?php $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(in_array($conv->receiver->id,$array)==false): ?>
<?php (array_push($array,$conv->receiver->id)); ?>
<?php if($conv->receiver && $conv->receiver->user_id): ?>
<?php ($user=\App\Models\User::find($conv->receiver->user_id)); ?>
<?php elseif($conv->receiver && $conv->receiver->vendor_id): ?>
<?php ($user=\App\Models\Vendor::find($conv->receiver->vendor_id)); ?>
<?php ($vnd=$conv->receiver); ?>
<?php endif; ?>
<?php if(isset($user)): ?>

<?php ($last_sender=$conv->sender_id); ?>
<?php ($unchecked=($conv->last_message->sender_id != $last_sender)?0:$conv->unread_message_count); ?>
<input type="hidden" id="deliver_man" value="<?php echo e($delivery_man->id); ?>">
<div
    class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list <?php echo e($unchecked!=0?'conv-active':''); ?>"
    onclick="viewConvs('<?php echo e(route('admin.delivery-man.message-view',['conversation_id'=>$conv->id,'user_id'=>$conv->sender_id])); ?>','customer-<?php echo e($conv->sender_id); ?>')"
    id="customer-<?php echo e($conv->sender_id); ?>">
    <div class="chat-user-info-img d-none d-md-block">
        <img class="avatar-img"
                src="<?php echo e(asset('storage/app/public/profile/'.$user['image'])); ?>"
                onerror="this.src='<?php echo e(asset('public/assets/admin')); ?>/img/160x160/img1.jpg'"
                alt="Image Description">
    </div>
    <div class="chat-user-info-content">
        <h5 class="mb-0 d-flex justify-content-between">
            <?php if(isset($vnd)): ?>
            <span class=" mr-3"><?php echo e($vnd['f_name'].' '.$vnd['l_name']); ?></span> <span
                class="<?php echo e($unchecked!=0?'badge badge-info':''); ?>"><?php echo e($unchecked!=0?$unchecked:''); ?></span>
            <?php else: ?>
            <span class=" mr-3"><?php echo e($user['f_name'].' '.$user['l_name']); ?></span> <span
                class="<?php echo e($unchecked!=0?'badge badge-info':''); ?>"><?php echo e($unchecked!=0?$unchecked:''); ?></span>
            <?php endif; ?>

        </h5>
        <span><?php echo e($user['phone']); ?></span>
    </div>
</div>
<?php else: ?>
    <div
        class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list">
        <div class="chat-user-info-img d-none d-md-block">
            <img class="avatar-img"
                    src='<?php echo e(asset('public/assets/admin')); ?>/img/160x160/img1.jpg'
                    alt="Image Description">
        </div>
        <div class="chat-user-info-content">
            <h5 class="mb-0 d-flex justify-content-between">
                <span class=" mr-3">Account not found</span>
            </h5>
        </div>
    </div>
<?php endif; ?>

<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/delivery-man/partials/_conversation_list.blade.php ENDPATH**/ ?>