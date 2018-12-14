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

-- 张俊杰 2018-12-11 20:00
ALTER TABLE `recharge_logs` ADD `account_name` VARCHAR(255) NULL COMMENT '付款人账户名' AFTER `user_email`;
ALTER TABLE `capital_logs` ADD `factory_account_name` VARCHAR(255) NULL COMMENT '加工厂账户信息' AFTER `capital`;
ALTER TABLE `capital_logs` ADD `account_name` VARCHAR(255) NULL COMMENT '账号信息' AFTER `factory_account_name`;

ALTER TABLE `orders` ADD `first_payment_remark` VARCHAR(255) NULL COMMENT '首付款(元) 风控备注' AFTER `settlement_type`;
ALTER TABLE `orders` ADD `original_place_remark` VARCHAR(255) NULL COMMENT '境内货源地 风控备注' AFTER `first_payment_remark`;

-- 张俊杰 2018-12-12 10:00
ALTER TABLE `suppliers` ADD `organization_code_remark` VARCHAR(255) NULL COMMENT '近期开过的发票样本未通过备注' AFTER `organization_code`;
ALTER TABLE `suppliers` ADD `organization_code_risk` VARCHAR(255) NULL COMMENT '近期开过的发票样本风控附件上传' AFTER `organization_code_remark`;

-- 张俊杰 2018-12-12 11:00
ALTER TABLE `orders` ADD `customs_declaration` VARCHAR(255) NULL COMMENT '报关单号' AFTER `original_place_remark`;
ALTER TABLE `orders` ADD `commodity_code` VARCHAR(255) NULL COMMENT '商品编码' AFTER `customs_declaration`;
ALTER TABLE `orders` ADD `date_departure` VARCHAR(255) NULL COMMENT '出口日期' AFTER `commodity_code`;
ALTER TABLE `orders` ADD `usd_total` VARCHAR(255) NULL COMMENT '申报美金总价' AFTER `date_departure`;
ALTER TABLE `orders` ADD `usd_unit_price` VARCHAR(255) NULL COMMENT '申报美金单价' AFTER `usd_total`;


-- 张俊杰 2018-12-12 13:00
--
-- 表的结构 `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL COMMENT '用户ID',
  `user_email` varchar(255) DEFAULT NULL COMMENT '用户邮箱',
  `order_number` varchar(255) DEFAULT NULL COMMENT '订单号',
  `tax_refund` varchar(255) DEFAULT NULL COMMENT '报关单退税联（上传附件）',
  `supply_contract` varchar(255) DEFAULT NULL COMMENT '供货合同（上传附件）',
  `invoice` varchar(255) DEFAULT NULL COMMENT '增值税发票（上传附件）',
  `is_identification` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否认证 1是 2否 0默认',
  `anticipated_tax_refund` varchar(255) DEFAULT NULL COMMENT '预计退税款',
  `is_end` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否收齐 1是 2否',
  `created_at` int(11) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='单据收集表';

ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- 张俊杰 2018-12-12 16:00
INSERT INTO `admin_modular` (`id`, `permission_name`, `modular_explain`) VALUES (NULL, 'collection', '单据收集');

-- 张俊杰  2018-12-14 10:00
ALTER TABLE `goods` ADD `goods_url` VARCHAR(255) NULL COMMENT '产品售卖链接' AFTER `goods_volume`;
ALTER TABLE `suppliers` ADD `allowance_limit` VARCHAR(255) NULL COMMENT '函调垫税限额' AFTER `tax_registration_risk`;
ALTER TABLE `suppliers` ADD `tax_paid_advance` VARCHAR(255) NULL COMMENT '已垫付税款金额' AFTER `allowance_limit`;
ALTER TABLE `suppliers` ADD `other_image` VARCHAR(255) NULL COMMENT '其他上传' AFTER `tax_registration_risk`;
ALTER TABLE `suppliers` ADD `other_image_remark` VARCHAR(255) NULL COMMENT '其他上传未通过备注' AFTER `other_image`;
ALTER TABLE `orders` ADD `service_type` TINYINT(1) UNSIGNED NULL DEFAULT '0' COMMENT '服务类型 0未选 1退税 2退税+代采购' AFTER `delivery_time`;