const form = document.querySelector("form"),
  emailField = form.querySelector(".email-field"),
  emailInput = emailField.querySelector(".email"),
  passField = form.querySelector(".enter-password"),
  passInput = passField.querySelector(".password");
  

function checkEmail() {
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!emailInput.value.match(emailPattern)) {
    return emailField.classList.add("invalid"); 
  }
  emailField.classList.remove("invalid"); 
}


const eyeIcons = document.querySelectorAll(".show-hide");

eyeIcons.forEach((eyeIcon) => {
  eyeIcon.addEventListener("click", () => {
    const pInput = eyeIcon.parentElement.querySelector("input"); 
    if (pInput.type === "password") {
      eyeIcon.classList.replace("bx-hide", "bx-show");
      return (pInput.type = "text");
    }
    eyeIcon.classList.replace("bx-show", "bx-hide");
    pInput.type = "password";
  });
});


function enterPass() {
    const passPattern = /.+/;
  
    if (!passInput.value.match(passPattern)) {
      return passField.classList.add("invalid"); 
    }
    passField.classList.remove("invalid"); 
  }

 
emailInput.addEventListener("keyup", checkEmail);
passInput.addEventListener("keyup", enterPass);

form.addEventListener("submit", (e) => {
  e.preventDefault(); 
  checkEmail();
  enterPass();

  if (
    !emailField.classList.contains("invalid") &&
    !passField.classList.contains("invalid") 
  ) {
    location.href = form.getAttribute("action");
  }
});


function goBack() {
    window.history.back();
}