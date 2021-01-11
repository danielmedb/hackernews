const editComment = document.querySelectorAll(".btn-editComment");

function passwordReset(){
    const resetpassword = document.querySelector(".resetpassword");
    resetpassword.addEventListener('click', () => {
        document.querySelector('.form_resetpassword').style.display = 'block';
    });
}

