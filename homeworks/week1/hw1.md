## 交作業流程

1. 在 local 端新開一個 名叫 week1 的 branch：`git branch week1`。

2. 切換至 week1 branch：`git checkout week1`。

3. 完成並確認過 week1 hw1 ~ hw5 的作業，新增到 week1 branch 裡：`git commit -am "final week1 allhw"`。

4. 連到 GitHub 遠端的 reporitory：`git remote origin add origin <URL>`（<URL> 是網址）。

5. push 到 GitHub 遠端的 reporitory：`git push -u origin <branch>`（<branch> 是分支名字）。

6. pull request 到 master 上，到學習系統繳交作業。

7. 等待助教批改過後，助教會按確認 pull request，並把遠端的 branch 刪掉。

8. 確認切換至 local 端的 master branch：`git checkout master`。 

9. 將遠端 master 改過的作業 pull 下來到 local 端 master：`git pull origin master`。

10. 可以將 local 端 week1 branch 刪掉：`git branch -d week1` or `git branch -D week1`。