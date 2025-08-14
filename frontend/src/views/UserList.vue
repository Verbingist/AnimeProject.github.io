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
      <input type="search" class="search" placeholder="Поиск пользователя">
    </header>
    <main>
      <div class="usersrow">
        <div class="users">
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
        </div>
        <div class="users">
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
        </div>
        <div class="users">
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
          <router-link class="user" to=#>Иванов иван иванович</router-link>
        </div>
      </div>
      <div class="pagination">
        <router-link to="/UserList" class="pagginationButton">← Пред</router-link>
        <span class="pagginationButton">Страница: 1</span>
        <router-link to="/UserList" class="pagginationButton">След →</router-link>
      </div>
    </main>
    <footer class="footer">
      <div class="footertoBlock">
        <router-link class="footerto" to="/AboutInfo">Информация</router-link>
        <router-link class="footerto" to="/Author">Автор</router-link>
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
  justify-content: start;
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
  width: 30vw;
  text-decoration: none;
}

.logo:hover {
  color: #000000;
}

main {
  flex: 1;
  padding: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.search {
  width: 40%;
  height: 5vh;
  font-size: 2vh;
  margin: 20px;
  border: 2px solid #ffffff;
  border-radius: 20px;
}

.footertoBlock {
  display: flex;
  flex-direction: column;
  margin: 20px;
}

.footerto {
  text-decoration: none;
  color: #ffffff;
  margin: 5px;
}

.footerto:hover {
  color: #000000;
}

.usersrow {
  display: flex;
  justify-content: space-around;
  flex-direction: row;
  flex-wrap: wrap;
  width: 80vw;
}

.users {
  width: 30%;
  display: flex;
  flex-direction: column;
}

.user {
  margin: 20px;
  text-decoration: none;
  color: #FF7400
}

.pagination {
  margin-top: 10vh;
  display: flex;
  justify-content: center;
}

.pagginationButton {
  text-decoration: none;
  color: #FF7400;
  margin: 0px 20px;
}

a.pagginationButton:hover {
  color: #000000
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

  .users {
    width: 70%;
  }

  .search::placeholder {
    font-size: 2vw;
  }

  .search {
    height: 5vh;
  }

  .header {
    height: 20px;
  }

  .footer {
    height: 50px;
  }

  .search {
    font-size: 5px;
    height: 20px;
  }

  .pagination {
    margin-top: 5vh;
  }
}
</style>