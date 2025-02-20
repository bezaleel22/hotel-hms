DELETE FROM `language` WHERE `language`.`phrase` = 'hello,_how_can_we_help_you?
';
DELETE FROM `language` WHERE `language`.`phrase` = 'whatsapp_setting';
DELETE FROM `language` WHERE `language`.`phrase` = 'whatsapp_phone_numer';
DELETE FROM `language` WHERE `language`.`phrase` = 'whatsapp_phone_numer_internation_standard';
DELETE FROM `language` WHERE `language`.`phrase` = 'whatsapp_chat';
DELETE FROM `language` WHERE `language`.`phrase` = 'whatsapp';
DELETE FROM `language` WHERE `language`.`phrase` = 'ischatenable';
DELETE FROM `language` WHERE `language`.`phrase` = 'wporder_enable';
DELETE FROM `language` WHERE `language`.`phrase` = 'whatsorderplace';
DELETE FROM `language` WHERE `language`.`phrase` = 'hello,_how_can_we_help_you?';
DELETE FROM `sec_menu_item` WHERE `sec_menu_item`.`module` = 'whatsapp';
ALTER TABLE setting
  DROP COLUMN whatsapp_number;
