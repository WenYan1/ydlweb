<style>

	div {
		display: block;
		font-size: 14px;
	}

	table{
		width:100%;
		border:1px solid #000000; 
		border-collapse: collapse;
	}

	th,td{
		padding: 8px 0;
		text-align: center;
		border:1px solid #000000;
	}
	.number{
		width:10%;
		border-right:0px;
	}

	.type{
		width:90%;
	}
	
	.content {
		width: 100%;
		padding-left: 80px;
		padding-right: 80px;
		padding-bottom: 120px;
	}

	.bottom-line {
		padding:0 10px;
		width:auto;
		border-bottom:1px solid #000000;
		text-align: center;
		display: block;
		font-size: 14px;
	}
	.explain{
		font-size:12px;
		font-weight:bold;
		text-align:left;
	}
</style>
<
<div class="content">
			<h3 style="text-align: center">出口服务委托函</h3>
			<br>
			<div style="margin-left:480px;">No.<span class="bottom-line">11111111</span>
			</div>
			<br>
			<div style="font-weight:bold;">
				<span>致<span class="bottom-line"><?php echo '  公司名称  '; ?></span>有限公司:</span>
			</div>
			<br>
			<div>
				&nbsp;&nbsp;&nbsp;&nbsp;我方了解并同意：本《出口服务委托函》(简称"委托函")，为我方与贵公司签署的编号为<span class="bottom-line">0</span>《外贸出口服务协议书》(简称"服务协议")的补充内容，委托函的内容与服务协议中约定不一致的，以委托函中内容为准；其它未尽事宜，以服务协议中内容为准。
			</div>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;我方了解并同意：本委托函出具后，需待贵司确认接受委托后双方的委托代理关系方成立。</p>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;我方现就出口产品委托贵司办理的事项及货物相关信息确认如下：</p>
			<p>一、委托事项</p>
			<table>
					<tr>
						<th class="number">序号</th>
						<th class="type">委托办理项目</th>
					</tr>
					<tr>
						<td class="number" style="border-bottom:0px">1</td>
						<td class="type" style="border-bottom:0px">外汇</td>
					</tr>
					<tr>
						<td class="number">2</td>
						<td class="type">通关</td>
					</tr>
					<tr>
						<td class="number" style="border-bottom:0px">3</td>
						<td class="type" style="border-bottom:0px">退税</td>
					</tr>
					<tr>
						<td class="number">4</td>
						<td class="type">外汇</td>
					</tr>
			</table>
			<p class="explain">上述出口服务委托项目有变化的，我方承诺将另行书面通知贵司，经贵司同意后更新服务委托项目。</p>
			<p>二、货物与出口信息</p>
			<table style="border-bottom:0px;">
				<tr>
					<th style="border-bottom:0px">出口报关</th>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<th style="width:18%;border-bottom:0px;border-right:0px;">经营单位</th>
					<td style="width:32%;border-bottom:0px;border-right:0px;"><p>xxxxxxxxXXXXXX公司</p></td>
					<th style="width:18%;border-bottom:0px;border-right:0px;">发货单位</th>
					<td style="width:32%;border-bottom:0px;"><p><?php echo $order['supplier_name'] ?></p></td>
				</tr>	
				<tr>
					<td style="width:18%;border-bottom:0px;border-right:0px;">境内通关口岸</td>
					<td style="width:32%;border-bottom:0px;border-right:0px;"><?php echo $order['customs_port']?></td>
					<td style="width:18%;border-bottom:0px;border-right:0px;">出口目的国</td>
					<td style="width:32%;border-bottom:0px;"><?php echo $order['arrive_port']?></td>
				</tr>	
				<tr>
					<td style="width:18%;border-bottom:0px;border-right:0px;">货物报关总价</td>
					<td style="width:32%;border-bottom:0px;border-right:0px;"><?php echo $order['customs_money'].'RMB'?></td>
					<td style="width:18%;border-bottom:0px;border-right:0px;">境内货源地</td>
					<td style="width:32%;border-bottom:0px;"><?php echo $order['original_place']?></td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:12%;border-bottom:0px;border-right:0px;">总毛重</td>
					<td style="width:21%;border-bottom:0px;border-right:0px;"><?php echo $order['gross_weoght'].'千克'?></td>
					<td style="width:12%;border-bottom:0px;border-right:0px;">总净重</td>
					<td style="width:21%;border-bottom:0px;border-right:0px;"><?php echo $order['net_weight'].'千克'?></td>
					<td style="width:12%;border-bottom:0px;border-right:0px;">包装种类</td>
					<td style="width:22%;border-bottom:0px;">纸箱</td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:12%;border-bottom:0px;border-right:0px;">总包件数</td>
					<td style="width:21%;border-bottom:0px;border-right:0px;"><?php echo $order['total_quantity']?></td>
					<td style="width:12%;border-bottom:0px;border-right:0px;">包装说明</td>
					<td style="width:55%;border-bottom:0px;"></td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:25%;border-bottom:0px;border-right:0px;">HS编码</td>
					<td style="width:25%;border-bottom:0px;border-right:0px;">出口货物商品名</td>
					<td style="width:20%;border-bottom:0px;border-right:0px;">退税率</td>
					<td style="width:30%;border-bottom:0px;">监管条件</td>
				</tr>
				<?php $i=0; foreach ($orderGoods as $good) { ?>
				<tr>
					<td style="width:25%;border-bottom:0px;border-right:0px;"><?php echo $good['hs_code']?></td>
					<td style="width:25%;border-bottom:0px;border-right:0px;"><?php echo $good['goods_name']?></td>
					<td style="width:20%;border-bottom:0px;border-right:0px;"><?php echo $good['goods_taxrate'].'12%'?></td>
					<td style="width:30%;border-bottom:0px;"></td>
				</tr>
				<?php $i++; } ?>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<th style="border-bottom:0px"><p>我方了解并同意，贵司可依据我方提供的产品信息对货物进行归类判定；上述货物的HS编码、进出口关税率、出口退税率、监管条件等以海关的最终决定为准。</p></th>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:25%;border-bottom:0px;border-right:0px;">报关方式</td>
					<td style="width:75%;border-bottom:0px;">客户自行报关</td>
				</tr>
				<tr>
					<td style="width:25%;border-bottom:0px;border-right:0px;">报关材料递交地址</td>
					<td style="width:75%;border-bottom:0px;"></td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:20%;border-right:0px;">联系人</td>
					<td style="width:30%;border-right:0px;"></td>
					<td style="width:20%;border-right:0px;">联系地址</td>
					<td style="width:30%;"></td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<th style="border-bottom:0px">外汇收结</th>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:20%;border-bottom:0px;border-right:0px;">付款义务人</td>
					<td style="width:40%;border-bottom:0px;border-right:0px;"></td>
					<td style="width:20%;border-bottom:0px;border-right:0px;">付款方式</td>
					<td style="width:20%;border-bottom:0px;">汇款（如T/T）</td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:20%;border-bottom:0px;border-right:0px;"><p>付款金额（币种）</p></td>
					<td style="width:20%;border-bottom:0px;border-right:0px;">9095.32 USD</td>
					<td style="width:20%;border-bottom:0px;border-right:0px;">预计付款时间</td>
					<td style="width:40%;border-bottom:0px;"><p>货物报关90日之内</p></td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<th style="border-bottom:0px">出口退税</th>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:20%;border-bottom:0px;border-right:0px;"><p>开票人全称</p></td>
					<td style="width:80%;border-bottom:0px;"><p>潮安市潮安区古巷镇粤泰建筑陶瓷厂</p></td>
				</tr>
				<tr>
					<td style="width:20%;border-bottom:0px;border-right:0px;"><p>开票时间</p></td>
					<td style="width:80%;border-bottom:0px;"><p>货物报关放行之日起90日内</p></td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<th style="border-bottom:0px">垫付退税</th>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="width:20%;border-bottom:0px;border-right:0px;">垫付退税金额</td>
					<td style="width:40%;border-bottom:0px;border-right:0px;">4819.24</td>
					<td style="width:20%;border-bottom:0px;border-right:0px;">币种</td>
					<td style="width:20%;border-bottom:0px;">人民币</td>
				</tr>
			</table>
			<table style="border-bottom:0px;">
				<tr>
					<td style="font-align:left;">垫付退税的款项由贵司以支付货款形式付至我方账户或我方供应商账户。</td>
				</tr>
			</table>
			<p class="explain">我方承诺对上述出口货物及信息的真实性、准确性、合法性及有效性负责，
				如因上述信息错误导致的一切费用、损失及责任均由我方承担，包括但不限于海关查验、无法向税务局申请出口退税等。</p>
			<p class="explain">我方承诺上述货物己与海外买家签订相关的贸易合同并与海外买家约定由贵司代为出口及代收外汇。我方同意，贵司有权将上述服务项目的一部分或者全部交由贵司之关联公司操作，我方承诺配合贵司或贵司之关联公司的操作并接受其服务。</p>
			<p class="explain">我方了解并同意，有关服务及财务事项（特别是收付汇账号及发票信息），应以法律认可的书面方式与贵司沟通及确认，否则由此导致的损失由我方自行承担。</p>
			
			<p>三、预计费用清单</p>
			<table style="border-bottom:0px;">
				<tr>
					<th style="width:10%;border-bottom:0px;border-right:0px;">序号</th>
					<th style="width:20%;border-bottom:0px;border-right:0px;">费用项目</th>
					<th style="width:40%;border-bottom:0px;border-right:0px;">收费标准</th>
					<th style="width:30%;border-bottom:0px;">预计金额（人民币）</th>
				</tr>
				<tr>
					<td style="width:10%;border-bottom:0px;border-right:0px;">1</td>
					<td style="width:20%;border-bottom:0px;border-right:0px;">退税容服务费</td>
					<td style="width:40%;border-bottom:0px;border-right:0px;">退税代采购服务费：退税款*垫资率</td>
					<td style="width:30%;border-bottom:0px;">192.77</td>
				</tr>
			</table>
			<table>
				<tr>
					<th style="width:70%;border-bottom:0px;border-right:0px;">预计费用合计</th>
					<td style="width:30%;border-bottom:0px;">192.77</td>
				</tr>
				<tr>
					<th style="width:70%;border-right:0px;">出口补贴金额</th>
					<td style="width:30%;">272.86 CNY</td>
				</tr>
			</table>
			<p></p>
			<p class="explain" >我方了解上述费用清单为预估费用、且收费标准可能发生变动，并同意此出口服务委托单之费用结算以实际发生的为准。</p>
			<p class="explain">我方知悉并同意，在推荐码栏填写推荐码代表我方同意放弃外贸服务补贴款。如未填写则按原规则计算补贴。</p>
		</div>
