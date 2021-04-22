function join(arr, concatStr) {
    var str = "";
    for(var i = 0; i<arr.length; i++){
        str = str + arr[i];
        if(i < arr.length-1){
            str = str +concatStr;
        }
    }
    return str;
}

function repeat(str, times) {
    var newstr = "";
    for(var i = 1; i <= times; i++){
        newstr += str;
    }
    return newstr;
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));