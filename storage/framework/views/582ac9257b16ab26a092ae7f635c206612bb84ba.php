<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo e(setting('site_title')); ?> | <?php echo e(setting('site_name')); ?></title>

        <!-- favicon -->
        <link rel="icon" type="image/png" href="<?php echo e(asset('logo/Logo1.png')); ?>">

        <!-- icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!-- Main Style -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('home/css/style.css')); ?>">

        <script type="text/javascript" src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <?php echo \Livewire\Livewire::styles(); ?>

    </head>
    <body>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('homepage.home-nav', [])->html();
} elseif ($_instance->childHasBeenRendered('iPsuaHN')) {
    $componentId = $_instance->getRenderedChildComponentId('iPsuaHN');
    $componentTag = $_instance->getRenderedChildComponentTagName('iPsuaHN');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iPsuaHN');
} else {
    $response = \Livewire\Livewire::mount('homepage.home-nav', []);
    $html = $response->html();
    $_instance->logRenderedChild('iPsuaHN', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('homepage.home-section', [])->html();
} elseif ($_instance->childHasBeenRendered('bkmQd5D')) {
    $componentId = $_instance->getRenderedChildComponentId('bkmQd5D');
    $componentTag = $_instance->getRenderedChildComponentTagName('bkmQd5D');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('bkmQd5D');
} else {
    $response = \Livewire\Livewire::mount('homepage.home-section', []);
    $html = $response->html();
    $_instance->logRenderedChild('bkmQd5D', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('homepage.menu-section', [])->html();
} elseif ($_instance->childHasBeenRendered('Nrb1Bg7')) {
    $componentId = $_instance->getRenderedChildComponentId('Nrb1Bg7');
    $componentTag = $_instance->getRenderedChildComponentTagName('Nrb1Bg7');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Nrb1Bg7');
} else {
    $response = \Livewire\Livewire::mount('homepage.menu-section', []);
    $html = $response->html();
    $_instance->logRenderedChild('Nrb1Bg7', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('homepage.team-section', [])->html();
} elseif ($_instance->childHasBeenRendered('e1hGaD0')) {
    $componentId = $_instance->getRenderedChildComponentId('e1hGaD0');
    $componentTag = $_instance->getRenderedChildComponentTagName('e1hGaD0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('e1hGaD0');
} else {
    $response = \Livewire\Livewire::mount('homepage.team-section', []);
    $html = $response->html();
    $_instance->logRenderedChild('e1hGaD0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('homepage.order-section', [])->html();
} elseif ($_instance->childHasBeenRendered('xQJzCzr')) {
    $componentId = $_instance->getRenderedChildComponentId('xQJzCzr');
    $componentTag = $_instance->getRenderedChildComponentTagName('xQJzCzr');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('xQJzCzr');
} else {
    $response = \Livewire\Livewire::mount('homepage.order-section', []);
    $html = $response->html();
    $_instance->logRenderedChild('xQJzCzr', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('homepage.contact-section', [])->html();
} elseif ($_instance->childHasBeenRendered('oWcfHCV')) {
    $componentId = $_instance->getRenderedChildComponentId('oWcfHCV');
    $componentTag = $_instance->getRenderedChildComponentTagName('oWcfHCV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('oWcfHCV');
} else {
    $response = \Livewire\Livewire::mount('homepage.contact-section', []);
    $html = $response->html();
    $_instance->logRenderedChild('oWcfHCV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <script type="text/javascript" src="<?php echo e(asset('home/js/script.js')); ?>"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            window.addEventListener('swal:modal', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    timer: 3000,
                });
            });
        </script>
        <?php echo \Livewire\Livewire::scripts(); ?>

    </body>
</html><?php /**PATH D:\Dynamic Website Project\SAWMS\SAROS-orderSYS\resources\views/layouts/homepage.blade.php ENDPATH**/ ?>