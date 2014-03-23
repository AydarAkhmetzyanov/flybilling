<?php echo HTML::includeJS('loginAdmin');?>

        <div class="top-promosub">
            <div class="container">
                <div class="hero-unit">
                    <br><br>
                    <h1><?=$title?></h1>
                    
                </div>
            </div>
           
        </div>

        <div class="container content">
            

            <div class="content-inner">
					<form id="logInForm" onSubmit="return logIn()" class="form-horizontal" style="margin-bottom:150px;">
						<div class="control-group">
							<label class="control-label" for="inputEmail">Логин</label>
							<div class="controls">
								<input required type="text" name="login" id="input-login" placeholder="Логин">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputPassword">Пароль</label>
							<div class="controls">
								<input required minlength="6" type="password" name="password" id="input-password" placeholder="Пароль">
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
