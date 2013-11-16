function logIn(){
$.post(
  "/login/login",
  $("#logInForm").serialize(),
  onLogIn,
  "text"
);
		return false;
}

function onLogIn(data)
{
    oresult = jQuery.parseJSON(data);
    switch(oresult.error)
{
case 0:
 window.location="/client/";
  break;
case 1:
  alert("Email не найден");
  break;
case 2:
  alert("Введите верный пароль");
  break;
case 3:
  alert("Вы не подтвердили email, проверьте вашу почту или напишите нам (info@flybill.ru) заявку на смену email адреса с указанием ваших персональных данных и пароля.");
  break;
default:
  alert("Ошибка, попробуйте позже или обратитесь в техническую поддержку");
}
}

function demoAccess() {
    $('#inputEmail').attr('value','test@flybill.ru');
    $('#inputPassword').attr('value','test');
    logIn();
}