<script setup>
import { onMounted, watch, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

function pageInicialication() {
    isautorisated()
    updatePagination()
    router.push({
        path: route.path,
        query: {
            ...route.query,
            page: page.value,
            email: route.query.email || 'basic',
            method: route.query.method || 'popular',
        }
    })
    updatePage(route.query.method)
}

function isautorisated() {
    let auth = document.cookie.split("; ").filter((item) => {
        return item.startsWith('auth=')
    });
    if (auth[0]) {
        auth = auth[0].split('=')
        auth = auth[1]
    }
    if (auth == 1) {
        document.querySelector('.header>h2').classList.add('hidden')
    }
}

function addTimeOuts() {
    let animeCards = document.querySelectorAll('.card')
    animeCards.forEach(item => {
        item.querySelector('.info').innerHTML = "<p>Идет загрузка</p>"
        item.querySelector('.label').innerHTML = "<p>Идет загрузка</p>"
    })
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

async function addPopularAnimeToPage() {
    let popularAnimeList = await fetch(`https://api.jikan.moe/v4/anime?order_by=popularity&limit=9&page=${page.value}`)
    popularAnimeList = await popularAnimeList.json()
    popularAnimeList = popularAnimeList.data
    let animeCards = document.querySelectorAll('.card')
    animeCards.forEach((item, index) => {
        item.querySelector('.info').classList.remove('hidden')
        item.querySelector('.feedback').classList.add('hidden')
        if (popularAnimeList[index]) {
            item.querySelector('.label').innerHTML = `<p>${popularAnimeList[index].title}</p>`
            item.querySelector('.info').innerHTML = `<img src = ${popularAnimeList[index].images.jpg.image_url} height = 260px>`
        }
        else {
            item.querySelector('.label').innerHTML = `<p>Пусто</p>`
            item.querySelector('.info').innerHTML = "<p>Описание отсутствует</p>"
        }
    })
    lastPage.value = true;
}

async function addUserAnimeToPage(method = "viewed") {
    let feedbacks;
    if (route.query.email == "basic" || route.query.email == "")
        feedbacks = JSON.stringify({
            'status': method,
        }, null, 2)
    else
        feedbacks = JSON.stringify({
            'email': route.query.email,
            'status': method,
        }, null, 2)

    fetch(`/BackGetPageOfFeedbacks?page=${page.value}`, {
        method: 'POST',
        headers: {
            "Content-type": "application/json"
        },
        body: feedbacks,
    })
        .then(result => result.json())
        .then((result) => {
            let cards = document.querySelectorAll('.card')
            cards.forEach((item, index) => {
                item.querySelector('.label').innerHTML = ""
                item.querySelector('.feedback').innerHTML = ""
                item.querySelector('.info').classList.add('hidden')
                item.querySelector('.feedback').classList.remove('hidden')
                if (result.data[index]) {
                    item.querySelector('.label').innerHTML = `<p>${result.data[index].AnimeName}</p>`
                    item.querySelector('.feedback').innerHTML = `<p>${result.data[index].anime_feedback}</p>`
                }
                else {
                    item.querySelector('.label').innerHTML = `<p>Пусто</p>`
                    item.querySelector('.feedback').innerHTML = `<p>Отзыв отсутствует</p>`
                }
            })
            if (result.data.length < 9) lastPage.value = false;
            else lastPage.value = true;
        })
}

function updatePage() {
    addTimeOuts()
    updatePagination()
    if (route.query.method == 'viewed') {
        addUserAnimeToPage('viewed')
    }
    else if (route.query.method == 'planned') {
        addUserAnimeToPage('planned')
    }
    else if (route.query.method == 'dropped') {
        addUserAnimeToPage('dropped')
    }
    else {
        addPopularAnimeToPage()
    }
}

function getNewRoute(method) {
    if (method == 'basic')
        return {
            path: '/',
            query: {
                email: 'basic',
                method: 'public',
                page: '1'
            }
        }
    return {
        path: '/',
        query: {
            ...route.query,
            method: method,
            page: '1'
        }
    }
}

let route = useRoute();
let router = useRouter();
const page = ref(Number(route.query.page) || 1)
const lastPage = ref(true)

onMounted(() => {
    pageInicialication()
});

watch(() => route.query.method, () => {
    page.value = 1;
    isautorisated()
    updatePage()
})

watch(() => route.query.page, () => {
    updatePage()
});
</script>

<template>
    <div class="wrapper">
        <header class="header"> <router-link to="#" class="logo">
                <h1>Animelist</h1>
            </router-link> <input type="search" class="search" placeholder="Найти аниме">
            <h2><router-link class="login" to="/Login">Вход/регистрация</router-link></h2>
        </header>
        <main class="container">
            <div class="content">
                <div class="cardRow">
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                </div>
                <div class="cardRow">
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                </div>
                <div class="cardRow">
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                    <div class="card">
                        <div class="label"></div>
                        <div class="info"></div>
                        <div class="feedback hidden"></div>
                    </div>
                </div>
                <div class="pagination">
                    <a @click="updatePagination('back')" class="pagginationButton">← Пред</a>
                    <span class="pagginationButton">Страница: {{ page }}</span>
                    <a v-show="lastPage" @click="updatePagination('up')" class="pagginationButton">След→</a>
                </div>
            </div>
            <aside class="sidebar">
                <ul class="hrefList">
                    <li> <router-link :to="getNewRoute('popular')">Популярные</router-link> </li>
                    <li> <router-link :to="getNewRoute('viewed')">Просмотренные</router-link> </li>
                    <li> <router-link :to="getNewRoute('planned')">Запланированные</router-link> </li>
                    <li> <router-link :to="getNewRoute('dropped')">Брошенные</router-link> </li>
                </ul>
                <ul class="hrefList">
                    <li> <router-link to="/Add">Добавить аниме</router-link> </li>
                    <li> <router-link to="/Remove">Удалить аниме</router-link> </li>
                    <li> <router-link to="/Update">Изменить отзыв</router-link> </li>
                </ul>
                <ul class="hrefList">
                    <li> <router-link to="/UserList?page=1">Участники</router-link> </li>
                    <li> <router-link :to="getNewRoute('basic')">Мои аниме</router-link> </li>
                </ul>
            </aside>
        </main>
        <footer class="footer">
            <div class="footerHrefBlock"> <router-link class="footerHref" to="/AboutInfo">Информация</router-link>
                <router-link class="footerHref" to="/Author">Автор</router-link>
            </div>
            <div class="footerHrefBlock none">
                <router-link :to="getNewRoute('popular')">Популярные</router-link>
                <router-link :to="getNewRoute('viewed')">Просмотренные</router-link>
                <router-link :to="getNewRoute('planned')">Запланированные</router-link>
                <router-link :to="getNewRoute('dropped')">Брошенные</router-link>
            </div>
            <div class="footerHrefBlock none">
                <router-link class="footerHref" to="/Add">Добавить аниме</router-link>
                <router-link class="footerHref" to="/Remove">Удалить аниме</router-link>
                <router-link class="footerHref" to="/Update">Изменить отзыв</router-link>
                <router-link to="/UserList?page=1">Участники</router-link>
                <router-link :to="getNewRoute('basic')">Мои аниме</router-link>
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

*,
*::after {
    font-size: 1.3vw;
}

main {
    display: flex;
    flex: 1;
}

* {
    box-sizing: border-box;
}

.header {
    display: flex;
    width: 100%;
    justify-content: space-between;
    padding: 20px;
    align-items: center;
    min-height: 100px;
    background-color: #FF7400;
}

.search {
    width: 40%;
    height: 50%;
    font-size: 100%;
    margin: 20px;
    border: 2px solid #ffffff;
    border-radius: 20px;
}

.search::placeholder {
    font-family: 'AnimeAce', sans-serif;
}

.login {
    text-decoration: none;
    color: #ffffff
}

.login:hover {
    color: #000000;
}

.footer {
    display: flex;
    justify-content: left;
    align-items: center;
    flex-direction: row;
    background-color: #FF7400;
}

.sidebar {
    flex: 1;
    background-color: #ffffff;
    width: 20%;
    border-left: 1px solid black;
}

.logo {
    color: #ffffff;
    text-decoration: none;
}

.logo h1 {
    font-size: 2vw;
}

.logo:hover {
    color: #000000;
}

.hrefList {
    list-style-type: none;
    margin-bottom: 75px;
}

.hrefList>li {
    margin: 30px 5px;
}

.hrefList>li>a {
    text-decoration: none;
    color: #FF7400;
    font-size: 1.2vw;
}

ul>li>a:hover {
    color: #000000;
    cursor: pointer;
}

.content {
    background-color: #ffffff;
    width: 80%;
    min-height: 1200px;
    display: flex;
    flex-direction: column;
}

.cardRow {
    display: flex;
    flex-direction: row;
    width: 100%;
    height: 30%;
    align-items: center;
    justify-content: space-around;
}

.card {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 30%;
    height: 90%;
    border: 3px solid #FF7400;
    border-radius: 20px;
    padding: 20px;
}

.label {
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 1;
    margin-bottom: 5%;
    border: 3px solid #FF7400;
    border-radius: 20px;
    width: 95%;
    height: 20%;
}

.feedback {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    flex: 1;
    border: 3px solid #FF7400;
    border-radius: 20px;
    height: 70%;
    width: 95%;
    padding: 20px;
    overflow: scroll;
}

.info {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 3px solid #FF7400;
    border-radius: 20px;
    height: 300px;
    width: auto;
    overflow: hidden;
}

.pagination {
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: end;
}

.pagginationButton {
    text-decoration: none;
    color: #FF7400;
    cursor: pointer;
    user-select: none;
    margin: 20px;
}

router-link.pagginationButton {
    cursor: pointer;
}

router-link.pagginationButton:hover {
    color: #000000
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

.none {
    display: none;
}

.hidden {
    display: none;
}

@media (min-width:2500px) {
    * {
        font-size: 40px;
    }

    .header {
        height: 200px;
    }

    .footer {
        height: 200px;
    }

    .search {
        border-radius: 70px;
    }

    .pagination {
        margin: 50px 0px;
    }
}

@media (max-width: 820px) {
    * *::after {
        font-size: 2vw;
    }

    .sidebar {
        display: none;
    }

    .none {
        display: flex;
    }

    .content {
        width: 100%;
    }

    .search {
        font-size: 5px;
        height: 20px;
    }

    .header {
        min-height: 50px;
    }
}
</style>
