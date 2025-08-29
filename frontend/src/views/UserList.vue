<script setup>
import { onMounted, watch, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

function pageInicialication() {
  router.push({
    path: route.path,
    query: {
      ...route.query,
      page: page.value,
      search: search.value,
    }
  })
  updatePage()
}

function addTimeOuts() {
  let animeCards = document.querySelectorAll('.user')
  animeCards.forEach(item => { item.innerHTML = "<p>Идет загрузка</p>" })
}

function updatePagination(method = null, reset = null) {
  if (reset) {
    page.value = 1
    lastPage.value = false
  }
  else
    if (method == 'up') {
      page.value++
      router.push({
        path: route.path,
        query: {
          ...route.query,
          page: page.value,
        }
      })
    }
    else if (method == 'back') {
      page.value--
      router.push({
        path: route.path,
        query: {
          ...route.query,
          page: page.value,
        }
      })
    }
  if (page.value < 2) document.querySelectorAll('a.pagginationButton')[0].classList.add('none')
  else document.querySelectorAll('a.pagginationButton')[0].classList.remove('none')
}

function updatePage() {
  addTimeOuts()
  userSearch()
  updatePagination()
}

function updateSearch(event) {
  page.value = 1;
  updatePagination()
  router.push({
    path: route.path,
    query: {
      ...route.query,
      search: event.target.value,
    }
  })
}

async function userSearch() {
  let searchData = {
    'Users': route.query.search
  }
  axios.post(`http://localhost:8000/BackUserSearch?page=${page.value}`, searchData, {
    withCredentials: true,
    withXSRFToken: true,
    headers: {
      'X-XSRF-TOKEN': decodeURIComponent(
        document.cookie
          .split('; ')
          .find(r => r.startsWith('XSRF-TOKEN='))
          .split('=')[1]
      )
    }
  })
    .then((result) => {
      console.log(result)
      if (result)
        return result.data
    })
    .then(result => {
      if (!result) return
      console.log(result)
      let users = document.querySelectorAll('.user')
      users.forEach((item, index) => {
        if (result.data[index]) {
          item.setAttribute('href', `/?page=1&method=viewed&email=${result.data[index].email}`)
          item.innerHTML = `<p>${result.data[index].email}</p>`
        }
        else {
          item.innerHTML = `<p>Пусто</p>`
        }
      })
      if (!result.notLast) lastPage.value = false
      else lastPage.value = true;
    })
}

let route = useRoute();
let router = useRouter();
let search = ref(route.query.search || "")
const page = ref(Number(route.query.page) || 1)
const lastPage = ref(true)

onMounted(() => {
  pageInicialication()
});

watch(() => route.query.page, () => {
  updatePage()
});

watch(() => route.query.search, () => {
  userSearch()
});

</script>

<template>
  <div class="wrapper">
    <header class="header">
      <router-link to="/" class="logo">
        <h1>Animelist</h1>
      </router-link>
      <input @input="updateSearch" type="search" class="search" placeholder="Поиск пользователя">
    </header>
    <main>
      <div class="usersrow">
        <div class="users">
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
        </div>
        <div class="users">
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
        </div>
        <div class="users">
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
          <a class="user" to=#>Иванов иван иванович</a>
        </div>
      </div>
      <div class="pagination">
        <a @click="updatePagination('back')" class="pagginationButton">← Пред</a>
        <span class="pagginationButton">Страница: {{ page }}</span>
        <a @click="updatePagination('up')" v-show="lastPage" class="pagginationButton">След→</a>
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
  align-items: center;
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
  cursor: pointer;
  color: #000000
}

.none {
  display: none;
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