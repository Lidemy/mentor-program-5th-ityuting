function reverse(str) {
  var newstr = "";
    for(var i = 1; i <= str.length; i++){
        if(i<=str.length){
            newstr += str[str.length-i];
        }
  }
  console.log(newstr);
}

reverse('hello');