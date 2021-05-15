const request = require('request')

const process = require('process')

request.get({
  url: `https://restcountries.eu/rest/v2/name/${process.argv[2]}`
},
(error, response, body) => {
  if (response.statusCode >= 200 && response.statusCode < 300) {
    console.log('statusCode', response.statusCode)
    let json
    try {
      json = JSON.parse(body)
    } catch (e) {
      console.log('回傳格式錯誤')
    }
    for (let i = 0; i < json.length; i++) {
      console.log(`
        國家：${json[i].name}
        首都：${json[i].capital}
        貨幣：${json[i].currencies[0].code}
        國碼：${json[i].callingCodes}

        ===================================
        `)
    }
  } else {
    console.log('找不到國家資訊')
  }
})
