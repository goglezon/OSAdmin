UPDATE `osa_module` SET `module_url` = REPLACE( `module_url` , '/', '/panel/' );
UPDATE `osa_menu_url` SET `menu_url` = REPLACE( `menu_url` , '/admin', '/panel' );
UPDATE `osa_menu_url` SET `menu_url` = REPLACE( `menu_url` , '/index.php', '/panel/index.php' );