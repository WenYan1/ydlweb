-- 张俊杰 2018-12-10
ALTER TABLE `suppliers` ADD `business_license_remark` VARCHAR(255) NULL COMMENT '营业执照打回备注' AFTER `business_license`;
ALTER TABLE `suppliers` ADD `business_license_risk` VARCHAR(255) NULL COMMENT '营业执照风控附件上传' AFTER `business_license_remark`;
ALTER TABLE `suppliers` ADD `tax_registration_remark` VARCHAR(255) NULL COMMENT '税务登记证打回备注' AFTER `tax_registration`;
ALTER TABLE `suppliers` ADD `tax_registration_risk` VARCHAR(255) NULL COMMENT '税务登记证风控附件上传' AFTER `tax_registration_remark`;

-- 张俊杰 2018-12-10 19:23
ALTER TABLE `goods` ADD `hs_code_remark` VARCHAR(255) NULL COMMENT 'hscode打回备注' AFTER `hs_code`;
ALTER TABLE `goods` ADD `original_price_remark` VARCHAR(255) NULL COMMENT '产品单价打回备注' AFTER `original_price`;
ALTER TABLE `goods` ADD `goods_image_remark` VARCHAR(255) NULL COMMENT '图片未通过备注' AFTER `goods_image`;

-- 张俊杰 2018-12-11 14:23
ALTER TABLE `orders` ADD `settlement_type` VARCHAR(255) NULL COMMENT '结算方式' AFTER `settlement_cycle`;