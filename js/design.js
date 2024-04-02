const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");
const container = document.getElementById("container");

registerButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});


function checkRequiredLg(inputArr2) {
  let isRequiredLg = false
  inputArr2.forEach(function (input) {
    if (input.value.trim() === '') {
      showError2(input, `*${getFieldNameLg(input)} Please enter your information in this field`)
      isRequiredLg = true
    } else {
      showSuccess2(input)
    }
  })

  return isRequiredLg
}

function hideErrorMessage() {
  var errorMessage = document.getElementById('error-message');
  if (errorMessage) {
    setTimeout(function () {
      errorMessage.style.display = 'none';
    }, 2500);
  }
}
window.onload = function () {
  hideErrorMessage();
}