function addTimeOuts() {
  let animeCards = document.querySelectorAll('.card')
  animeCards.forEach(item => {
    item.innerHTML = "<p>Идет загрузка</p>"
  })
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

  }
  else {
    addPopularAnimeToPage(page)
  }
}


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
  else
    document.querySelector('.pagginationButton').classList.remove('none')

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