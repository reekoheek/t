T Template
==========

Enough with templating engine holy war in PHP? Need something as simple as plain old PHP script as template? But after you enjoy with sophistication of another PHP template you miss some great features there?

I do.

T Template is just simple PHP template you can do plain php scripting there. Steroids come with T Template are:

- Extending another template
- Create section and override section

## How to Install

You can use composer to install this thing.

## How to Use

In my use case, it's simple use case, such instantiating new T Template to render single template.

```php
use T\T;

$t = new T('../templates'); // '../templates' will be your base 
                            // templates directory
$t->render('/home'); // '/home' will be plain php template file 
                     // relative to your base template directory above,
                     // but you ommit the file extension (.php)
```

And then put the plain php template to the base template directory specified, in this case it would be at '../templates'.

### Using Sections for Template

Even though you can use this as simple plain old PHP template, bear to mind, that you can also create sections inside your template.

The advantages creating sections are:

- Modularity, your template codes will be easier to maintain (hope so), because every part of your building block of template will be separated as single section. The aim is "Separation of Concerns".
- Reusability, sections is easy to use and override if you want to.

I recommend you to use sections.

#### Creating section, as follows,

```php
<?php $t->section('header', function() { ?>
<header>
    <a href="#">Title</a>
</header>
<?php }) ?>
```

#### Using section inside another section, as follows,

```php
<?php $t->section('page', function() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php $this->show('header') ?>
    <?php $this->show('body') ?>
    <?php $this->show('footer') ?> 
</body>
</html>
<?php }) ?>

<?php $t->section('body', function() { ?>
<div>
    <h1>Lorem Ipsum</h1>
    <p>Curae lacus amet. Lacus etiam mauris bibendum morbi sollicitudin curae. Nulla morbi. Etiam magna dolor duis sociis est ornare ad felis. Velit donec rutrum libero vivamus eget nunc dis nunc torquent sit. Class lorem porta eleifend id leo. Massa porta rutrum in tempor accumsan erat sem risus tincidunt. Velit fames. Velit risus erat nullam congue ante condimentum dis lectus dapibus cras arcu. Nulla netus pulvinar curabitur eu phasellus.</p>
</div>
<?php }) ?>
``` 

Don't worry, if you manage to use section that is not created yet. It won't break. Feel free to plan your template.

T Template will trigger first section registered as initial section to show, so you don't have to call it manually.

### Extending Template

Extending '/home' template is easy. You can put '/layout' as new template inside base template directory and then put this line at first line of your template.

```php
<?php $t->extend('layout') ?>

...
```

And because the first section registered will be the trigger of initial show, your first super template section will be that one.


