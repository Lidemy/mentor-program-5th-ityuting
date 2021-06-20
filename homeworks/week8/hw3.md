## 什麼是 Ajax？

Asynchromous JavaScript And XML，指的並非單一技術，而是一套綜合多項技術的瀏覽器端網頁開發技術。
傳統的 web 應用是 client 端藉由填寫 `form` 來發起 request，然後接收到 response 後再渲染出來網頁，這個過程是同步的，有幾項缺點：

1. 首先是 client 端需要等待 server 傳回 response 後才能進行下一步，等待期間 client 端的畫面便會完全動彈不得，且等待時間長短依賴 server 端處理並回傳 response 的速度。

2. 再來是兩個相連的 response 之間的差異其實往往不大，但卻需要重新渲染網頁，連相同的部分也需要重新渲染，會浪費許多頻寬和加重 client 端的負擔。

Ajax 就是為了解決這些問題而衍生出來的綜合技術。
重點就在於名稱上的 Asynchromous 、 JavaScript 、 XML。

1. Asynchronous request ( 非同步請求 )：client 端可以對 server 送出只取必要資料的 request ，且不需要等待結果，就可以持續處理其他事情，甚至繼續送出其他 request。等到 responese 傳回之後，會被融合進當下頁面，不需要重新渲染整個網頁。![這裡是示意圖](https://uploads-ssl.webflow.com/5d3a7aed4e11720246d46f49/5ef96d006cdf5806f2f8d29a_ExportedContentImage_02.png)

2. JavaScript：指的是 client 端瀏覽器採用的、用來處理 server response 的程式語言。非同步機制的實現就是 JavaScript 兩個或以上常駐執行緒 ( 例如 JS 執行執行緒、事件觸發執行緒 ... )共同完成的。後來也有出現為了不使用 JavaScript 的 client 端提供的輔助技術。
> 執行緒的共同合作，簡單來說是將同步和非同步的處理分開，然後非同步得到回應後再安插進同步的感覺？，但若有多個非同步的 Ajax，無法保證哪一個會先獲得 server 端的回應，會造成多執行緒的競爭問題（thread racing problem）。

3. XML：資料格式，但實際上現代最常使用的資料格式為 JOSN，可以進一步減少資料量。

非同步請求的使用方法演化：
XMLHttpRequest =>  jQuery 的 `$.ajax()` => ES6 提供的 Promise 、 HTML5 提供的 Fetch API 、 JavaScript 函式庫 axios ... 
但不論是哪種方式，現在都還是可以使用。
> 我只有大概查一下可以使用的方法，但沒有查各自的用法(汗)。

Ajax 剛開始最主要的缺點為，無法使用瀏覽器的後退與加入收藏書籤功能。
由於是動態更新頁面（不重新渲染網頁），使用者無法回到前一個頁面狀態，因為瀏覽器僅記下歷史記錄中的靜態頁面。

解決方法：
HTML5 之前，大多是在單擊後退按鈕存取歷史記錄時，通過使用一個隱藏的 `<iframe>` 來重現變更；而關於無法將狀態加入收藏或書籤的問題，是使用 URL 片斷識別碼（通常被稱為錨點，即 URL 中 # 後面的部分），許多瀏覽器允許 JavaScript 動態更新錨點來保持追蹤。
HTML5 之後，直接操作瀏覽歷史，以字串形式儲存網頁狀態，將網頁加入網頁收藏夾或書籤時狀態會被隱形地保留。

> 大概似乎可以分成兩種事件監聽器，一個負責儲存網頁狀態，包含 URL 錨點部分，以字串形式 ( key(更改的資料): value(錨點值) ) 導向某個 API 儲存起來，書籤的儲存紀錄則是 rootURL + 錨點；一個是當再次照訪書籤中的 URL 時，會觸發事件監聽器，來得知此錨點的歷史紀錄，然後在網頁上渲染出？
> 有試著看程式碼跟查說明，但真的好複雜，只能大概很不確定的覺得是這樣 ... ...，請包容錯很大的部分 (இдஇ;)。


---


## 用 Ajax 與我們用表單送出資料的差別在哪？

1. form：同步請求 vs. Ajax：非同步請求
可以繼續操作，且若 client 端所處地方網路不穩定，或是傳遞的資料量龐大，這段的等待空白時間就會嚴重影響到使用者體驗。

2. form：重新渲染整個網頁 vs. Ajax：只取得必要資料，更換局部內容，不用重新渲染整個網頁。
大幅度降低每次請求與回應的資料量、提高瀏覽速度。


---


## JSONP 是什麼？

JSON with Padding，是利用 HTML Tag `<script>` 的開放特性，繞開同源策略，得到從非同源來源動態產生資料的一種方法。
其實用 JSONP 抓到的資料並不是 JSON，而是 JavaScript，典型會是一段參數為 JSON 格式的函式呼叫之 JavaScript。

實務上在操作 JSONP 時的例子，
通常會預先設定好函式，例如：
`function setData(data) { console.log(data) }` ，而 server 端通常會提供一個 callback 的參數讓 client 端帶過去，像 Twitch API 就有提供 JSONP 的版本 ( http://api.twitch.tv/kraken/games/top?client_id=xxx&callback=aaa&limit=1)，aaa 的部分就是 client 端自行設定的 function 名稱。 server responose 就會是 setData({ JSON 格式 })，當 loadEnd response 後，便會自動執行函式，得到 data。

JSONP 雖然不受同源政策影響，但有幾個缺點：

1. 只支持 GET ，不支持 POST 或其他類型的 HTTP request，因為沒有 response。
2. 安全性問題，因為可以注入任何資料，若是注入的資料裡有帶有惡意的鑽 JavaScript 注入漏洞之程式碼，則可能反而被攻擊。
3. CSRF/XSRF 跨站請求偽造攻擊，惡意網頁可以 JSONP 取得其他網站的 JSON 資料。 => 若 server 端有自己決定 request 的專有性則可以解決。



---


## 要如何存取跨網域的 API？

解決跨網域的方法有很多種，其中 CORS 是最標準、最正確，是一種瀏覽器的技術規範。 CORS 規範中，清楚定義了跨域存取控制的運作方式，透過 server 在 HTTP Header 的設定，讓瀏覽器能取得非同源的資料。

瀏覽器：CORS 把 request 區分成兩種，簡單請求和非簡單請求。
MND 裡有簡單請求的條件，最容易滿足條件的 request 就是沒有任何自定義的 Header 且 method = GET。
若是非簡單請求，瀏覽器會先把真正的 request 擋下來，先發送一個 method = OPTION 的 preflight request 進行測試，來確認後續的 request 的安全性，因為非簡單請求通常會帶有一些使用者資料。
preflight request 主要目的有兩個：
1. 獲取 server 端支持的 HTTP request method。
2. 檢查 server 端是否有提供 CORS。

server 端：response header 欄位是否有 `Access-Control-Allow-Origin` ，收到 response 的瀏覽器會去檢查 header ，若沒有這個欄位，瀏覽器會因為同源政策擋下 response。 => 仍然有收到 response ，只是被瀏覽器擋下而沒有渲染出網頁來。
另外也可以規定 `Access-Control-Allow-Headers` 、 `Access-Control-Allow-Method` 。


---


## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？

最大的原因就是 瀏！覽！器！
因為同源政策、 CORS 都只跟瀏覽器有關係，是只針對瀏覽器的規範。
在第四週用 node.js 發起 request 的時候並不會途經瀏覽器，因此不論是不是同源、server 端支不支持 CORS ，因為沒有瀏覽器這個守門人，所以不會碰到這層限制。
