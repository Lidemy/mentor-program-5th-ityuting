export function getMsgAPI(urlRoot, siteKey, lastId, cb) {
  let url = `${urlRoot}/api_getmsg.php?site_key=${siteKey}`
  if (lastId !== null) {
    url += '&before=' + lastId
  }
  $.ajax({
    url // key 和 value 值的變數若名稱一樣，則直接寫變數就可以。
  }).done((data) => {
    cb(data)
  })
}

export function addComment(urlRoot, newMsgData, cb) {
  $.ajax({
    type: "POST",
    url: `${urlRoot}/api_add_newmsg.php`,
    data: newMsgData
  }).done((data) => {
    cb(data)
  });
}