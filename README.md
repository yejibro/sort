# sort.php
A script I've been using for some time to sort my pics
If you really wanted to set it up and use it you'd have to edit a few
variables and the wh*telist in the file, it's really simple!
I'm using this on a Mac with mod_userdir enabled in apache2, but it should
work on Windows and Linux too. Pics are sorted in 2-level hierarchy,
individuals have their own folders in group's dirs like this:
```
├── aespa
│   ├── giselle
│   ├── karina
│   ├── ningning
│   └── winter
├── aoa
│   ├── mina
│   ├── seolhyun
│   └── yuna
├── apink
│   └── naeun
```
When 2 or more girls from one group are in one photo I usually move it to
their group's folder.

## Usage
The pics are picked randomly from general pics folder specified in the
`$SAMSARA` variable (such a dumb name!)

On the top of the website there are 2 textboxes, the first one is
a filename input and the second one is a path. You can change the
filename and create new folders here. To create new folders just type
the path and it'll be created even if the parent directory doesn't exist
(like th e -p option in GNOO Coreutils). If you don't want to change the
filename and have a directory already created you can just click buttons
to move pics. Simple, isn't it?

Since it's apache-based you can access this web-app in most default
configurations from any device in your LAN.

## Variables to edit
`$APACHEDIR` - apache root directory. For many Linux distros this will be
probably something like `/var/www/html` or `/srv/http`

`$CLIENTPREAPACHESTRING` - directory with sort.php and all the folders.
With mod_userdir enabled this will be your username - "~user/"

`$SAMSARA` - the folder with all pics you want to sort. Has to be
accessible by the browser!

`$MOKSHA` - the output folder where the whole tree structure will be
created

## The `sync_local` script
With this script I put all pics from my Downloads folder in the sorting
machine for later. It also sets files' permissions so they can be moved
by the httpd user and deletes duplicates with the `dupinator.py` Python script.

Happy sorting!
