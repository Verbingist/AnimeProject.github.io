<script setup>
import { onMounted } from 'vue';

function addTimeOuts() {
    let animeCards = document.querySelectorAll('.card')
    animeCards.forEach(item => { item.innerHTML = "<p>Идет загрузка</p>" })
}

async function getanime(page = 1) {
    let popularAnimeList = await fetch(`https://api.jikan.moe/v4/anime?order_by=popularity&limit=9&page=${page}`)
    popularAnimeList = await popularAnimeList.json()
    return popularAnimeList.data
}

async function addPopularAnimeToPage(page = 1) {
    let popularAnimeList = await getanime(page)
    let animeCards = document.querySelectorAll('.card')
    popularAnimeList.forEach((item, index) => {
        animeCards[index].innerHTML = `<p>${item.title}</p>`
    })
}

async function updatePageContent(page = 1) {
    addTimeOuts()
    let params = new URLSearchParams(window.location.search)
    if (params.has('viewed')) {

    }
    else if (params.has('planned')) {

    }
    else if (params.has('dropped')) {

    } else {
        addPopularAnimeToPage(page)
    }
}
onMounted(() => {
    updatePageContent()
    let page = 1
    if (page == 1) {
        document.querySelector('.pagginationButton').classList.add('none')
    }
    document.querySelectorAll('a.pagginationButton')[1].addEventListener('click', () => {
        ++page
        document.querySelector('span.pagginationButton').textContent = `Страница ${page}`
        if (page == 1) {
            document.querySelector('.pagginationButton').classList.add('none')

        }
        else document.querySelector('.pagginationButton').classList.remove('none')
        updatePageContent(page)
    })
    document.querySelectorAll('a.pagginationButton')[0].addEventListener('click', () => {
        --page
        document.querySelector('span.pagginationButton').textContent = `Страница ${page}`
        if (page == 1) {
            document.querySelector('.pagginationButton').classList.add('none')
        }
        else
            document.querySelector('.pagginationButton').classList.remove('none')
        updatePageContent(page)
    })
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
                    <div class="card"> </div>
                    <div class="card"> </div>
                    <div class="card"> </div>
                </div>
                <div class="cardRow">
                    <div class="card"> </div>
                    <div class="card"> </div>
                    <div class="card"> </div>
                </div>
                <div class="cardRow">
                    <div class="card"> </div>
                    <div class="card"> </div>
                    <div class="card"> </div>
                </div>
                <div class="pagination"> <router-link class="pagginationButton">← Пред</router-link> <span
                        class="pagginationButton">Страница: 1</span> <router-link class="pagginationButton">След
                        →</router-link> </div>
            </div>
            <aside class="sidebar">
                <ul class="hrefList">
                    <li> <router-link to="#">Популярные</router-link> </li>
                    <li> <router-link to="#">Просмотренные</router-link> </li>
                    <li> <router-link to="#">Запланированные</router-link> </li>
                    <li> <router-link to="#">Брошенные</router-link> </li>
                </ul>
                <ul class="hrefList">
                    <li> <router-link to="/Add">Добавить аниме</router-link> </li>
                    <li> <router-link to="/Remove">Удалить аниме</router-link> </li>
                    <li> <router-link to="/Update">Изменить отзыв</router-link> </li>
                </ul>
                <ul class="hrefList">
                    <li> <router-link to="/UserList">Участники</router-link> </li>
                </ul>
            </aside>
        </main>
        <footer class="footer">
            <div class="footerHrefBlock"> <router-link class="footerHref" to="/AboutInfo">Информация</router-link>
                <router-link class="footerHref" to="/Author">Автор</router-link>
            </div>
            <div class="footerHrefBlock none"> <router-link class="footerHref" to="#">Популярные</router-link>
                <router-link class="footerHref" to="#">Просмотренные</router-link> <router-link class="footerHref"
                    to="#">Запланированные</router-link> <router-link class="footerHref" to="#">Брошенные</router-link>
            </div>
            <div class="footerHrefBlock none"> <router-link class="footerHref" to="/Add">Добавить аниме</router-link>
                <router-link class="footerHref" to="/Remove">Удалить аниме</router-link> <router-link class="footerHref"
                    to="/Update">Изменить отзыв</router-link> <router-link class="footerHref"
                    to="/UserList">Участники</router-link>
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
}

.content {
    background-color: #ffffff;
    width: 80%;
    min-height: 800px;
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
    width: 30%;
    height: 90%;
    border: 3px solid #FF7400;
    border-radius: 20px;
    padding: 20px;
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
