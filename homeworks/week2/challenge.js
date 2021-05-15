// 在這一題上，所謂的「更快」，我理解成指的是執行時的圈數越少越好、佔電腦資源越少越好...，還有我也想不出比範例的答案更精簡的 code 了...。
/* eslint-disable no-unused-vars */
function search(arr, n) {
  if (n < arr[0] || n > arr[arr.length - 1]) {
    return -1
  }
  let from = 0
  let to = arr.length - 1
  let index = Math.floor((from + to) / 2)
  do {
    index = Math.floor((from + to) / 2)
    if (n === arr[index]) {
      return index
    } else if (n > arr[index]) {
      from = index
    } else {
      to = index
    }
  } while ((to - from) !== 1)
  return -1
}
