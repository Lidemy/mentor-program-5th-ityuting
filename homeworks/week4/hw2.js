const request = require('request')

const process = require('process')

const rootURL = 'https://lidemy-book-store.herokuapp.com/books/'

if (process.argv[2] === 'list') getList()

if (process.argv[2] === 'read') getRead()

if (process.argv[2] === 'delete') handleDelete()

if (process.argv[2] === 'create') handleCreate()

if (process.argv[2] === 'update') handleUpdate()

function getList() {
  request.get({
    url: 'https://lidemy-book-store.herokuapp.com/books?_limit=20'
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
        console.log(String(json[i].id).padEnd(4) + json[i].name)
      }
    } else {
      console.log('操作失敗', error)
    }
  }
  )
}

function getRead() {
  request.get({
    url: rootURL + process.argv[3]
  },
  (error, response, body) => {
    if (response.statusCode >= 200 && response.statusCode < 300) {
      console.log('statusCode', response.statusCode)
      try {
        console.log(JSON.parse(body).name)
      } catch (e) {
        console.log('回傳格式錯誤')
      }
    } else {
      console.log('操作失敗', error)
    }
  }
  )
}

function handleDelete() {
  request.del({
    url: rootURL + process.argv[3]
  },
  (error, response, body) => {
    console.log(response.statusCode)
  }
  )
}

function handleCreate() {
  request.post({
    url: rootURL,
    form: {
      name: process.argv[3]
    }
  },
  (error, response, body) => {
    if (response.statusCode >= 200 && response.statusCode < 300) {
      console.log('statusCode', response.statusCode)
      console.log(response.caseless.dict.location)
    } else {
      console.log('操作失敗', error)
    }
  }
  )
}

function handleUpdate() {
  request.patch({
    url: rootURL + process.argv[3],
    form: {
      name: process.argv[4]
    }
  },
  (error, response, body) => {
    if (response.statusCode >= 200 && response.statusCode < 300) {
      console.log('statusCode', response.statusCode)
    } else {
      console.log('操作失敗', error)
    }
  }
  )
}
