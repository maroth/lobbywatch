<?
// Upgrage Todos UPG

/*

## PHP 7.2 and MySQL 5.7

* check debian PHP 5.7 and MySQL 5.7
* abel: docker mysql respect my.cnf config
* abel: PHP 7.2
* abel: setup php.ini for PHP 7.2
* abel: setup Apache2.4
* abel: docker MySQL 5.7
* abel: setup my.cnf for docker MySQL 5.7
* TODO forms: fix sql_mode=only_full_group_by
* TODO abel: create docker MySQL symlinks
* abel: setup PhpMyAdmin
* TODO abel: change back to 127.0.0.1 instead of localhost/socket (php.ini, my.cnf)
* TODO abel: start mariaDB 10.2 on 3307
* TODO change scripts to PHP 7.2
* TODO change scripts to docker MySQL 5.7
* TODO upgrade PHP mysql connector to lasted version
* TODO upgrade Python mysql connector to lasted version
* TODO upgrade Java mysql connector to lasted version
* TODO RPIW: upgrade RPIW PHP 7.2
* TODO RPIW: upgrade RPIW MySQL 5.7
* TODO understand /debian/pool/main
* TODO drupal see PHP 7.2 errors
* TODO test Drupal PHP 7.2
* TODO patch Drupal
* TODO cyon: patch Drupal
* TODO cyon: set PHP 7.2
* TODO upgrade tabula
* TODO send bug report to SQLMaestro because of wrong array init

## 2nd Prio
* check custom files for changes
* Check utils.createLoadingModalDialog(localizer.getString('Deleting')).modal();
* Improve and update security
* Remove ^M in generated *.js files
* remove trailing whitespace in generated code, https://stackoverflow.com/questions/9532340/how-do-i-remove-trailing-whitespace-using-a-regular-expression
* Use public_html/bearbeitung/components/common_utils.php
* improve custom/custom_page.php

Done:
* Test application features
* Remove calls to $this->RenderText()
* Check UID WS Call from Button in Organisation Edit
* Remove UPG todo tags
* AJAX broken: Quick search
* AJAX broken: Detail records with +
* Update custom_templates
* Afterburner which necessary, clean up
* SelectedOperationGridState migration
* export lobbywatch.sql
* Migrate Sources to UTF-8
* Find latin-1 files
* Delete all public_html/bearbeitung files and detect unnecessary files
* remove convert_utf8() calls

*/

/*

## Custom features added to PHPGen framework

* Comments on edit forms
* Bulk Ops
* Enhanced comments on grid header
* Call UID WS
* Marked fields on edit/insert form
* Custom main.css
* Custom main.js
* Preview parlamentarier
* Default filter out retired parlamentarier [rework]
* Improved security [rework]

*/

/*
Test report 01.07.2018/Osaka

* Enhanced comments on grid header → OK
* Bulk Ops → OK
* Comments on edit forms → OK
* Marked fields on edit/insert form → OK
* Call UID WS → OK
* Custom main.css → OK
* Custom main.js → OK
* Preview parlamentarier
* Default filter out retired parlamentarier [rework]
* Improved security [rework]
