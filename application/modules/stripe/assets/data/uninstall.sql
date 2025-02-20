DELETE FROM `payment_method` WHERE `payment_method`.`payment_method` = 'Stripe';
DELETE FROM `paymentsetup` WHERE `paymentsetup`.`paymentid` = '8';
DELETE FROM `acc_coa` WHERE `acc_coa`.`HeadCode` = '102010305';