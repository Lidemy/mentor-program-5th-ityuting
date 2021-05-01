const readline = require('readline')

const rl = readline.createInterface({
  input: process.stdin
})

const lines = []

// 讀取到一行，先把這一行加進去 lines 陣列，最後再一起處理
rl.on('line', (line) => {
  lines.push(line)
})

// 輸入結束，開始針對 lines 做處理
rl.on('close', () => {
  solve(lines)
})

function solve(lines) {
  const times = Number(lines[0])
  for (let i = 1; i <= times; i++) {
    const a = (lines[i].split(' ')[0])
    const b = (lines[i].split(' ')[1])
    const way = Number(lines[i].split(' ')[2])
    console.log(isCompare(a, b, way))
  }
}

function isCompare(a, b, way) {
  if (way === 1) {
    if (a.length > b.length) {
      return 'A'
    } else if (a.length < b.length) {
      return 'B'
    } else {
      for (let i = 0; i < a.length; i++) {
        if (Number(a[i]) > Number(b[i])) {
          return 'A'
        } else if (Number(a[i]) < Number(b[i])) {
          return 'B'
        } else {
          continue
        }
      }
      return 'DRAW'
    }
  } else {
    if (a.length > b.length) {
      return 'B'
    } else if (a.length < b.length) {
      return 'A'
    } else {
      for (let i = 0; i < a.length; i++) {
        if (Number(a[i]) > Number(b[i])) {
          return 'B'
        } else if (Number(a[i]) < Number(b[i])) {
          return 'A'
        } else {
          continue
        }
      }
      return 'DRAW'
    }
  }
}
