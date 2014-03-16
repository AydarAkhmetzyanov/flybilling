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

        <div class="navbar navbar-inverse navbar-fixed-top navbar-console">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="/console"></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="/administration">Home</a></li>
                            <li><a href="/administration/services">Сервисы</a></li>
                            <li><a href="/administration/analytics">Статистика</a></li>
                            <li><a href="/administration/documentation">Помощь</a></li>
                            <li><a href="/administration">Тикеты</a></li>
                        </ul>
                        <div class="pull-right">
                            <ul class="nav">
                                <li>
                                    <!-- <a href="#" class="notific" title="Уведомления"><span class="badge badge-success">21</span></a> -->
                                    <div class="dropdown">
                                        <a id="dLabel" data-toggle="dropdown" data-target="#" href="#"><?php echo $_SESSION['email']; ?> &#x25BC;</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li><a href="/login/logout">Выход</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="last">
                                    <div class="langs">
                                        <a href="/" rel="nofollow" title="Русский" class="rus"></a>
                                       <!-- <a href="/en" title="English" class="eng"></a>-->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>