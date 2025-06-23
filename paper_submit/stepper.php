<?php
function renderStepper($currentStep) {
    $steps = [
        1 => ['label' => 'Register paper', 'icon' => 'fa-file-alt'],
        2 => ['label' => 'Add authors', 'icon' => 'fa-users'],
        3 => ['label' => 'Upload review manuscript', 'icon' => 'fa-file-pdf']
    ];
?>
<div class="d-flex justify-content-center align-items-center mb-4">
    <?php foreach ($steps as $step => $info): ?>
        <div class="text-center mx-4">
            <div class="rounded-circle 
                        d-flex justify-content-center align-items-center
                        <?= $currentStep == $step ? 'bg-primary text-white' : 'bg-secondary text-white' ?>"
                 style="width: 40px; height: 40px;">
                <i class="fas <?= $info['icon'] ?>"></i>
            </div>
            <small class="<?= $currentStep == $step ? 'text-primary font-weight-bold' : 'text-muted font-weight-bold' ?> d-block mt-2">
                <?= $info['label'] ?>
            </small>
        </div>
        <?php if ($step < count($steps)): ?>
            <div style="width: 60px; height: 2px; background-color: #ccc;"></div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php } ?>
