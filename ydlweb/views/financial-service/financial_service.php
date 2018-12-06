	<script>
        $(".finance").css("border-left","6px solid #783390");
        $(".finance").css("background","#222222");
    </script>
    <?php 
		if($this->context->_popSuccessMessage()) {
	?>
			<div class="hint-dialog_success" style="width:120px;">
				<p class="hint-info_success"><?php echo $this->context->_popSuccessMessage(); ?></p>
			</div>
	<?php
		} else {
			$msg = $this->context->_popErrorMessage();
			if($msg != null){
	?>
			<div class="hint-dialog_fail" style="width:120px;">
				<p class="hint-info_fail"><?php echo $this->context->_popErrorMessage(); ?></p>
			</div>
	<?php	
			}
		}
	?>
	<link rel="stylesheet" href="../css/financial/financial_service.css">
	<title>金融服务</title>
		<?php 
        	//var_dump($service); 
	        if($this->context->_popSuccessMessage()) {
				echo $this->context->_popSuccessMessage();
			} else {
				echo $this->context->_popErrorMessage();
			}
        ?>
		<div class="financial-title ">
    		<div class="font-title-size font-color-default spacing-left">金融服务</div>
   		</div>
   		<div class="content-width">
   			<div class="content-half">
   				<div class=" financial-left spacing-left">
		    		<p class="credit spacing-left">总信用额度：</p>
	    			<div class="credit-limit">
	    				<p class="font-color-default credit-big-font spacing-left"><?php echo $service['credi_limit'];?></p>
	    				<p class="font-grey font-color-default font-content-size">元</p>
	    			</div>
		   		</div>
   			</div>
   			<div class="content-half">
   				<div class=" financial-right ">
	    			<div class="spacing-left">
	    				<div class="spacing-left">
			    			<p class="credit">可用信用额度：</p>
			    			<div class="credit-limit">
			    				<p class="credit-blue credit-big-font"><?php echo $service['total_creditlimit'];?></p>
			    				<p class="font-content-size font-color-default">元</p>
			   				</div>		
			   			</div>
    				</div>
    			</div>
   			</div>
   		</div>