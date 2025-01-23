
function showMe(passwordFieldId, buttonId) {
    let passwordField = document.getElementById(passwordFieldId);
    let toggleButton = document.getElementById(buttonId);

    if (passwordField) {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.innerHTML = 'Hide';
        } else {
            passwordField.type = 'password';
            toggleButton.innerHTML = 'Show';
        }
    } else {
        console.log("No such data");
    }
}

function checkConfirmPassword(){

    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const errorContainer=document.getElementById('backendError');
    const errorMessage = document.getElementById('error');
    const buTTon =document.getElementById('submit');

    if (password != confirmPassword) {
     
        errorMessage.style.display = 'block'; 
        errorContainer.style.display='none';
        buTTon.disabled=true;
        console.log('password and confirm password did not match')
    } else {
        
        errorMessage.style.display = 'none';
        buTTon.disabled=false;
    }
}
