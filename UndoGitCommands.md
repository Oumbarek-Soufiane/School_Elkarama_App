# Git Undo and Revision Commands

## Undo Git Add Command
To undo a `git add` command, use the following:
git reset <file>

## Undo Git Commit Command
To undo the last git commit while keeping changes staged, use:
git reset --soft HEAD^

## Undo Git Add and Commit in One Command
To undo both the last `git add` and `git commit` in a single command, use:
git reset HEAD^

**Note:** Be cautious when using `git reset HEAD^` and `git reset --hard HEAD^`, especially if the commit has been pushed to a shared repository. It is recommended to use `git revert` to create a new commit that undoes the changes, preserving commit history.

## Undo Git Pull Command (Not Committed Yet)
If changes from a `git pull` have not been committed yet, use:
git reset --hard HEAD^

## Undo Git Pull Command (Already Committed)
If changes introduced by a `git pull` have been committed, use:
git revert -m 1 <commit-hash>

## Undo Git Push Command
To undo a `git push` command, revert the commit and then push again:
git revert [commit hash]
# Note: Find the commit hash with
git log -p
# Followed by
git push

## Changing Last Commit Message
To change the message of the last commit, use:
git commit --amend -m "new message."

## Backup Branch with Current Changes
To create a backup branch with your current changes, follow these steps:
git branch my_backup_branch
git checkout my_backup_branch

# Return to your original branch with
git checkout branch_name
