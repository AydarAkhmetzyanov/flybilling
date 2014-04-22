        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->



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
                            <li><a href="/administration/sql?query=SELECT+*+FROM+<?=SCHEMA?>.%5BClients%5D%2C<?=SCHEMA?>.%5BClientsPrivateData%5D+WHERE+<?=SCHEMA?>.%5BClients%5D.%5BID%5D%3D<?=SCHEMA?>.%5BClientsPrivateData%5D.%5BID%5D%3B">Users</a></li>
                            <li><a href="/administration/analytics">Analytics</a></li>
                            <li><a href="/administration/tickets">Tickets</a></li>
                            <li><a href="/administration/withdrawals">Withdrawals</a></li>
                            <li><a href="/administration/sql?query=SELECT+*+FROM+<?=SCHEMA?>.%5BSMSServices%5D%3B">Services</a></li>
                            <li><a href="/administration/rates/">Rates</a></li>
                            <li><a href="/administration/sql?query=SELECT+*+FROM+<?=SCHEMA?>.%5BFines%5D%3B">Fines</a></li>
                            <li><a href="/administration/sql">SQL</a></li>
                            <li><a href="/administration/sql?query=SELECT+*+FROM+<?=SCHEMA?>.%5BErrorLog%5D%3B">System errors</a></li>
                        </ul>
                        <div class="pull-right">
                            <ul class="nav">
                                <li>
                                    <!-- <a href="#" class="notific" title="Уведомления"><span class="badge badge-success">21</span></a> -->
                                   
                                            <li><a href="/login/logout">Logout</a></li>
                                       
                                </li>
                            </ul>
                        </div>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>