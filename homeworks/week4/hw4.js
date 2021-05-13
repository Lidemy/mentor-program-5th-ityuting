const request = require('request')

request.get({
  url: 'https://api.twitch.tv/kraken/games/top/',
  headers: {
    'Client-ID': 'fw7dutzkc2t494bgybwhnszm7yv3id',
    Accept: 'application/vnd.twitchtv.v5+json'
  }
},
(error, response, body) => {
  if (response.statusCode >= 200 && response.statusCode < 300) {
    console.log('status', response.statusCode)
    let json
    try {
      json = JSON.parse(body)
    } catch (e) {
      console.log('回傳格式錯誤')
    }
    for (let i = 0; i < json.top.length; i++) {
      console.log(String(json.top[i].viewers).padEnd(9) + json.top[i].game.name)
    }
  } else {
    console.log('操作錯誤', error)
  }
})
