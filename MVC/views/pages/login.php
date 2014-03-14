<?php echo HTML::includeJS('login');?>
<div class="top-promo-bgsub"><img src="img/hero-bg.png"></div>
        <div class="top-promosub">
            <div class="container">
                <div class="hero-unit">
                    <br><br>
                    <h1><?=$title?></h1>
                    
                </div>
            </div>
           
        </div>

        <div class="row content">
            
            <div class="container">
            <div class="content-inner">
<form id="logInForm" onSubmit="return logIn()" class="form-horizontal" style="margin-bottom:150px;">
    <p><span class="dotted-link" onclick="demoAccess();">Протестировать сервис</span></p>
						<div class="control-group">
							<label class="control-label" for="inputEmail">Email</label>
							<div class="controls">
								<input required type="email" name="email" id="inputEmail" placeholder="Email">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputPassword">Пароль</label>
							<div class="controls">
								<input required minlength="6" type="password" name="password" id="inputPassword" placeholder="Пароль">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn">Войти</button>
							</div>
						</div>
					</form>
</div>
</div>