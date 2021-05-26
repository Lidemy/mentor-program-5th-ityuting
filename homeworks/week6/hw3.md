## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

1. `<sup>` 上標字、`<sub>` 下標字：維基百科解釋裡常有上標藍字備註，就可以使用 `<sup>` 再配合 `<a>` 達成標註目的。

2. `<select>` 選單 & `<option>` 選單值，屬性有 `size: 顯示高度` 、 `mutiple 多選`。
語法為
```
<select size="3" multiple>
	<option value="1"> 選項1 </option>
	<option value="2"> 選項2 </option>
	<option value="3"> 選項3 </option>
</select>
```

3. `<code>` 用於列出一段程式碼


## 請問什麼是盒模型（box modal）

每一個元素都有 box modal，示意圖類似俄羅斯娃娃，一層套一層，基本組成由內至外為：content(包含 width、height)、padding、border、margin，整體為 box modal。可藉由 box modal 看到元素的屬性設計。


## 請問 display: inline, block 跟 inline-block 的差別是什麼？

`display: block`：預設的 HTML label 有 `div` 、 `h1` 、 `p` ...，預設值為佔滿一整行，可以調整任何屬性，包含 width、height、padding ...，但 box modal 上所佔仍然是一整行。

`display: inline`：預設的 HTML label 有 `span` 、 `a` ...，寬高為內容大小，調整 padding、margin 對上下沒用、但左右會撐，但不會將其他的元素撐開。

`display: inline-block`：將 inline 及 block 的優點綜合起來，像 inline 一樣，預設的寬高為內容大小；但像 block 一樣，可以調整任何屬性。


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

`position:static`：網頁預設值，更改其中一個元素的位置，會連帶影響其他的元素，整體移動。

`position:relative`：更改其中一個元素的位置，不會影響到其他的元素，獨立移動。

`position:absolute`：需要有參考點，為往上找第一個階層不是 static 的元素。會抽離原本的定位系統，其他的元素會遞補上去。

`position:fixed`：參考點為 viewport，會固定在所見視窗的某個位置，不會隨著滾軸移動。
