## 交作業流程

1. 在 local 端新開一個 名叫 week1 的 branch：`git branch week1`。

2. 完成並確認過 week1 hw1 ~ hw5 的作業，新增到 week1 branch 裡：`git commit -am "final week1 allhw"`。

3. 連到 GitHub 遠端的 reporitory：`git remote origin add origin <HTTPS>`（<HTTPS> 是網址）。

4. push 到 GitHub 遠端的 reporitory：`git push -u origin <branch>`（<branch> 是分支名字）。

5. pull request 到 master 上，到學習系統繳交作業。

6. 等待助教批改過後，助教會按確認 pull request，並把遠端的 branch 刪掉。

7. 將遠端 master 改過的作業 pull 下來到 local 端 master：`git pull -u origin master`。

8. 可以將 local 端 week1 branch 刪掉：`git branch -d week1` or `git branch -D week1`。