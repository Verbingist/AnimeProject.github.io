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
            <p>На данном сайте вы можете сохранять отзывы о просмотренных аниме</p>
            <p>Вы можете в любой момент изменять и удалять свои отзывы</p>
            <p>Вы также можете просматривать чужие отзывы</p>
        </main>
        <footer class="footer">
            <div class="footerHrefBlock">
                <router-link class="footerHref" to="#">Информация</router-link>
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

.logo h1 {
    font-size: 2vw;
}

.logo:hover {
    color: #000000;
}

.footerHref {
    text-decoration: none;
    color: #ffffff;
    margin: 10px;
}

.footerHref:hover {
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