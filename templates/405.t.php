<?php $t->extend('layout-error') ?>
<?php $t['title'] = '405 Method not allowed' ?>
<?php $t->section('main', function() { ?>
    <div id="oops">
        <h1>Oops...</h1>
        <p>405 Method not allowed</p>
        <a href="<?php echo $this->siteUrl() ?>">Home</a>
    </div>
<?php }) ?>