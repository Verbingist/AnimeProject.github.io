import validator from 'validator';

document.addEventListener('submit', (event) => {
    event.preventDefault();
    let inputs = document.querySelectorAll('input');
    let mail = inputs[0].value;
    let password = inputs[1].value;
    if (!validator.isEmail(mail)) {
        let message = document.createElement('div');
        let main = document.body.querySelector('main');
        message.classList.add("message")
        message.textContent = "Некорректный email"
        message.classList.add("orange")
        main.append(message);
        return
    }

    if (password.length < 6) {
        let message = document.createElement('div');
        let main = document.body.querySelector('main');
        message.classList.add("message")
        message.textContent = "Слишком короткий пароль"
        message.classList.add("orange")
        main.append(message);
        return
    }

    let validation = JSON.stringify({
        email: mail,
        pass: password,
    }, null, 2);

    fetch("http://localhost:8001/test.php", {
        method: 'POST',
        headers: {
            "Content-type": "application/json"
        },
        body: validation,
    })
        .then(() => {
            let message = document.createElement('div');
            let main = document.body.querySelector('main');
            main.innerHTML = "";
            message.classList.add("message")
            message.textContent = "Успешный вход"
            message.classList.add("orange")
            main.append(message);
            setTimeout(() => {
                window.location.href = '../../index.html';
            }, 1000)
        })
        .catch(error => console.log(error))
})