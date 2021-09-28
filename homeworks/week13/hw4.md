## Webpack 是做什麼用的？可以不用它嗎？

Webpack 是一個前端打包程式碼的工具，可以將各種資源舉凡 JavaScript、SASS、JPG 圖片 ... ... 透過其提供的各種 loader 、 plugin 整合成一個檔案輸出。
可以不用它，但便會有以下幾個問題存在：

1. 瀏覽器對於原生語法的支援度，部分瀏覽器無法實現 import、export 、 require ... ... 語法。
2. 要載入的外在資源很多 ( CSS 、 JavaScript 、 img ... ... )，需要個別發送 request。
3. 想要引入 npm 上的第三方 module。
4. ......

webpack 可以幫你解決這些問題，當然你可以不用它，總歸會有辦法解決的，但用了它會很方便 ~

---

## gulp 跟 webpack 有什麼不一樣？

> gulp 跟 webpack 兩者也許可以辦到相同的事情，但在本質上來講是不一樣的東西 -- task manager v.s. bundler。

gulp：task manager，gulp 本身只是空的任務排定器，可以自由排入各種設定觸發條件的 task，藉由引入各種各樣的 plugin 來達成設定的 task，舉凡校正時間、清空桌面 ... ... 任何 task 都可以，只要有現存的 plugin 或是自己寫 plugin 也可以。因此雖然 gulp 本身是做不到 bundle 的，但可以藉由某個叫做 webpack 的 plugin 達成 " bundle 這個 task "。

webpack：bundler，藉由其提供的各種 loader 載入要打包的檔案、模組，然後匯集成一個檔案輸出。webpack 就是一個專業的 bundler，專門 bundle，最主要就是為了解決 browse 不支援 require 等語法，透過 bundle 讓瀏覽器也可以實現，而其他事項則不屬於它的工作範圍。

=> gulp 能做到的事情比 webpack 多元，但若單論 bundle 而言，比較建議使用 webpack ，因為較為大多數人所使用，當然也還是要依照情況來選擇工具。

---

## CSS Selector 權重的計算方式為何？

權重計算方式：
分別累計，此規則之 CSS Selector 使用到的 id 、 class 、 tag 數量，來決定規則的優先度，比較順序為 id > class > tag，先勝出者則為優先。
若權重相同，也就是 id 、 class 、 tag 均不分勝負，則以寫在後面的 CSS 規則為優先。

例如：
若有一個元素同時套用到三個規則，計算以 ( id#, class#, tag# ) 為顯示。

.wrapper { color: red; }  //  => (0, 1, 0)
.wrapper .list .item { color: blue; }  //  => (0, 3, 0)
div.wrapper div.list { color: red; }  //  => (0, 2, 2)

因為依序比較下來由 (0, 3, 0) 率先勝出，此元素會套用第二個規則。


> 例外，若此元素有 inline style，則不論有多少 CSS Selector 的規則套用在此元素上，均由 inline style 勝出，可視作此權重為 (1, 0, 0, 0)。

> 再度例外，若某個 CSS Selector 的某個 CSS 樣式加上了 `!important`，則將此樣式的權重視作 (1, 0, 0, 0, 0)，若有多個 `!important` 的樣式套用在同一元素下，則一樣繼續往下比權重。

> But！通常都不太會使用 inline style 和 `!important` ，此為沒招中的沒招。

