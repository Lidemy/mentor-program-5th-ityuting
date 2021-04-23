// 在這一題上，所謂的「更快」，我理解成指的是執行時的圈數越少越好、佔電腦資源越少越好...，還有我也想不出比範例的答案更精簡的 code 了...。

function search(arr,n){
    if(n < arr[0] || n > arr[arr.length-1]){
          return -1
    }
    var from = 0;
    var to = arr.length-1;
    var ind = Math.floor((from + to)/2);
    do{
          ind = Math.floor((from + to)/2)
          if(n == arr[ind]){
                return ind;
          } else if(n > arr[ind]){
                from = ind;
          } else {
                to = ind;
          }
    } while ((to - from) !== 1)
    return -1
}