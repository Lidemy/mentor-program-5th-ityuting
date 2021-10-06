import css from './style.css'
import { getMsgAPI, addComment } from './api.js'
import { appendCommentToDOM } from './utils.js'
import { getBoardTemplate, getMoreBtnTag } from './template.js'

export function init(initParamer) {
  let siteKey = initParamer.siteKey
  let lastId = null
  let apiUrlRoot = initParamer.apiUrlRoot
  let commentArea = initParamer.commentArea
  let formClass = `${siteKey}-board_newmsg`
  let formSelector = `.${formClass}`
  let cardsClass = `${siteKey}-cards`
  let cardsSelector = `.${cardsClass}`
  let moreBtnClass = `${siteKey}-more_btn`
  let moreBtnSelector = `.${moreBtnClass}`

  const moreBtnTag = getMoreBtnTag(moreBtnClass)
  const boardTemplate = getBoardTemplate(formClass, cardsClass)

  $(commentArea).append(boardTemplate)
  // 拿留言板資料
  getMsgs(apiUrlRoot, siteKey, cardsSelector, moreBtnTag)

  // 送出留言 request
  $(formSelector).submit(e => {
    e.preventDefault()
    const newMsgData = {
      'site_key': siteKey,
      'nickname': $(`${formSelector} input[name=nickname]`).val(),
      'comment': $(`${formSelector} textarea[name=comment]`).val()
    }
    addComment(apiUrlRoot, newMsgData, data => {
      if(data.ok === false) {
        alert(data.message)
        return
      }
      $(`${formSelector} input[name=nickname]`).val('')
      $(`${formSelector} textarea[name=comment]`).val('')
      // 送出留言後，馬上反應於留言板。
      appendCommentToDOM($(cardsSelector), newMsgData, true)
    })
  })

  // loadMore 事件代理人機制
  $(cardsSelector).on('click', $(moreBtnSelector), () => {
    $(moreBtnSelector).hide()
    getMsgs(apiUrlRoot, siteKey, cardsSelector, moreBtnTag)
  })

  function getMsgs(apiUrlRoot, siteKey, cardsSelector, moreBtnTag) {
    getMsgAPI(apiUrlRoot, siteKey, lastId, data => {
      if(data.ok === false) {
        alert(data.message)
        return
      }
      let comments = data.comments
      for (let comment of comments) {
        appendCommentToDOM($(cardsSelector), comment)
      }
      lastId = data.lastId
      // loadMore 到最舊一筆後，不再顯示 loadMore 按鈕。
      // 先這樣，假裝 id = 1 的最舊一筆資料永遠不會被刪掉，當作公告啦公告啦 QAQ。
      if (lastId !== null) {
        $(cardsSelector).append(moreBtnTag)
      } else {
        alert('No more comment.')
      }
    })
  }
}



