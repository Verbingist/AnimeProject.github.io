import validator from 'validator';

document.addEventListener('submit', (event) => {
    event.preventDefault();
    let inputs = document.querySelectorAll('input');
    let email = inputs[0].value;
    let password = inputs[1].value;

    let error = "";
    if (!validator.isEmail(email)) {
        error = "Неверный email"
    }

    if (!validator.isEmail(email)) {
        let message = document.createElement('div');
        let main = document.body.querySelector('main');
        message.classList.add("message")
        message.innerHTML = "<p>Неверный email</p>"
        message.classList.add("orange")
        main.append(message);
        setTimeout(() => {
            document.body.querySelector('main').removeChild(document.querySelector('.message'))
        }, 5000)
        return
    }

    let validation = JSON.stringify({
        email: email,
        password: password,
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
        .catch(() => {
            let message = document.createElement('div');
            let main = document.body.querySelector('main');
            message.classList.add("message")
            message.innerHTML = "<p>Случилась ошибка</p>"
            message.classList.add("orange")
            main.append(message);
            setTimeout(() => {
                document.body.querySelector('main').removeChild(document.querySelector('.message'))
            }, 5000)
        })
})