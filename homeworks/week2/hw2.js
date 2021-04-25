function capitalize(str) {
  if (str[0] >= "a" && str[0] <= "z"){
    str = str[0].toUpperCase() + str.substring(1);
  } 
  return str;
}

console.log(capitalize('hello'));