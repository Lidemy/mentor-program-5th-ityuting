## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼

* VARCHAR：可以設定最大長度，適合文字量少的欄位，可以有預設值。
> varchar(n)：可變長度的字串。最多 4,000 個字元。
> varchar(max)：可變長度的字串。最多 1,073,741,824 個字元。

* TEXT：不可設定長度，適合用在文字量多的欄位，最多 2GB 字元資料，不可以有預設值。


常用資料型態：

1. 字串(元)資料 (Character & Strings Data)：varchar(n)、varchar(max)、text ... ...。
> > var 前綴：為變長。意思是數據長度沒有達指定長度時，不會自動填充空格。

2. Unicode 字串：nchar(n)、nvarchar(n)、nvarchar(max)、ntext。
> n 前綴：Unicode，字符集。所有的文字都用 2 Byte來儲存，可解決中英文字符集不兼容的問題。(一般而言，英文用 1 Byte 儲存，其他文字則為 2 Byte。)

3. Number 類型：smallint、int ... ...。

4. Date 類型：datetime、date、time ... ...。

5. Binary 類型：TINYBLOB、BLOB、LONGBLOB ... ...。

只列出少數較常用的，其實差別並沒有很大。
不建議在資料庫存入大型資料，因為會影響資料庫的效能。若需要儲存大型檔案，如圖片或 word 檔等，一般儲存其路徑即可。

---

## cookie 是什麼？在 HTTP 這一層要怎麼設定 cookie，瀏覽器又是怎麼把 cookie 帶去 Server 的？

1. 讓瀏覽器儲存資料的地方，伺服器可以要求瀏覽器設置 cookie。
cookie 是一種可以跟 HTTP 一起使用的功能，使無狀態的 HTTP 協定有了有狀態的資訊。
主要用於三種目的：session 管理、個人化、追蹤。


2. 收到一個 HTTP 請求時，伺服器可以傳送一個 `Set-cookie: <cookie-name>=<cookie-value>`。(不同伺服器程式有不同 `set-cookie`。)
cookie 有幾種參數可使用，簡單而言，通常：

(1). 指定 cookie 的可用範圍：`domain`、`path`。
* `domain`：預設值是當前網域，但是不包含其子網域。
* `path`：預設值是當前的路徑。一般而言來說，認證用途的 cookie 會設成根目錄 path=/。

(2). 控制 cookie 的有效期限：`expires`、`max-age`。
如果沒有額外設定 `expires` 或 `max-age` 參數，當瀏覽器關閉之後，儲存在瀏覽器的 cookie 便會消失，就是所謂的 session cookie。
* `expires` 是 UTC 格式表示的有效期限。
* `max-age` 由設定後開始算起，單位為秒。

(3). 和 cookie 安全性相關：`secure`、`HttpOnly`、`SameSite`。
* `secure`：cookie 預設是不區分 http 或是 https 的，此參數的作用在於保護 cookie 只能在 https 傳遞。如果 cookie 設了 secure 參數，只有透過 https 存取這個網站才能存取這個 cookie；透過 http 存取這個網站會看不到這個 cookie。但我們還是不能將敏感資訊儲存在 cookie 中。
* `HttpOnly`：防止 JavaScript 存取 cookie，避免 XSS Attack，避免 JavaScript 程式碼透過表單等方式上傳到 server 取得 cookie。
* `SameSite`：防止 cookie 以跨站方式傳送，幫助避免 CSRF (Cross-Site Request Forgery，跨站請求偽造) 攻擊。三種設定：`SameSite=strict` or `SameSite=lax` or `SameSite=none`。


3. cookie 通常存於瀏覽器中，隨著 request 被放在 request header 內，傳給伺服器。

---

## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？

> 大概有想到的就這幾個，只是開腦洞在想，第三點自己試過已經發現不行，第四點只是有個發想但很不完整，但是我一時也想不出來其他問題了...，所以還是附上，讓助教辣眼睛了(汗)。

1. 因為沒有設定登入的次數，所以應該可以暴力解 SESSID？ 就一直猜一直猜，猜中到某個 SESSID 為止。 

2. cookie 預設是不區分 http 或 https 的，因此如果設立開頭是 http 的 URL，當 client 造訪此 URL 時，瀏覽器就會把 cookie 帶上去，就可以拿到使用者的 cookie 了。

3. 第五週的時候有提到過 SQL Injection，所以如果在登入頁面的會員打上 `'' or 1=1 --` 註解掉後面的密碼，然後密碼可以隨便打，這樣即使沒有辦會員，應該還是可以登入！？
自己嘗試的結果
首先：因為 handle_login.php 是用 `sprintf` 寫的，所以 `$_POST` 帶上去的資料都會變成字串，因此不會註解掉後面的程式碼；但若是有網站是直接 $ 變數帶入 SQL 指令的話，就可以靠這個註解掉後面的程式碼。(應該！？，這麼說來用 `printf` 除了方便還有這種好處呢！)
後來：我把程式碼改成不用 `sprintf`，直接是 SQL，結果跳出警告 Parse error: syntax error, unexpected string content "", expecting "-" or identifier or variable or number......，看來這招行不通，太早期的方法已經被解決封殺了哈哈哈。

4. 前幾週說過 <form> 可以發 request，那如果建設一個假的網站，丟一個
```
<form method="POST" action="real URL">
	<input type='text' name='nickname'> 盜取身分的名字 </input>
	<input type='text' name='message'> 盜取身分發的訊息 </input>
</form>
```
，然後 client 登入了假網站，在不知情的情況下發送了這個表單，那就可以盜用他的帳號留言了？因為 client 發送這個表單的同時應該會把 SESSID 帶上去，但這個做法的前提是要知道真網站的 `<input name="???">` 的 `name` 設什麼，不過這點到真網站打開 DevTool 看 html 就可以了，但還有一個疑問是要在 index.php 按下 submit button 才會跳轉到 handle_add_msg.php，這個要怎麼用表單去執行呢？我想不到 ... ...。第四點不完整，但我還是放到作業上來了。

