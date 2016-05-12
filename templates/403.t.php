<?php $t->extend('layout-error') ?>
<?php $t['title'] = '403 Forbidden' ?>
<?php $t->section('main', function() { ?>
    <div id="oops">
        <h1>Oops...</h1>
        <p>403 Forbidden</p>
        <a href="<?php echo $this->siteUrl() ?>">Home</a>
    </div>
<?php }) ?>