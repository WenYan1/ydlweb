<?php

/**
 * Created by ZJJ TEAM.
 * User: junjie Zhang
 * E-Mail: zhangjunjie@cucas.cn
 * Date: 2018/12/22
 * Time: 10:55 AM
 */
class ZJJConfig
{

	/**
	 * 获取服务类型数组
	 * @return array
	 */
	public static function get_config_service_type()
	{
		return array(
			1 => '退税',
			2 => '代采购',
			3 => '退税+代采购'
		);
	}

	/**
	 * 按照key 获取服务类型名称
	 *
	 * @param $key
	 *
	 * @return mixed|string
	 */
	public static function get_service_type($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_service_type();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 获取结算方式数组
	 * @return array
	 */
	public static function get_config_settlement_type()
	{
		return array(
			1 => '先定金再交货时付尾款',
			2 => '交货时付全款',
			3 => '交货后付款'
		);
	}

	public static function get_settlement_type($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_settlement_type();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 获取报关方式数组
	 * @return array
	 */
	public static function get_config_customs_port_type()
	{
		return array(
			1 => '客户自行报关',
			2 => '贸易通报关(提供报关资料)'
		);
	}

	public static function get_customs_port_type($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_customs_port_type();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 获取报关币种
	 * @return array
	 */
	public static function get_config_customs_currency()
	{
		return array(
			1 => '人民币(RMB)',
			2 => '美金(USD)'
		);
	}

	public static function get_customs_currency($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_customs_currency();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 成交方式
	 * @return array
	 */
	public static function get_config_cost_type()
	{
		return array(
			1 => 'FOB',
			2 => 'CIF',
			3 => 'C&F'
		);
	}

	public static function get_cost_type($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_cost_type();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 录入价格方式
	 * @return array
	 */
	public static function get_config_input_price_type()
	{
		return array(
			1 => '指定货物报关发票金额',
			2 => '指定获取报关美金金额'
		);
	}

	public static function get_input_price_type($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_input_price_type();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 包装方式
	 * @return array
	 */
	public static function get_config_packing_way()
	{
		return array(
			1 => '整装（同一包装中只含一种商品）',
			2 => '混装（任一包装中含两种或以上产品）'
		);
	}

	public static function get_packing_way($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_packing_way();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 包装方式
	 * @return array
	 */
	public static function get_config_risk_container_type()
	{
		return array(
			1 => '整柜出口',
			2 => '拼柜出口',
			3 => '不使用集装箱出口'
		);
	}

	public static function get_risk_container_type($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_risk_container_type();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	/**
	 * 获取是否数组
	 * @return array
	 */
	public static function get_config_is()
	{
		return array(
			1 => '是',
			2 => '否'
		);
	}

	public static function get_is($key)
	{
		if (!empty($key)) {
			$arr = ZJJConfig::get_config_is();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}
}