<div id="is-main-page"></div>
        <div class="top-promo">
            <div class="container">
                <div class="hero-unit">
                    <h1><?=SHORT_BRAND?> Лучший СМС биллинг</h1>
                    <div class="promo-descr span6">
                    <p>СМС биллинг <?=SHORT_BRAND?> нацелен на современный интернет-бизнес, в котором происходит большое количество микроплатежей. <?=BRAND?> - молодая и быстроразвивающаяся компания, предоставляющая широкий спектр услуг, инновационную платформу и лучшие тарифы среди смс биллингов.</p>
					<?php //if(!(Clients::isAuth())) : ?>
                    <p>
                        <a href="/registration" class="reg-btn">Регистрация</a>
                        <a href="/login" class="enter-btn">Вход</a>
                    </p>
					<?php //endif; ?>
                    </div>
                </div>
                <div class="promo-phone"></div>
                <div class="promo-3angl-1" data-stellar-ratio="2" data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
                <div class="promo-3angl-2" data-stellar-ratio="1.5"  data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
            </div>
            <div class="promo-3angl-3" data-stellar-ratio="1.1"  data-stellar-vertical-offset="20"></div>
            <div class="promo-top-bottom"></div>
        </div>


        <div class="container">
            <div class="row services">
                <h2 id="services">Услуги СМС биллинга</h2>
                <div class="row billing-services">
                    <div class="polygon-1" data-stellar-ratio="0.8"  data-stellar-vertical-offset="550"></div>
                    <div class="span6">
                        <div class="premium-sms-circle">
                            <div class="premium-sms-content">
                                <a href="/services/premium" class="title"><h3>Премиум СМС</h3></a>
                                <p>Самый распространенный вид оплаты. Абонент отправляет смс на короткий номер и с него снимают сумму согласно тарифу оператора на короткий номер.</p>
                                <div class="more-tariffs"><a href="/services/premium">Подробнее</a><a href="/services/premium#rates">Тарифы</a></div>
                            </div>
                            <div class="premium-sms-3angle" data-stellar-ratio="1.3"  data-stellar-vertical-offset="150" data-stellar-horizontal-offset="160"></div>
                        </div>
                    </div>
                    <div class="span6">
                        <a href="/services/mosubscriptions" class="title"><h3>Псевдо подписки</h3></a>
                        <p>Абонент вводит на сайте свой номер телефона, после чего ему приходит сообщение от короткого номера, ответив на которое, он получает свою услугу.</p>
                        <div class="more-tariffs"><a href="/services/mosubscriptions">Подробнее</a><a href="/services/mosubscriptions#rates">Тарифы</a></div>

                        <a href="/services/mtsubscriptions" class="title"><h3>МТ подписки</h3></a>
                        <p>Оплата без исходящего сообщения. Человек вводит на сайте свой номер, ему приходит смс с кодом который он должен ввести на том же сайте, для активации подписки.</p>
                        <div class="more-tariffs"><a href="/services/mtsubscriptions">Подробнее</a><a href="/services/mtsubscriptions#rates">Тарифы</a></div>
                   </div>
                </div>
            </div>
        </div>

        <div class="row advant">
            <div class="advant-top"></div>
            <h2 id="about">Преимущества</h2>
            <div class="container">
                <div class="span5 item">
                    <img src="img/advant-1.jpg" alt="" />
                    <div class="text">
                        <h3>Инновационная платформа</h3>
                        <p>Наша система работает на облачной платформе Microsoft Azure, что обеспечивает высокую доступность с SLA 99,9%</p>
                    </div>
                </div>
                <div class="span5 item">
                    <img src="img/advant-2.jpg" alt="" />
                    <div class="text">
                        <h3>Высокие отчисления</h3>
                        <p>Работая с нами, Вы получите одни из лучших условий на рынке.</p>
                    </div>
                </div>
                <div class="span5 item">
                    <img src="img/advant-3.jpg" alt="" />
                    <div class="text">
                        <h3>Широкий выбор платежей</h3>
                        <p>Выбирайте из всех современных типов мобильных платежей — <a href="/services/premium">Premium SMS</a>, <a href="/services/mosubscriptions">Псевдо подписки</a> и  <a href="/services/mtsubscriptions">МТ подписки</a>.</p>
                    </div>
                </div>
                <div class="span5 item">
                    <img src="img/advant-4.jpg" alt="" />
                    <div class="text">
                        <h3>Работа по всей Европе</h3>
                        <p>Мы предлагаем вам работу с мобильными платежами по всей Европе. Не ограничивайтесь одной страной.</p>
                    </div>
                </div>
            </div>
            <div class="advant-3angl-1" data-stellar-ratio="1.5"  data-stellar-vertical-offset="100"></div>
            <div class="advant-3angl-2" data-stellar-ratio="1.1"  data-stellar-vertical-offset="100"></div>
            <div class="polygon-2" data-stellar-ratio="0.8"  data-stellar-vertical-offset="550"></div>
            <div class="polygon-3" data-stellar-ratio="0.8"  data-stellar-vertical-offset="550"></div>
            <div class="advant-bottom"></div>
        </div>

        <div class="container">
            <div class="row clients">
                <h2 id="clients">Кому мы предоставляем услуги</h2>

                <div class="span4">
                    <h3>Владельцам сайтов и социальных сетей</h3>
                    <p>Самый простой способ монетизировать сайт или социальную сеть невзирая на тематику сайта. Это может быть продажа доступа в приватный раздел получения привилегированного аккаунта, снятие рекламы, начисление бонусов в торрент трекерах, увеличение скорости скачивания файлов. </p>
                </div>
                <div class="span4">
                    <h3>Онлайн играм</h3><br />
                    <p>Очень бурно растущий рынок онлайн игр открывает безлимитные возможности для монетизации и получения максимальной прибыли благодаря своей простоте SMS оплата занимает лидирующее место в списке приема оплат на игровых сайтах.</p>
               </div>
                <div class="span4">
                    <h3>Партнерским программам</h3><br />
                    <p>Партнерские программы по разделению прибыли являются очень быстрым и надежным решением для увеличения прибыли онлайн магазинов платных сайтов, сервисов знакомств.</p>
                </div>


            </div>

            
            <!--
            <div class="row responses">
                <h2>Отзывы наших клиентов</h2>
                <div class="resp-slider">
                    <div class="resp-slider-slides">
                        <div class="slide span8">
                            <img src="img/client-photo.jpg" class="photo" />
                            <div class="text">
                                <p>Самый простой способ монетизировать сайт или социальную сеть невзирая на тематику сайта. Это может быть продажа доступа в приватный раздел  получения привилегированного аккаунта, снятие рекламы, начисление бонусов в торрент трекерах, увеличение скорости скачивания файлов. Аналогичные сервисы могут быть введены в социальных сетях. И это только пример того как можно монетизировать ваши существующие или будущие проекты.</p>
                                <p class="author">Имя Фамилия, ItCompany</p>
                            </div>
                        </div>
                        <div class="slide span8">
                            <img src="img/client-photo.jpg" class="photo" />
                            <div class="text">
                                <p>Самый простой способ монетизировать сайт или социальную сеть невзирая на тематику сайта. Это может быть продажа доступа в приватный раздел  получения привилегированного аккаунта, снятие рекламы, начисление бонусов в торрент трекерах, увеличение скорости скачивания файлов. Аналогичные сервисы могут быть введены в социальных сетях. И это только пример того как можно монетизировать ваши существующие или будущие проекты.</p>
                                <p class="author">Имя Фамилия, ItCompany</p>
                            </div>
                        </div>
                    </div>
                    <div class="arrow to-left"></div>
                    <div class="arrow to-right"></div>
                </div> 
            </div>
            -->

        </div>
        
        
