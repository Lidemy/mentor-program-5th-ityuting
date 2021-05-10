## 請以自己的話解釋 API 是什麼

API 的 I 是 Interface，介面，為兩方溝通或是交換資訊的媒介。
API 是對於工程師而言的一個名詞，舉例而言，當一位工程師在開發應用程式 A，想要將應用程式 B 的資訊使用在應用程式 A 時，就需要使用應用程式 B 提供的 API。畢竟應用程式 B 不可能將它的資料庫開放給任何人使用，所以會提供一個 API，來決定其他人透過這個 API 可以取得資料庫裡的哪些資訊。
簡單來說，大概就是傳遞資料的中間者，而 API 的背後其實就是一套交換資訊的函式，可以用來取得資訊或更新資訊。


## 請找出三個課程沒教的 HTTP status code 並簡單介紹

300：request 有一個以上的 response data，client 端應該從這些 response data 裡選擇一個。response 裡應該會列出這些 data 分別對應到的 URL，client 端再從中選擇一個進行重新導向。

401 vs. 403
401：client 沒有必要的認證資訊，若 request 裡有包含 Authorization 資訊，則代表 server 端拒絕或不接受這個身分驗證。除此之外也可能是因為網域問題而被拒絕。 // 大概就例如校園內部的身分驗證必須要透過校園內網才能登錄，如果是透過校外網域，即使帳密正確也無法登錄？ 
403：身分驗證也許是正確的，但 server 仍然拒絕執行這個 request。 // 跟 404 不同的是，403 應該會在 response 裡敘述為何拒絕的原因，不然就直接給個 404 就好惹。

405：server 端理解 request 的內容，但這個 request method 被設定為禁用。其中 `GET` 和 `HEAD` 不應該該被回傳此 status code。 // 解決方法應該是換一個可以達到相同目的的 request method，聯想到 RESTful，不同的 method 可以達到相同目的，`DELETE` 也可以用 `POST` 辦到，其實還是要看 server 端的程式碼是怎麼寫的。


## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

root URL：http://XXX.XXXXXXXX.XXXXXXX.XXX

|    function    | HTTP method |       path       |   parameter   |   description   |
|:---------------|:------------|:-----------------|:--------------|:----------------|
|回傳所有餐廳資料| GET         | /restaurants     | _limit=筆數   | _limit上限：XXX |
|回傳單一餐廳資料| GET         | /restaurants/:id | none          | :id 自行查閱    |
|刪除餐廳        | DELETE      | /restaurants/:id | name:餐廳名   | :id 自行查閱    |
|新增餐廳        | POST        | /restaurants     | none          |                 |
|更改餐廳        | PATCH       | /restaurants/:id | name:新餐廳名 | :id 自行查閱    |


// URL：通訊協定 + DNS 網域名稱（到此通常為提供之 root URL）+ path + ?parameter
// 例子：http:// + XXX.XXXXXXXX.XXXXXXX.XXX + /restaurants + ?limit:10 --> http://XXX.XXXXXXXX.XXXXXXX.XXX/restaurants?limit=10
