        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/<?=$locale?>/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="/"></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="<?php if(CONTROLLER!='index') echo '/';?>#services">Services</a></li>
                            <li><a href="<?php if(CONTROLLER!='index') echo '/';?>#about">About us</a></li>
                            <li><a href="<?php if(CONTROLLER!='index') echo '/';?>#clients">Clients</a></li>
                            <li><a href="<?php if(CONTROLLER!='index') echo '/';?>#contacts">Contacts</a></li>
                            <li class="spec"><a href="<?=SITE?>/reg">Sign up</a></li>
                            <li><a href="<?=SITE?>/login">Sign in</a></li>
                        </ul>
                        <form class="pull-right">
                            <div class="fb-like" data-href="<?=SITE?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="true" data-font="arial" data-colorscheme="dark"></div>

                            <!-- Place this tag where you want the +1 button to render -->
                            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="200" data-href="<?=SITE?>"></div>

                            <!-- Place this render call where appropriate -->
                            <script type="text/javascript">
                              window.___gcfg = {lang: 'ru'};

                              (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                              })();
                            </script>

                            <div class="langs">
                                <a href="/" rel="nofollow" title="Русский" class="rus"></a>
                                <a href="/en" title="English" class="eng"></a>
                            </div>
                        </form>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>