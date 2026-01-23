<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href='<?= base_url("assets/css/css7888.css?family=Dosis:400,500,700") ?>' rel='stylesheet' type='text/css'>
    <link href='<?= base_url("assets/css/cssaa4a.css?family=Open+Sans:400,700") ?>' rel='stylesheet' type='text/css'>
    
    <link rel="shortcut icon" href="<?=base_url("favicon.png")?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css") ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url("assets/css/plugin.css") ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url("assets/css/style.css") ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url("assets/css/responsive.css") ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url("assets/css/admin.css") ?>" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.js") ?>"></script>
    <script>
    // Load jQuery UI and nestedSortable from CDN with local fallback
    (function(){
        var addScript = function(src){ var s = document.createElement('script'); s.src = src; document.head.appendChild(s); };
        // jQuery UI (UI core + widget needed for nestedSortable)
        var uiCdn = 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js';
        var nsCdn = 'https://cdnjs.cloudflare.com/ajax/libs/nestedSortable/2.1.0/jquery.mjs.nestedSortable.min.js';
        // insert CDN scripts
        addScript(uiCdn);
        addScript(nsCdn);
        // small timeout to check existence and fallback to local vendor files
        setTimeout(function(){
            if (typeof jQuery.ui === 'undefined') {
                addScript('<?= base_url("assets/js/vendor/jquery-ui.min.js") ?>');
            }
            if (typeof jQuery().mjsNestedSortable === 'undefined' && typeof jQuery.mjs === 'undefined' && typeof jQuery.fn.nestedSortable === 'undefined') {
                addScript('<?= base_url("assets/js/vendor/jquery.mjs.nestedSortable.min.js") ?>');
            }
        }, 600);
    })();
    </script>
    <title><?= (isset($title)) ? $title : "Welcome Home" ?> | Lucid Stars Montessori </title>
    <!--[if gte IE 9]>
          <style type="text/css">
            .gradient {
               filter: none;
            }
          </style>
		<![endif]-->
    <style>
        .logo-text {
            font-weight: 500;
            font-size: 25px;
            margin-top: 10px;
            color:
        }

        .mobile-menu {
            text-align: right;
            margin-top: -60px;
        }
    </style>
</head>

<body>
<div id="main-wrapper" class="animsition clearfix">