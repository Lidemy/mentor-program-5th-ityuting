const request = require('request')

request.get({
  url: 'https://lidemy-book-store.herokuapp.com/books?_limit=10'
},
(error, response, body) => {
  let json
  if (response.statusCode >= 200 && response.statusCode < 300) {
    console.log('statusCode', response.statusCode)
    try {
      json = JSON.parse(body)
    } catch (e) {
      console.log('回傳格式錯誤')
    }
    for (let i = 0; i < json.length; i++) {
      console.log(String(json[i].id).padEnd(3) + json[i].name)
    }
  } else {
    console.log('操作失敗', error)
  }
})
