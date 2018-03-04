<?php

/**
* OLD KINGDOM TEMPLATE
*
* @link     https://flawedspirit.com
* @author   Flawedspirit <me@flawedspirit.com>
* @license  GPL 2 (http://gnu.org/licenses/old-licenses/gpl-2.0.html)
*/

if (!defined('DOKU_INC')) die();

?>

<!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <?php tpl_metaheaders() ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=El+Messiri:400,500,700">
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
    
    <title><?php tpl_pagetitle() ?> &ndash; <?php echo hsc($conf['title']) ?></title>
    <script>
        (function(H) {
            H.className = H.className.replace(/\bno-js\b/,'js');
        }) (document.documentElement);
    </script>
</head>
<body id="dokuwiki__top">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/"><?php echo $conf['title']; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <div class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="wiki_tools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Wiki Tools</a>
                            <div class="dropdown-menu" aria-labelledby="wiki_tools">
                                <div class="dropdown-item">
                                    <ul class="list-unstyled">
                                        <?php
                                            tpl_toolsevent('pagetools', array(
                                                'edit'      => tpl_action('edit', 1, 'li', 1),
                                                'revisions' => tpl_action('revisions', 1, 'li', 1),
                                                'backlink'  => tpl_action('backlink', 1, 'li', 1),
                                                'subscribe' => tpl_action('subscribe', 1, 'li', 1),
                                                'revert'    => tpl_action('revert', 1, 'li', 1)
                                            ));
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="user_tools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Tools</a>
                            <div class="dropdown-menu" aria-labelledby="user_tools">
                                <div class="dropdown-item">
                                    <ul class="list-unstyled">
                                        <?php
                                            if(!empty($_SERVER['REMOTE_USER'])) {
                                                tpl_userinfo(); /* Logged in as... */
                                                echo '<li class="divider"></li>';
                                                tpl_toolsevent('usertools', array(
                                                    tpl_action('admin', 1, 'li', 1),
                                                    tpl_action('profile', 1, 'li', 1),
                                                    tpl_action('register', 1, 'li', 1),
                                                    tpl_action('login', 1, 'li', 1)
                                                ));
                                            } else {
                                                tpl_toolsevent('usertools', array(
                                                    tpl_action('login', 1, 'li', 1)
                                                ));
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <?php tpl_searchform(); ?>
                        </li>
                    </ul>                    
                </div>
            </div>
        </div>
    </nav>

    <div id="breadcrumb" class="separator-bar">
        <!-- BREADCRUMBS -->
        <?php if($conf['breadcrumbs'] || $conf['youarehere']): ?>
            <div class="container">
                <?php if($conf['youarehere']): ?>
                    <div class="youarehere"><?php tpl_youarehere() ?></div>
                <?php endif ?>
                <?php if($conf['breadcrumbs']): ?>
                    <div class="trace"><?php tpl_breadcrumbs() ?></div>
                <?php endif ?>
            </div>
        <?php endif ?>
    </div>

    <?php
        // render the content into buffer for later use
        ob_start();
        tpl_content();
        $buffer = ob_get_clean();
    ?>

    <main class="container py-3" role="main">
        <div id="content">
            <?php echo $buffer; ?>
        </div>
    </main>

    <div id="pre-footer" class="separator-bar">
        <div class="container">
            <?php tpl_pageinfo(); ?>
        </div>
    </div>

    <footer class="footer">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <div class="container">
            <a href="#dokuwiki__top">Top of Page</a><?php tpl_indexerWebBug(); ?>
        </div>
    </footer>
</body>
</html>
