<script setup>
import { onMounted } from 'vue';

onMounted(() => {

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
        <h1>Изменить отзыв</h1>
        <form>
            <input class="name" placeholder="Название аниме">
            <textarea class="feedback" placeholder="Отзыв"></textarea>
            <input class="submit" type="submit" value="Изменить отзыв">
        </form>
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
