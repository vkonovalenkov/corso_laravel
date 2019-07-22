Se dopo : $ git pull
error: The following untracked working tree files would be overwritten by merge:
 .idea/encodings.xml
        .idea/misc.xml
        .idea/modules.xml
        .idea/php.xml
        .idea/vcs.xml
        .idea/workspace.xml
Please move or remove them before you merge.
Aborting

Fare:

$ git reset --hard origin/master

Dovrebbe uscire:->
HEAD is now at bc6e2e4 lezione 109 ufficio

Dopodiche fare:
git pull
