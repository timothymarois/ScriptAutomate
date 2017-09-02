<!DOCTYPE html>
<!--[if IE 9]><html class="ie9 no-focus" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>ScriptAutomate</title>

        <meta name="description" content="">
        <meta name="author" content="Timothy Marois">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <link rel="stylesheet" href="/resources/css/reset.css">
        <link rel="stylesheet" href="/resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="/resources/css/main.css?_t=<?=time()?>">

        <script src="/resources/js/jquery.min.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>

        <script src="/resources/vendor/screenfull/src/screenfull.js"></script>

    </head>
    <body style="overflow:hidden">
        <!-- Page Container sidebar-mini-->
        <div id="page-container" class="header-navbar-fixed ">

            <!-- Header -->
            <header id="header-navbar" class="content-mini content-mini-full">
                <ul class="nav-header pull-left">
                    <li class="hidden-xs hidden-sm">
                        <button class="btn btn-default btn-light toggle-fs" style="padding: 5px 10px;font-size: 16px" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Toggle Fullscreen Mode">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                    </li>
                </ul>
            </header>
            <!-- END Header -->


            <!-- Main Container -->
            <main id="main-container">
                <?=$page?>
            </main>
            <!-- END Main Container -->


        </div>
        <!-- END Page Container -->

        <script>
            $(document).ready(function()
            {

                $('.toggle-fs').on('click', event => {
                    if (screenfull.enabled) {
                        screenfull.toggle();
                    }
                });

           });
        </script>

    </body>
</html>
