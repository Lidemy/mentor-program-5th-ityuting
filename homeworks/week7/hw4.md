## 什麼是 DOM？

Document Object Model，文件物件模型。
DOM 是一個樹狀結構的模型，可以幫助使用者了解整個 HTML 檔案的架構以及層級關係，樹狀結構最重要的是各節點（node），通常分成以下四種：
1. Document：這份文件，也就是這份 HTML 檔案的開端。
2. Element：各個標籤，像是 `<div>` 、 `<p>` 等等各種 HTML Tag。
3. Text：被標籤包裹的文字，舉例來說在 `<h1>Hello World</h1>` 中， Hello World 被 `<h1>` 包裹起來，因此 Hello World 就是此 Element 的 Text。
4. Attribute：指標籤內的相關屬性。

而各節點的關係分成兩種：
1. Parent and Child：就是上下層節點，上層為 Parent Node，下層為 Child Node。
2. Siblings：位於同一層的節點，彼此間只有 Previous 以及 Next 兩種。

=> 知道元素節點彼此之間的關係，在抓取元素的時候便可以運用 `.parentElement` 、 `.previousElementSibling` 、 `.nextElementSibling`... ... 等等 JavaScript 語法。
=> 瞭解 DOM 是為了不讓網頁在渲染的過程中過度的 Repaint 甚至是 Reflow 而讓網頁效能變差。而 vitual DOM 技術則可以讓操作 DOM 的成本降低很多，不管是時間成本還是空間成本。

---

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

在事件被觸發的傳遞機制裡分成三個階段：Capture Phase、Target Phase、Bubbling Phase。
Capture Phase 是從 window 依照節點往下尋找事件元素的過程，途中會觸碰到各個節點，也可能觸發其他事件；Target Phase 則是抓取到觸發事件的目標；最後 Bubbling Phase，再沿著原本 Capture Phase 的途徑冒泡回去，同樣的也會觸碰到各個節點，可能觸發其他事件。

=> 大部分的事件都會冒泡，例外是 `focus` 、 `blur` 、`scroll`。
=> `DOMContentLoaded` 和 `load` 事件都可以確保 DOM 結構被完整讀取，但 `load` 事件是掛在 window 上的，還要等待外部資源讀取完畢才會被觸發。因此若是 `DOMContentLoaded` 已被觸發，但外部文件還未讀取完畢，則事件傳遞會在 Document 上停止冒泡，而不會傳遞到 Window，因此不會觸發到 `load`，所以順序而言 `load` 在 `DOMContentLoaded` 之後才會被觸發。

原本的順序是，先捕獲再冒泡，若是目標元素則依照程式碼上的先後順序來觸發。
但 Chrome 伺服器更改了規則，分界線是 Chrome 89.0.4363.0（發布於 2020-12-22）和 89.0.4358.0。
在 Chrome 89.0.4363.0 以及之後版本中，目標元素的觸發事件順序不再按照程式碼的順序觸發，而是依照先捕獲再冒泡的順序執行。

---

## 什麼是 event delegation，為什麼我們需要它？

event delegation 事件代理機制，是一種方法，而不是一種語法，原理為 DOM 和事件傳遞機制的應用。
當我們需要對很多元素新增同樣的事件時，可以透過將事件新增到給這些元素共同的 Parent Node 來代理、處理，便可以不用所有元素都新增事件。
原因是在事件傳遞機制裡，若 Target Phase 是這些元素中的任何一個，那麼於捕獲和冒泡階段一定會通過父節點的元素，將事件給父節點代理，一樣可以觸發你所需要的事件。
event delegation 不僅比較有效率，也可以處理因動態互動所新增的子節點（HTML Tag）。

---

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

兩種語法都跟事件的執行狀態有關，最大的差別在於傳遞機制是否會繼續傳遞下去。

event.preventDefault()：阻止預設的行為，若事件可以被取消，那就會取消，但也有無法被取消的事件，而傳遞機制還是會繼續傳遞、繼續捕獲冒泡。
有些 HTML Tag 元素本身便有預設行為，例如 `<a>` 本身就擁有連結的事件、若在其傳遞機制的父節點加上 `event.preventDefault()`，那麼 `<a>` 便不會觸發原本的預設行為，但仍舊會繼續傳遞直到冒泡結束。

event.stopPropagation()：阻止事件繼續傳遞。
若傳遞機制過程觸發到 `event.stopPropagation()`，則傳遞機制會停止不再繼續傳遞下去，但在同一個節點的其他事件仍舊會被觸發，除非在其中一個事件加上 `event.stopImmediatePropagation()` ，那麼同一個節點的其他事件便會立即停止，而不會被觸發。
