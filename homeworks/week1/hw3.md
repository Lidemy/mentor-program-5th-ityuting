## 教你朋友 CLI

備註：我當成是要打給朋友看的文，所以可能會穿插一些廢話及語助詞ˊˇˋ
> 以下為作業內容－－


朋友，你就這樣直接跑走了也太ㄎㄅ了吧。(X)
但沒辦法，誰叫我這麼善解人意，你就感激的閱讀吧！(X)

好啦首先，在講 CLI(Command Line Interface) 之前，要先來講講 GUI(Graphical User Interface) 是什麼？
就是你平常對電腦操作的那些點右鍵可以複製、貼上、剪下 ...... 等的動作時，電腦螢幕顯示出來的介面就叫做 GUI，你只需要這裡點點那裡拉拉，就可以對電腦下達指令。
而 CLI 就是在 GUI 還沒出現前，工程師對電腦用純文字來下達指令的方式，嘿啦，就是你可能在電影看過的，駭客的電腦上只有黑色背景，然後只有一大堆數字英文的那個介面啦，就是在那個介面上對電腦下達 command line(CL)，而在 Mac 上那個介面叫作 Terminal，在 Windows 上叫作 cmd 命令提示字元。


---


現在來跟你講講幾個常用的 Command Line，我從自己的筆記直接複製過來。
Command Line 也能搭配所謂的參數，讓指令更多元，語法通常是 `CL 參數`。

> <file>：file name、<DIR>：directory name、<CL>：command line

1. `pwd`(Print Working Directory)：讓電腦告訴你現在所處的位置。
	* `pwd`：就會顯示出來～

2. `ls`(List)：列出你所處的資料夾下的所有檔案。
	* `ls -l`：印出所有非隱藏檔案的仔細內容。
	* `ls -a`：印出所有隱藏檔案的仔細內容。
	* `ls -al`：印出所有檔案的仔細內容，包括非隱藏和隱藏的。

3. `cd`(Change Directory)：切換資料夾。
	* `cd <DIR>`：切換到所處位置的資料夾，可以先用 ls 知道有哪些資料夾。
	* `cd ..`：回到上一層。
	* `cd ～`：後目錄，到使用者專屬的資料夾，是某個特定位置。
	* `cd / `：根目錄，電腦最底層的檔案。

4. `man`(MANual)：使用說明，進入說明後按 q 可離開說明頁面，只有 Mac 有的指令，Windows 可使用 `help`。
	* `man <CL>`：例如 man ls。

5. `touch`：碰一下檔、建立新檔案。 
	* `touch <file>(原本就存在的)`：碰檔案，以圖像化而言就類似點擊這個檔案，可以看到修改日期變成最新。
	* `touch <file>(原本不存在的)`：建立新檔案。

6. `rm`(ReMove)：刪除檔案。
	* `rm <file>`。
   `rmdir`(ReMove DIRectory)：刪除資料夾。
	* `rmdir <DIR>`：刪掉 <DIR> 這個資料夾。
 
7. `mkdir`(MaKe DIRectory)：建立資料夾（vs. 建立檔案用 `touch`）。
	* `mkdir <DIR>`：建立 <DIR> 這個資料夾。

8. `mv`(MoVe)：移動檔案、改檔案名。
	* `mv <file1>`(原本就存在的) <file2>(原本不存在的)：將 檔案1 移到 檔案2 ，若原先沒有 檔案2，就等於是重新命名。
	* `mv <file> <DIR>`：把檔案移到資料夾裡。

9. `cp`(CoPy)：複製。
	* `cp <file1>(欲複製的檔名) <file2>(複製後的新檔名)`：複製檔案。
	* `cp <DIR1>(欲複製的資料夾) <DIR2>(複製後的新資料夾)`：複製資料夾。	


---


好啦！終於終於，來到了你要的「用 command line 建立一個叫做 wifi 的資料夾，並且在裡面建立一個叫 afu.js 的檔案」。
我們就一個步驟一個步驟拆解嘿：

> 給我自己操作一次！

1. 首先到你想要建立資料夾的位置。
	先看自己的位置：`pwd`。
	移動到你要的位置：利用 `ls`、`cd`。

2. 建立一個叫 wifi 的資料夾。
	建立：`mkdir wifi`。
	移動到資料夾內部：`cd wifi`。

3. 建立一個叫 afu.js 的檔案。
	建立：`touch afu.js`。
	哦對了順便在跟你說一個可以看到檔案內容的 CL：`cat afu.js`。


---


基本的差不多就這樣，你可以自己試試看，如果有什麼問題再密我嘿。
