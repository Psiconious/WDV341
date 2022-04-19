let signInTab;
let signUptab;
let signInForm;
let signUpForm;
let signInLabel;
let signUpLabel;

function PageLoad(){
    console.log("Working.");
    signInTab = document.getElementById("login");
    signUptab = document.getElementById("register");
    signInForm = document.getElementById("login-form");
    signUpForm = document.getElementById("register-form");
    signInLabel = document.getElementById("login-label");
    signUpLabel = document.getElementById("register-label");

    console.log(signInTab);
    console.log(signUptab);

    signInTab.onclick = function(){formTabClicked()};
    signUptab.onclick = function(){formTabClicked()};

}

function formTabClicked(){
    if(signInTab.checked){
        signInForm.className = "login-register-form";
        signUpForm.className = "login-register-form-hidden";
        signInLabel.className = "active";
        signUpLabel.className = "";
    }
    else if(signUptab.checked){
        signUpForm.className = "login-register-form";
        signInForm.className = "login-register-form-hidden";
        signUpLabel.className = "active";
        signInLabel.className = "";
    }
}