<script setup>
import { onMounted } from 'vue';
import validator from 'validator';

onMounted(() => {

  document.addEventListener('submit', (event) => {
    event.preventDefault();
    let inputs = document.querySelectorAll('input');
    let email = inputs[0].value;
    let password = inputs[1].value;

    if (!validator.isEmail(email)) {
      let message = document.querySelector('.message');
      message.innerHTML = "<p>Некорректный email</p>"
      message.classList.remove('hidden')
      setTimeout(() => {
        message.classList.add('hidden')
      }, 5000)
      return
    }

    let validation = JSON.stringify({
      email: email,
      password: password,
    }, null, 2);

    fetch("/BackLogin", {
      method: 'POST',
      headers: {
        "Content-type": "application/json"
      },
      body: validation,
    })
      .then(result => result.json())
      .then((result) => {
        let message = document.querySelector('.message');
        message.innerHTML = "<p>" + result.message + "</p>"
        message.classList.remove('hidden')
        if (result.status == 200) {
          setTimeout(() => {
            window.location.href = '/';
          }, 1000)
        }
        else {
          setTimeout(() => {
            message.classList.add('hidden')
          }, 5000)
        }
      })
      .catch(() => {
        let message = document.querySelector('.message');
        message.innerHTML = "<p>Случилась ошибка</p>"
        message.classList.remove('hidden')
        setTimeout(() => {
          message.classList.add('hidden')
        }, 5000)
      })
  })
});
</script>

<template>
  <div class="wrapper">
    <header class="header">
      <router-link to="/" class="logo">
        <h1>Animelist</h1>
      </router-link>
    </header>
    <main>
      <h1>Вход</h1>
      <form>
        <input class="mail" type="email" placeholder="Почта">
        <input class="password" type="password" placeholder="Пароль">
        <input class="submit" type="submit" value="Вход">
      </form>
      <p>Нет аккаунта? <router-link to="/Register" class="register">Зарегистрироваться</router-link></p>
      <div class="message orange hidden">
      </div>
    </main>
    <footer class="footer">
      <div class="footerHrefBlock">
        <router-link class="footerHref" to="/AboutInfo">Информация</router-link>
        <router-link class="footerHref" to="/Author">Автор</router-link>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.wrapper {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
}

* {
  box-sizing: border-box;
}

.header {
  display: flex;
  justify-content: space-between;
  padding: 20px;
  align-items: center;
  background-color: #FF7400;
}

.footer {
  display: flex;
  justify-content: start;
  align-items: center;
  background-color: #FF7400;
}

.logo {
  color: #ffffff;
  text-decoration: none;
}

.logo:hover {
  color: #000000;
}

main {
  flex: 1;
  padding: 70px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

form {
  width: 50vw;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}

input {
  border-radius: 20px;
  width: 80%;
  height: 10vh;
  margin: 20px;
}

.submit {
  background-color: #FF7400;
  font-family: 'AnimeAce', sans-serif;

}

.name::placeholder {
  font-family: 'AnimeAce', sans-serif;
}

.name::placeholder {
  text-align: center;
}

.feedback::placeholder {
  font-family: 'AnimeAce', sans-serif;
}

.register {
  color: #FF7400;
  text-decoration: none;
}

.mail::placeholder {
  font-family: 'AnimeAce', sans-serif;
}

.password::placeholder {
  font-family: 'AnimeAce', sans-serif;
}

input.password {
  font-family: sans-serif !important;
}

.message {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40vw;
  height: 30vh;
  border: 3px solid #FF7400;
  border-radius: 30px;
  margin: 5px;
}

.orange {
  color: #FF7400;
}

.submit:hover {
  cursor: pointer;
}

textarea {
  overflow: scroll;
  resize: none;
  width: 80%;
  height: 40vh;
  border-radius: 20px;
  font-size: 2vw;
}

textarea::placeholder {
  text-align: center;
  font-size: 3vw;
}

.footerHrefBlock {
  display: flex;
  flex-direction: column;
  margin: 20px;
}

.footerHref {
  text-decoration: none;
  color: #ffffff;
  margin: 5px;
}

.footerHref:hover {
  color: #000000;
}

.hidden {
  display: none;
}

@media (min-width:2500px) {
  * {
    font-size: 50px;
  }

  .header {
    height: 200px;
  }

  .footer {
    height: 200px;
  }

  input {
    width: 100%;
  }

  textarea {
    width: 100%;
  }

  textarea::placeholder {
    font-size: 50px;
  }
}

@media (max-width: 820px) {
  * {
    font-size: 2vw;
  }

  .header {
    height: 20px;
  }

  .footer {
    height: 50px;
  }

  input {
    width: 100%;
  }

  textarea {
    width: 100%;
  }
}
</style>
