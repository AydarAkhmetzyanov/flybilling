$(document).ready(function () {
    closeAll();
});

function closeAll(){
    $('#personData').hide();
    $('#ppData').hide();
    $('#companyData').hide();
    $('#companyUData').hide();
    $('#bankData').hide();
    $('#regFinish').hide();
    $('input[name="firstName"]').removeAttr("required");                   
    $('input[name="secondName"]').removeAttr("required"); 
    $('input[name="WMR"]').removeAttr("required"); 
    $('input[name="PName"]').removeAttr("required"); 
    $('input[name="PFIO"]').removeAttr("required"); 
    $('input[name="PINN"]').removeAttr("required"); 
    $('input[name="POGRN"]').removeAttr("required"); 
    $('input[name="PSGRN"]').removeAttr("required"); 
    $('input[name="PSGRD"]').removeAttr("required"); 
    $('input[name="CName"]').removeAttr("required"); 
    $('input[name="CINN"]').removeAttr("required"); 
    $('input[name="CKPP"]').removeAttr("required"); 
    $('input[name="COGRN"]').removeAttr("required"); 
    $('input[name="CFIO"]').removeAttr("required"); 
    $('input[name="CFIOR"]').removeAttr("required"); 
    $('input[name="CPPos"]').removeAttr("required"); 
    $('input[name="CPDoc"]').removeAttr("required"); 
    $('input[name="UAddr"]').removeAttr("required"); 
    $('input[name="UPostAddr"]').removeAttr("required"); 
    $('input[name="bankName"]').removeAttr("required"); 
    $('input[name="bankBIK"]').removeAttr("required"); 
    $('input[name="bankKor"]').removeAttr("required"); 
    $('input[name="bankAcc"]').removeAttr("required"); 
}

function openPerson(){
    closeAll();
    $('#regFinish').show();
    $('#personData').show();

    $('input[name="firstName"]').attr("required","required");                   
    $('input[name="secondName"]').attr("required","required");
    $('input[name="WMR"]').attr("required","required");
}

function openPP(){
    closeAll();
    $('#regFinish').show();
    $('#ppData').show();
    $('#companyUData').show();
    $('#bankData').show();

    $('input[name="PName"]').attr("required","required");
    $('input[name="PFIO"]').attr("required","required");
    $('input[name="PINN"]').attr("required","required");
    $('input[name="POGRN"]').attr("required","required");
    $('input[name="PSGRN"]').attr("required","required");
    $('input[name="PSGRD"]').attr("required","required");

    $('input[name="UAddr"]').attr("required","required");
    $('input[name="UPostAddr"]').attr("required","required");
    $('input[name="bankName"]').attr("required","required");
    $('input[name="bankBIK"]').attr("required","required");
    $('input[name="bankKor"]').attr("required","required");
    $('input[name="bankAcc"]').attr("required","required");
}

function openCompany(){
    closeAll();
    $('#regFinish').show();
    $('#companyData').show();
    $('#companyUData').show();
    $('#bankData').show();

    $('input[name="CName"]').attr("required","required");
    $('input[name="CINN"]').attr("required","required");
    $('input[name="CKPP"]').attr("required","required");
    $('input[name="COGRN"]').attr("required","required");
    $('input[name="CFIO"]').attr("required","required");
    $('input[name="CFIOR"]').attr("required","required");
    $('input[name="CPPos"]').attr("required","required");
    $('input[name="CPDoc"]').attr("required","required");

    $('input[name="UAddr"]').attr("required","required");
    $('input[name="UPostAddr"]').attr("required","required");
    $('input[name="bankName"]').attr("required","required");
    $('input[name="bankBIK"]').attr("required","required");
    $('input[name="bankKor"]').attr("required","required");
    $('input[name="bankAcc"]').attr("required","required");
}