## SHEEAN BIN WESDI (24FTT1083) ##
**LOGBOOK FOR GITHUB AND LARAVEL HERD**

**Github REPOSITORY CREATION:**

**note open terminal and use git --version to check if git is installed**

1. mkdir examplefilename (folder creation) 

2. cd examplefile (go into folder)  

3. git init (initialize git for the selected folder)

4. git status (check status if git is installed)

**note ls stands for list items in folder**

**COMMITING CHANGES IN A GIT FOLDER:**

1. git add text.txt (adding .txt file to folder) (ensure to add .txt file maunally thru files)

2. git commit -m "creation note" (commit and add a note)
 
3. git diff (check changes in the folder) (shows only if a change in the .txt file has been made without commit)

**git add . (adds all files changes)**

**EMAIL CONFIGURATION**

1. git config --global user.username <USerNamE> (name registered in github, this case Sheean-31)

2. git config --global user.username (check user)

**REMOTE REPOSITORY:**

**Go to github and create a new repository**

1. git remote add origin <URLFROMGITHUB> (local repo connects to the remote repository)

2. git push origin <master> (sends a branch called master branch to the repo)

3. git pull <remotename> (e.g origin) <branchname> (e.g master)

4. git remote -v (check current remote adress)

**FORK AND CLONES:**

**forks are clones of a repo does not affect main repo**

cd .. (. means step out directory once)

git remote set-url <REMOTENAME> <URL> (change remote URL)

1. git clone <URLFROMGITHUB> (clones a fork)

2. git remote add upstream <URLOFTHEOGREPO> (connect to a new repo)

**BRANCHES**

**NOTE: branches are case-sensitive**

1. git branch <BRANCHNAME> (creation of new branch)

2. git checkout <BRANCHNAME> (go into stated branch), (-b to add new branch)

3. git push origin <BRANCHNAME> (update fork)

git branch (list branches)

git branch -m <newname> (rename branch)

**PULLING:**

1. git pull <REMOTENAME> <BRANCHNAME> (pulls changes from the repo)

**PULL REQUEST**

Click new pull request in github and select branch you want to submit 

**MERGING**

1. go into branch you want to merge into using 'git checkout <branchname>'

2. git merge <BRANCHNAME> (merge the stated branch into the one your in)

3. git branch -d <BRANCHNAME> (delete branch that isn't used anymore)

4. git push <REMOTENAME> --delete <BRANCHNAME> (delete branch from remote repo)

5. git pull upstream <BRANCHNAME> (pull changes from repo)

## LARAVEL HERD ##

1. ensure when creation of website use livewire, create database using tableplus with command CREATE DATABASE <name>

2. good habit to php artisan <filename>:clear to clean up cache, use php artisan migrate to check if any errors has occured.

3. composer dump-autoload (optimizes files)