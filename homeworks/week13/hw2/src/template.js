export function getBoardTemplate(formClass, cardsClass) {
  return `
  <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
  <main class="board">
    <span><strong class="board_title">Comments</strong></span>
    <br/>
    <div>
    <form class="${formClass} board_newmsg" method="post">
      <div class="board_nick">
        <span>暱稱：</span>
        <input type="text" name="nickname"></input>
      </div>
      <textarea name="comment" rows="5"></textarea>
      <input class="board_submit-btn" type="submit" />
    </form>
    <hr/>
    <section class="${cardsClass} cards">
    </section>
  </main>
  `
}

export function getMoreBtnTag(className) {
  return `<button class="${className} more_btn">載入更多</button>`
}