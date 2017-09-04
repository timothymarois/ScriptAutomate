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
        <link rel="stylesheet" href="/resources/vendor/select2/css/select2.min.css">
        <link rel="stylesheet" href="/resources/css/main.css?_t=<?=time()?>">

        <script src="/resources/js/jquery.min.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>

        <script src="/resources/vendor/screenfull/src/screenfull.js"></script>
        <script src="/resources/vendor/select2/js/select2.min.js"></script>

    </head>
    <body style="overflow:hidden">
        <!-- Page Container sidebar-mini-->
        <div id="page-container" class="header-navbar-fixed ">

            <!-- Header -->
            <header id="header-navbar" class="content-mini content-mini-full">
                <ul class="nav-header pull-left">

                    <li class="hidden-xs hidden-sm">
                        <a href="javascript://" class="btn btn-default btn-light toggle-fs">
                            <!--<i class="fa fa-arrows-alt"></i>-->
                            FS
                        </a>
                    </li>

                    <li class="hidden-xs hidden-sm">
                        <a href="/" class="btn btn-default btn-light">
                            Reset
                        </a>
                    </li>

                    <li>
                        <select class="select2 engineSelection" style="width:300px;">

                            <?

                            foreach($scriptGroup as $group=>$scripts)
                            {
                                ?><optgroup label="<?=$group?>"><?

                                foreach($scripts as $script)
                                {
                                    ?><option value="<?=$script?>"><?=$script?></option><?
                                }

                                ?></optgroup><?
                            }

                            ?>
                        </select>
                    </li>

                    <li>
                        <a href="javascript://" class="btn btn-default btn-light btn-exe">
                            <i class="fa fa-play icon-run"></i><!--<i class="fa fa-cog fa-spin icon-runner" style="display:none;    color: #ff0000;    font-size: 18px;"></i> --><div style="display:none;color: #ff0000;" class="loader icon-runner"></div> <span class="exetxt">Execute</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript://" class="btn btn-default btn-light btn-stop">
                            <i class="fa fa-stop"></i> Stop
                        </a>
                    </li>

                </ul>

                <ul class="nav-header pull-right">

                    <li class="hidden-xs hidden-sm">
                        <a href="javascript://" class="btn btn-default btn-light toggle-up">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>

                    <li class="hidden-xs hidden-sm">
                        <a href="javascript://" class="btn btn-default btn-light toggle-down">
                            <i class="fa fa-chevron-down"></i>
                        </a>
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

                $('.btn-exe').on('click', function(e) {
                    e.preventDefault();

                    var script = $('.engineSelection').val();
                    document.getElementById('systemview').src = '/run/'+script;

                    $('.icon-run').hide();
                    $('.icon-runner').show();
                    $('.exetxt').text('');

                    var intv = setInterval(function()
                    {
                        window.frames[0].onload = function()
                        {
                            $('.icon-runner').hide();
                            $('.icon-run').show();
                            $('.exetxt').text('Execute');
                            clearInterval(intv);
                        };
                    },5);

                });

                $('.toggle-fs').on('click', function(e) {
                    e.preventDefault();

                    if (screenfull.enabled)
                    {
                        screenfull.toggle();
                    }
                });


                $('.btn-stop').on('click', function(e) {
                    e.preventDefault();

                    if (typeof (window.frames[0].stop) === 'undefined')
                    {
                        window.frames[0].document.execCommand('Stop');
                    }
                    else
                    {
                        window.frames[0].stop();
                    }

                    $('.icon-runner').hide();
                    $('.icon-run').show();
                    $('.exetxt').text('Execute');
                });


                $('.toggle-up').on('click',function(e){
                    e.preventDefault();
                	window.frames[0].scrollTo(0,0);
                });

                $('.toggle-down').on('click',function(e){
                    e.preventDefault();
                	window.frames[0].scrollTo(0,window.frames[0].document.body.scrollHeight);
                });

           });
        </script>

    </body>
</html>
