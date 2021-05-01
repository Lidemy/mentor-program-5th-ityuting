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
  const N = Number((lines[0].split(' '))[0])
  const M = Number((lines[0].split(' '))[1])
  for (let i = N; i <= M; i++) {
    if (isDaffodil(i) === true) {
      console.log(i)
    }
  }
}

function isDaffodil(i) {
  const testNumber = String(i)
  const digits = testNumber.length
  const testArray = testNumber.split('')
  let sum = 0
  for (let n = digits - 1; n >= 0; n--) {
    sum += testArray[n] ** digits
  }
  return sum === i
}
