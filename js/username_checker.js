document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.querySelector('#username');
    const usernameFeedback = document.querySelector('.username-feedback');
    const signUpButton = document.querySelector('button[type="submit"]');

    usernameInput.addEventListener('input', function () {
        const username = this.value;

        if (username.length >= 1) {
            checkUsernameAvailability(username);
        } else {
            usernameFeedback.textContent = '';
            signUpButton.disabled = false;
        }
    });

    function checkUsernameAvailability(username) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.available) {
                        usernameFeedback.textContent = 'Username is available.';
                        usernameFeedback.classList.add('text-success');
                        usernameFeedback.classList.remove('text-danger');
                        signUpButton.disabled = false;
                    } else {
                        usernameFeedback.textContent = 'Username is already taken!';
                        usernameFeedback.classList.add('text-danger');
                        usernameFeedback.classList.remove('text-success');
                        signUpButton.disabled = true;
                    }
                } else {
                    console.error('Error checking username availability:', xhr.status, xhr.statusText);
                }
            }
        };

        xhr.open('GET', 'check_username.php?username=' + username, true);
        xhr.send();
    }
});