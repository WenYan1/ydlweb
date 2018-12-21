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
ALTER TABLE `suppliers` ADD `other_image_risk` VARCHAR(255) NULL COMMENT '其他上传未通过备注' AFTER `other_image`;
ALTER TABLE `orders` ADD `service_type` TINYINT(1) UNSIGNED NULL DEFAULT '0' COMMENT '服务类型 0未选 1退税 2退税+代采购' AFTER `delivery_time`;

-- 张俊杰 2018-12-18 20:00
ALTER TABLE `capital_logs` CHANGE `currency` `currency` TINYINT(3) NULL DEFAULT '1' COMMENT '币种 1人民币 2美元 3其它';
ALTER TABLE `recharge_logs` ADD `currency` TINYINT(3) UNSIGNED NULL DEFAULT '1' COMMENT '币种 1人民币 2美元 3其它' AFTER `recharge_time`;
ALTER TABLE `recharge_logs` CHANGE `recharge_amount` `recharge_amount` DECIMAL(10,2) NOT NULL DEFAULT '0' COMMENT '充值金额';
ALTER TABLE `capital_logs` CHANGE `capital_type` `capital_type` SMALLINT(1) NULL DEFAULT '0' COMMENT '资金类型 1:自由资金,2:信用额度 4结汇';
ALTER TABLE `capital_logs` ADD `exchange_settlement_rmb` DECIMAL(10,2) UNSIGNED NULL COMMENT '结汇后人民币' AFTER `exchange_rate`;
ALTER TABLE `capital_logs` ADD `re_id` INT(11) UNSIGNED NULL COMMENT 'recharge_logsID' AFTER `user_id`;
ALTER TABLE `recharge_logs` ADD `exchange_settlement_rmb` DECIMAL(10,2) UNSIGNED NULL COMMENT '结汇后人民币' AFTER `currency`;
ALTER TABLE `recharge_logs` ADD `exchange_rate` DECIMAL(10,4) UNSIGNED NULL COMMENT '汇率' AFTER `currency`;
ALTER TABLE `recharge_logs` ADD `order_id` INT(11) UNSIGNED NULL COMMENT '订单ID' AFTER `exchange_settlement_rmb`;

-- 张俊杰 2018-12-21 12:00
ALTER TABLE `orders` CHANGE `service_type` `service_type` TINYINT(1) UNSIGNED NULL DEFAULT '0' COMMENT '服务类型 0未选 1退税 2代采购 3退税+代采购';
ALTER TABLE `orders` ADD `customs_port_type` TINYINT(1) UNSIGNED NULL DEFAULT '1' COMMENT '报关方式 1客户自行报关 2易贸通报关' AFTER `customs_port`;
ALTER TABLE `orders` ADD `customs_contact` VARCHAR(255) NULL COMMENT '报关联系人' AFTER `service_type`;
ALTER TABLE `orders` ADD `customs_contact_tel` VARCHAR(255) NULL COMMENT '报关联系方式' AFTER `customs_contact`;
ALTER TABLE `orders` ADD `customs_currency` TINYINT(1) UNSIGNED NULL COMMENT '报关币种 1人民币 2美元 3其它' AFTER `customs_contact_tel`;
ALTER TABLE `orders` ADD `cost_type` TINYINT(1) UNSIGNED NULL COMMENT '成交方式 1FOB 2CIF 3C&F' AFTER `customs_currency`;
ALTER TABLE `orders` ADD `input_price_type` TINYINT(1) UNSIGNED NULL COMMENT '录入价格方式 1指定货物报关发票金额 2定货物报关美金金额' AFTER `cost_type`;
ALTER TABLE `orders` ADD `packing_way` TINYINT(1) UNSIGNED NULL COMMENT '包装方式 1整装（同一包装中只含一种商品） 2混装（任一包装中含两种或以上产品）' AFTER `input_price_type`;
ALTER TABLE `orders` ADD `destination_country_or_area` VARCHAR(255) NULL COMMENT '运抵国（地区）' AFTER `packing_way`;
ALTER TABLE `orders` ADD `risk_container_type` TINYINT(1) UNSIGNED NULL COMMENT '装柜方式 1整柜出口 2拼柜出口 3不使用集装箱出口' AFTER `destination_country_or_area`;
ALTER TABLE `orders` ADD `transport_package_count` VARCHAR(255) NULL COMMENT '整体包装件数' AFTER `risk_container_type`;
ALTER TABLE `orders` ADD `pack_type_list` VARCHAR(255) NULL COMMENT '包装种类' AFTER `transport_package_count`;
ALTER TABLE `order_goods` ADD `box_unit` VARCHAR(20) NULL COMMENT '单位' AFTER `box_number`;
ALTER TABLE `order_goods` ADD `standard_count` INT(10) UNSIGNED NULL COMMENT '法定数量和单位' AFTER `goods_num`;
ALTER TABLE `order_goods` ADD `standardCount2` INT(10) UNSIGNED NULL COMMENT '法定数量和单位2' AFTER `standard_count`;
ALTER TABLE `order_goods` CHANGE `standardCount2` `standard_count2` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '法定数量和单位2';
ALTER TABLE `order_goods` ADD `subtotal` VARCHAR(20) NULL COMMENT '货值' AFTER `standard_count2`;
ALTER TABLE `order_goods` ADD `supplier_id` INT(11) UNSIGNED NULL COMMENT '开票人ID' AFTER `subtotal`;
ALTER TABLE `order_goods` ADD `estimate` INT(11) UNSIGNED NULL COMMENT '估算汇率' AFTER `supplier_id`;
ALTER TABLE `orders` ADD `buyers_name` VARCHAR(255) NULL COMMENT '境外收货人' AFTER `pack_type_list`;
ALTER TABLE `orders` ADD `trading_country` VARCHAR(255) NULL COMMENT '贸易国（地区）' AFTER `buyers_name`;
ALTER TABLE `orders` ADD `is_special_relation` TINYINT(1) UNSIGNED NULL COMMENT '特殊关系确认 1是 2否' AFTER `trading_country`;
ALTER TABLE `orders` ADD `goods_supply_id` TINYINT(1) UNSIGNED NULL COMMENT '境内货源地' AFTER `is_special_relation`;
ALTER TABLE `orders` ADD `goods_save_adr` TINYINT(1) UNSIGNED NULL COMMENT '货物存放地址' AFTER `goods_supply_id`;
ALTER TABLE `orders` ADD `contract_type` VARCHAR(255) NULL COMMENT '合同编号' AFTER `goods_save_adr`;
ALTER TABLE `orders` ADD `other_file` VARCHAR(255) NULL COMMENT '其他文件' AFTER `contract_type`;
ALTER TABLE `orders` ADD `purchasing_order` VARCHAR(255) NULL COMMENT '采购订单' AFTER `contract_type`;
ALTER TABLE `orders` CHANGE `user_company` `user_company` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '用户公司名称', CHANGE `user_principal` `user_principal` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '用户方负责人', CHANGE `user_tel` `user_tel` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '用户方联系方式', CHANGE `user_email` `user_email` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '用户方联系邮箱', CHANGE `supplier_id` `supplier_id` INT(11) NULL DEFAULT '0' COMMENT '供应商编号', CHANGE `supplier_name` `supplier_name` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '供应商名字', CHANGE `supplier_principal` `supplier_principal` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '供应商负责人', CHANGE `supplier_tel` `supplier_tel` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '供应商联系电话', CHANGE `supplier_email` `supplier_email` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '供应商联系邮箱', CHANGE `customs_port` `customs_port` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '报关口岸';
ALTER TABLE `orders` CHANGE `original_place` `original_place` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '境内货源地';
ALTER TABLE `order_goods` CHANGE `goods_image` `goods_image` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '商品图片';
ALTER TABLE `order_goods` CHANGE `hs_code` `hs_code` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';
ALTER TABLE `order_goods` CHANGE `goods_taxrate` `goods_taxrate` FLOAT(5,3) NULL;

