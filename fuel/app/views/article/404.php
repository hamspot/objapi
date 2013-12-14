<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <?php echo Asset::css('bootstrap.css'); ?>
</head>
<body>
        <header>
                <div class="container">
                        <div id="logo"></div>
                </div>
        </header>
        <div class="container">
                <div class="row">
                        <div class="col-md-12">
                                <h1><?php echo $title; ?> <small>We can't find that article!</small></h1>
                        </div>
                </div>
                <footer>
                        <p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
                </footer>
        </div>
</body>
</html>
