function logIn(){
$.post(
  "/administration/login",
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
          window.location="/administration/";
          break;
        case 1:
          alert("Неверный логин и/или пароль");
          break;
    }
}