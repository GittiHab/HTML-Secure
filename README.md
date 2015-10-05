# HTML Secure
Simply upload these files – customize them minimally – add users and you have just secured any static website!

![Screenshot of HTML Secure](https://photos-4.dropbox.com/t/2/AAAkfM9rb-DTaDMHzEyRjIBnu_Ba5ghkxPZHALR9CGCfOg/12/476060260/png/32x32/1/_/1/2/htmlSecureScreenshot.png/EJ7e0e0DGAUgBygH/p8SN4w_LE6t6-45OswG2e7iYDRVAt0NDRqR9gFd75E4?size=1024x768&size_mode=2)

## Requirements

* PHP 5.6<
* SQLite3 Library for PHP
* JQuery is included but not in compatibility mode – you will need to do this

## Usage

#### Installing
1. Simply download the files from this repository
2. Upload them into the folder you would like to secure
3. If the folder you would like to secure is not the root folder (*example.com/*), you will need to edit the *index.php*, *.htaccess* and *js/login.js* files:
  * In the **.htaccess** file change line 5: `RewriteRule ^(.+?)\.html$ /index.php [L,NC]` to `RewriteRule ^(.+?)\.html$ /absolute/path/to/subfolder/index.php [L,NC]`
  * In the **index.php** you only need to change the `ROOT_DIR` constant in line 4: example `define('ROOT_DIR', '/absolute/path/to/subfolder')`
  * And in the **login.js** you will need to change the post request url in line 5: from `/index.php` to (you guest it ;) `/absolute/path/to/subfolder/index.php`
4. You might need to edit login.html, move login.css and login.js to make it fit in your folder.

#### Adding users & logging
When opening *index.php* for the first time a file called *users.sqlite* is created. If you open this file with a sqlite manager (for example [SQLite Manager for Firefox](https://addons.mozilla.org/de/firefox/addon/sqlite-manager/)), you can now add users in the *users* table (**important**: always use lowercase characters for the name and plain-text for the passwords). In the *log* table you will now see which user logged in when.
