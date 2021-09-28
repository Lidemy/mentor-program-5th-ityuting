export function escape(input) {
  return String(input).replace(/\&/g, '&amp;')
    .replace(/\</g, '&lt;')
    .replace(/\>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/\'/g, '&#x27')
    .replace(/\//g, '&#x2F')
}

export function appendCommentToDOM(container, msg, isPrepend) {
  const card = `
    <div class="card">
      <div class="card_avator">
        </div>
        <div class="card_info">
          <div>
            <span class="card_author">${escape(msg.nickname)}</span>
            <span class="card_time">${escape(msg.created_at)}</span>
            <span class="card_id">${escape(msg.id)}</span>
          </div>
          <div class="card_msg">${escape(msg.comment)}</div>
      </div>
    </div>
  `
  if (isPrepend) {
    container.prepend(card)
  } else {
    container.append(card)
  }
}

