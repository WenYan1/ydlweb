<?php

accout(个人中心相关)/
accout/personal_account(个人中心)

capital（我的资金相关）/
capital/capital_balance(资金流水) -------(没有主要数据的接口 军超负责对接，尚未完成)--------
capital/capital_manager(资金管理)
capital/capital_recharge(资金充值) -------(没有接口 军超负责对接，尚未完成)--------

company(公司认证相关)/    
company/not_certify(未认证页面)     
company/certify_submit(认证资料填写页面) 
company/certify_tip(认证提示页面)  
company/certify_complete(认证完成后，公司信息页面) 

console/暂时没用到，但是先不要删

financial(金融服务相关)/	
financial/financial_service(金融服务) -------(没有接口)--------

goods(产品相关)/
goods/add_product(添加产品) () -------(接口数据不完整 缺一些字段 辉哥负责对接，尚未完成)--------
goods/product_manager(产品管理) -------(接口数据不完整 缺一些字段 辉哥负责对接，尚未完成)--------

home(首页相关)/
home/overview(总览)

layouts/
layouts/main(带有左侧菜单的页面通过这个布局渲染)
layouts/zety(首页，登录，注册等不需要左侧菜单的页面都通过这个布局渲染)

order(订单相关)/
order/add_order_1(添加订单第一步) 
order/add_order_2(添加订单第二步) 
order/order_manage(订单管理)
order/order_detail(订单详情，无付款记录) -------(接口数据不完整  缺历史支付记录  俊峰负责对接,尚未完成)--------
order/order_detail_include_fp(订单详情，含首付款信息记录)
order/order_detail_include_fp(订单详情，有付款信息记录，但不含首付款信息记录)

order-pay(支付相关)/
order-pay/pay 
order-pay/pay_fp 
order-pay/pay_se 

site(Yii框架自带的)/

supplier(供应商相关)/
supplier/add_privider(添加供应商)
supplier/privider_detail(供应商详情)
supplier/privider_manage(供应商管理)

login(登录注册，找回密码相关)/
login/forget_password(找回密码第一步渣，发送验证邮件) -------(没有接口,放在最后，未分配)--------
login/forget_password2(找回密码第二步，填写新密码) -------(没有接口,放在最后，未分配)--------
login/login(登录)
login/register(注册)

user-verify(邮箱验证相关)/
user-verify/email_verification(邮箱验证) -------(没有接口,放在最后，未分配)--------




?>



