# HTML Secure
Simply upload these files – customize them minimally – add users and you have just secured any static website!

![Screenshot of HTML Secure](https://dl.dropboxusercontent.com/s/mlfz0b0m2egg96k/htmlSecureScreenshot.png?dl=0&s=sl)

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

## License
This repository is licensed under the MIT License. See the `LICENSE` file for full information. You are basically allowed to do anything as long as you include the license and copyright notice.
Anyone having used this repository before the license has been added (as of 18th of June 2018), I grant the [Unlicense](https://choosealicense.com/licenses/unlicense/) (copyright and license does not need to be included).
