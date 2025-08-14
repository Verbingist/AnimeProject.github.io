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
      <p>Другие проекты можно найти по нижестоящим ссылкам</p>
      <router-link class="project" to="#">Первый проект</router-link>
      <router-link class="project" to="#">Второй проект</router-link>
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
  height: 10vh;
  background-color: #FF7400;
}

.footer {
  display: flex;
  justify-content: start;
  align-items: center;
  height: 10vh;
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
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.project {
  text-decoration: none;
  color: #FF7400;
  margin-top: 40px;
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
    font-size: 1vw;
  }

  .header {
    height: 200px;
  }

  .footer {
    height: 200px;
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
}
</style>
