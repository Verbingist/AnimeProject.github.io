<script setup>
import { onMounted, onUnmounted } from 'vue';
import axios from 'axios';

async function addAnime(event) {
  event.preventDefault();
  let name = document.querySelector('.name').value.toLocaleLowerCase()
  let feedback = document.querySelector('textarea').value.toLocaleLowerCase()
  let status = document.querySelector('select').value

  if (!name || !feedback) {
    let message = document.querySelector('.message');
    message.innerHTML = "<p>Поле пустое</p>"
    message.classList.remove('hidden')
    setTimeout(() => {
      message.classList.add('hidden')
    }, 5000)
    return
  }

  switch (status) {
    case "Просмотрено": {
      status = "viewed"
      break
    }
    case "Запранированно": {
      status = "planned"
      break
    }
    case "Брошено": {
      status = "dropped"
      break
    }
    default: {
      status = "viewed"
      break
    }
  }

  let validation = {
    AnimeName: name,
    status: status,
    anime_feedback: feedback,
  }

  axios.post('http://localhost:8000/BackAddFeedback', validation, {
    withCredentials: true,
    withXSRFToken: true,
  })
    .then((result) => {
      let message = document.querySelector('.message');
      message.innerHTML = "<p>" + result.data.message + "</p>"
      message.classList.remove('hidden')
      setTimeout(() => {
        message.classList.add('hidden')
      }, 5000)
    })
    .catch(() => {
      let message = document.querySelector('.message');
      message.innerHTML = "<p>Случилась ошибка</p>"
      message.classList.remove('hidden')
      setTimeout(() => {
        message.classList.add('hidden')
      }, 5000)
    })
}

onMounted(() => {
  axios.get(`http://localhost:8000/isAuth`, {
    withCredentials: true,
    withXSRFToken: true,
  })
    .then((result) => {
      if (!result.data.isAuth) {
        document.querySelector('main>h1').classList.add('hidden')
        document.querySelector('form').classList.add("hidden");
        let message = document.querySelector('.message')
        message.classList.remove("hidden")
        message.innerHTML = "<p>Необходимо авторизоваться</p>"
      }
    })

  document.addEventListener('submit', addAnime)
});

onUnmounted(() => {
  document.removeEventListener('submit', addAnime);
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
      <h1>Добавить отзыв</h1>
      <form>
        <input class="name" placeholder="Название аниме">
        <select>
          <option>Просмотрено</option>
          <option>Запранированно</option>
          <option>Брошено</option>
        </select>
        <textarea class="feedback" placeholder="Отзыв"></textarea>
        <input class="submit" type="submit" value="Отправить отзыв">
      </form>
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
  font-size: 1.4vw;
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
  justify-content: center;
  padding: 70px;
  display: flex;
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

.register {
  color: #FF7400;
  text-decoration: none;
}

select {
  border-radius: 20px;
  width: 80%;
  height: 10vh;
  margin-bottom: 20px;
  background-color: #ffffff;
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
    height: 100px;
  }

  select {
    width: 100%;
    height: 100px;
  }

  textarea {
    width: 100%;
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

  select {
    width: 100%;
  }

  textarea {
    width: 100%;
  }
}
</style>
