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
  const str = lines[0]
  console.log(isPalindrome(str))
}

function isPalindrome(str) {
  let reverseStr = ''
  for (let i = str.length - 1; i >= 0; i--) {
    reverseStr += str[i]
  }
  if (str === reverseStr) {
    return 'Ture'
  } else {
    return 'False'
  }
}
