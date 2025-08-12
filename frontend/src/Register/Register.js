import validator from 'validator';

document.addEventListener('submit', (event) => {
    event.preventDefault();
    let inputs = document.querySelectorAll('input');
    let name = inputs[0].value;
    let email = inputs[1].value;
    let phone = inputs[2].value;
    let password = inputs[3].value;
    let password2 = inputs[4].value;

    let error = [];

    if (!(/^[A-Za-zА-Яа-яЁё]+$/.test(name))) {
        error.push("Имя содержит только буквы")
    }
    if (!validator.isEmail(email)) {
        error.push("Неверный email")
    }
    if (!validator.isMobilePhone(phone)) {
        error.push("Неверный телефон")
    }
    if (password.length < 6) {
        error.push("Короткий пароль")
    }
    if (password != password2) {
        error.push("Пароли не совпадают")
    }
    if (error.length != 0) {
        let message = document.createElement('div');
        let main = document.body.querySelector('main');
        message.classList.add("message")
        error.forEach(item => {
            message.innerHTML += ("<p>" + item + "</p>")
        })
        message.classList.add("orange")
        main.append(message);
        setTimeout(() => {
            document.body.querySelector('main').removeChild(document.querySelector('.message'))
        }, 5000)
        return
    }

    let validation = JSON.stringify({
        name: name, 
        email: email,
        phone: phone,
        password: password,
    }, null, 2);

    fetch("http://127.0.0.1:8000/Register", {
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
            message.textContent = "Успешная регистрация"
            message.classList.add("orange")
            main.append(message);
            setTimeout(() => {
                window.location.href = '../../index.html';
            }, 1000)
        })
        .catch((error) => {
            console.log(JSON.stringify(error))
            let message = document.createElement('div');
            let main = document.body.querySelector('main');
            message.classList.add("message")
            message.innerHTML = "<p>Случилась ошибка на сервере.</p><p>Попробуйте войти позже</p>"
            message.classList.add("orange")
            main.append(message);
            setTimeout(() => {
                document.body.querySelector('main').removeChild(document.querySelector('.message'))
            }, 5000)
        })
})