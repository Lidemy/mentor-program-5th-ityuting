## 跟你朋友介紹 Git

備註：我當成是要打給朋友看的文，所以可能會穿插一些廢話及語助詞ˊˇˋ
> 以下為作業內容－－


好的朋友，你要的 Git（雙手奉上www）。

Git 的功能是什麼呢？其實你來問我的時候已經講到啦！
「我的笑話是會演進的。會有版本一、版本二甚至到版本十，這樣我就要建立好多個不同的檔案」，就是這段。
Git 其實就是代替你幫你做這件事情，當然實際上 Git 並不是像這樣建立這麼多個檔案，不然你就自己來就好了，而且也很佔容量，就沒有使用 Git 的意義了。Git 只是記錄不同版本之間的「差異」，換句話說就是你更動過的部分。但為了方便理解，可以用檔案的方式來思考。


---


先說說 Git 的運作流程，首先，你先想像一個樹狀圖，樹狀圖上有很多條分支，最主要的那個分支叫作 master(or main)，其他分支叫作 branch。
當你每次的完成一個版本最終版，才會放在 master，可以想像成在 master 上新增了一個新版本，想要找過去的版本時，只要沿著 master 這條分支往回查看就行。
而當你想要思考新笑話內容時，可以開一個 branch 出去獨立作業，等你完成一個這個笑話版本時，就可以把這個 branch 的最終確定板給移回 master上。


---


很抽象沒關係，先有大概的脈絡，我們繼續釐清。
接下來就介紹一些關於 Git 的指令，你可以搭配下面這兩張圖去思考。

![圖片一](https://ithelp.ithome.com.tw/upload/images/20190910/20119923JfqpZUcmua.jpg)

![圖片二](https://trello-attachments.s3.amazonaws.com/583c75c90173173906e0b4ce/1023x654/ad3080ce58b146f8f0b5e343771a8a17/_output_gitlifecycle.png)


> 然後需要你先對等等會講到的名詞，它們之間的層級有個概念：
> 專案資料夾（你所處的位置） > 分支（master or branch） > 版本 > 檔案

> 下述指令主要是在某一條分支上，對於「版本」、「檔案」操作的指令。
> 食用配方：建議一邊看以下的說明、一邊跟著操作看看啦！
> <file>：file name、<version>：version name


1. `git init`(initialized)：這是要用 Git 作版本控制時，第一個指令。告訴電腦你現在要開始用 Git 做版本控制，電腦會在你所處的位置建立一個 .git 的資料夾，裡面是版本控制所需要的各種資訊，代表你這個資料夾裡的檔案現在被 Git 控制了。

2. `git status`：可以查看你所在的分支上檔案的狀態。畫面上可以看到某些提示：
	(配合圖片二)
	* untracked：從未加入到 Git 控制下。
	* modified：修改過後，但還未加入 staged。
	* staged：表示加入版本控制，在 staged 狀態的檔案才可以新增到分支上。

3. `git add`：將檔案加入 staged 狀態。
	* `git add <file>`：將此 <file> 檔案加入 staged。
	* `git add .`：將此專案資料夾下的所有檔案都加入 staged。

4. `git rm --cached <file>`：將此 <file> 檔案移出版本控制，回到 untracked 狀態。

5. `git commit`：進入 commit 跟 vim 時有點像，`:q` 可以離開、`:wq` 輸入完儲存離開 ……，然後如果沒有 new message（對這個新版本的敘述），系統會告訴你且不會更新新版本（也就是將新版本加入分支上），此時就需要，
	* `git commit -am "msg"`：通常加入新版本會直接用這個指令，add 跟 commit 的結合，msg 為對這個版本的一些敘述，指令上 windows 系統要用 ""，Mac 系統 "" 或 '' 均可。不過若是完全初始的新檔案（untracked），則不會被加進去，必須是已經 tracked but not staged，才會被 `-am` 直接加入 staged 狀態，若是新檔案還是要用 `git add`、`git commit`，接下來才可以直接使用 `git commit -am "msg"`（因為已 tracked）。  

6. `git log`：可以看到這個分支上的版本歷史（commit 過的）。版本名稱會是亂數，當成版本的 id 就行。
	* `git log --oneline`：只會看到簡單的資訊，查詢版本號時好用，顯示上只會有版本號的前七碼，但因為前七碼通常就不會重複，所以可以直接代指整個版本號。
	

> 當更改檔案之後，決定要更新版本，就要先`git add` ，告訴電腦你要加進版本控制，然後再`git commit`，或是直接`git commit -am "msg"`。若要看以前的版本檔案，可以想成你要先跳到之前的那個版本，如以下：

　
7. `git checkout`：轉換版本。
	* `git checkout <version>`：圖形化介面就會回到那個版本。

8. .gitignore：這不是指令，而是一個檔案名稱，但是非常好用，通常在開始 Git 執行後的首要，會先設定這個資料夾。`touch .gitignore` --> `vim .gitignore`，然後在 .gitignore 這個檔案裡新增你想被 Git 忽略的檔案名（也就是不會加入到版本控制裡的），如此一來在改好新檔案時，就不用 `git add <file>` 個別慢慢加，可以直接 `git add .` 一次加入然後 commit，因為 Git 會自動忽略那些不想加入的檔案。所以通常會放在 .gitignore 裡的都是一些跟使用者相關，或是幾乎不會更動的檔案，或是作業系統產生的檔案。

9. `git diff`：可以看到這次 commit 前，跟上次的版本差在哪裡。


> 看完上述，你可能霧煞煞的，來實際操作一次哦！狀況劇 action～

1. 假設現在所在資料夾裡有 haha.txt 笑話檔案。你要開始對這個資料夾裡的檔案作版本控制：`git init`。

2. 此時 haha.txt 對 Git 而言是 untracked 的檔案，而你想要當成版本一：`git add haha.txt` --> `git commit -m "version one"` 。

3. 然後你更改了 haha.txt（此時已是 tracked 的檔案了）的內容，多了好幾個笑話，決定要新增版本二：`git commit -am "version two"` 。

4. 過了幾天，突然想看看最初的版本長什麼樣子：`git log`，找到版本一的 id，`git checkout <verstion1>`，就回到最初版，可以點開 haha.txt 看囉。
   或者因為目前只有兩個版本，只是想知道跟上一次版本比多出什麼笑話內容：`git diff` 。


---


> 休息一下，再想一次上面的嘿，接著要來說說關於 branch 的指令，主要是跟分支相關的指令。
> <branch>：branch name


1. `git branch`：開新分支、複製分支。會從所在的分支出去，新分支出去的分支會沿用所在分支的所有版本。
	* `git branch <branch>`：新增分支。
	* `git branch -d <branch>`：刪掉分支。
	* `git branch -v`：查看所有分支的最後一個 commit。

2. `git checkout`：前面提到這個指令時，是用來切換所在分支上的版本，但若加的是分支名字，則可以用來切換分支。
	* `git checkout master`： 回到最新版本，意思是：「回到 master 的最新版本」，並不代表整個專案的最新版本。舉例來說，假設你目前在 new-branch 上面開發，那這個 new-branch 上的最新版本才會是整個專案的最新版本，但只是還沒開發完成，尚未加入 master。master 跟其他 branch 一樣，都只是一個分支而已，唯一的差別是它是預設的主分支。
	* `git checkout <branch>`：切換分支。
	* `git checkout -b <branch>`：新開一個分支，並且切換過去。
		
3. `git merge`：合併分支。
	* `git merge <branch>`：把名為 <branch> 的分支合併到你所在的分支（不一定是 master）上。
		
	
4. conflict：當 merge 兩個分支時有了衝突，原因可能是個別的版本裡，兩條分支都更改了相同的檔案，那 Git 就不知道該留哪一個版本的此檔案了。但Git 還是滿聰明的，它無法決定，於是它會告訴你衝突的地方在哪，由你來決定，這時候就需要你還手動更改衝突的檔案了，Git 會把檔案的衝突地方顯示出來，你可以選擇都很好所以都留，也可以選擇都不好都刪掉，或是指留某一個，甚至是突然靈感來了又新增內容上去，總之改好檔案之後，再 `git commit -am "msg"`，就解決衝突了。


> 當然，在你跳到某一條分支後，就可以對底下的版本、檔案操作，方法就跟最前面說的一樣。


---


會開多條分支的最主要原因就是為了跟別人一起分工，想笑話總有靈感枯竭的時候嘛，如果可以你負責改 haha.txt，我負責改 wwww.txt，最後合併在一起，省時又省力，那不就皆大歡喜了嘛！但是我們又不會用同一台電腦，這樣開分支的意義在哪？我個人覺得 `git branch <branch>` 就是搭配 GitHub 一起使用的。
GitHub 是什麼呢？是放 repository 的資料庫（也有其他的資料庫，這裡用 GitHub 為例子），那麼實際上有什麼關係呢？接下來就要來說一些可以跟 GitHub 上的專案互動的指令。
你可以想成 GitHub 上的專案 跟 電腦端的專案 是獨立但彼此之間可以互相傳送資料。


1. `git remote add origin <HTTPS>`：想上傳或下載資料，首先都要先跟 GitHub 遠端的 repository 連線，<HTTPS> 是 repository 所在的網址。

2. `git push`：電腦上的專案跟 GitHub 是不會自動同步的，必須靠你去手動發送指令將分支推上去（也就是傳送過去）。
	* `git push -u origin master` or `git push -u origin master`：若更新了電腦端 master 分支的版本，想要推到 GitHub 上。
	* `git push -u origin <branch>` or `git push -u origin <branch>：若更新了電腦端 <branch> 分支的版本，想要推到 GitHub 上。

3. `git pull`：若相反，是 GitHub 上的 repository 被改動了，要怎麼把最新的分支拉下來？
	* `git pull -u origin master`。
	* `git pull -u origin <branch>`。
	（若有 conflict 的時候，就跟前面所提的一樣手動更改就行，可以想像成是電腦端的分支跟遠端的分支要 merge 啦。）

4. `git clone`：若想 download 的是整個 repository。
	* `git clone <HTTPS>`。

---


最後最後，重要的是要實作看看唷，如果你操作上有什麼問題的話，可以再來問我嘿。
