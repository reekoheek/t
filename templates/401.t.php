<?php $t->extend('layout-error') ?>
<?php $t['title'] = '401 Unauthorized' ?>
<?php $t->section('main', function() { ?>
    <div id="oops">
        <h1>Oops...</h1>
        <p>401 Unauthorized</p>
        <a href="<?php echo $this->siteUrl() ?>">Home</a>
    </div>
<?php }) ?>