<?php $t->extend('layout-error') ?>
<?php $t['title'] = '404 Not found' ?>
<?php $t->section('main', function() { ?>
    <div id="oops">
        <h1>Oops...</h1>
        <p>404 Not Found</p>
        <a href="<?php echo $this->siteUrl() ?>">Home</a>
    </div>
<?php }) ?>