function reverse(str) {
  let newstr = ''
  for (let i = 1; i <= str.length; i++) {
    newstr += str[str.length - i]
  }
  console.log(newstr)
}

reverse('hello')
