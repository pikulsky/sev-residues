<?php
/* @var $this SearchController */

	$this->pageTitle = Yii::t('main', Yii::app()->name);
?>

<div class="span10">
	<div class="row-fluid">
			
		<div class="controls controls-row">
			<div class="input-append">
				<input class="span10" id="appendedInputButton" type="text">
				
<!--				<span class="add-on"><i class="icon-search"></i></span>-->
				<button class="btn" type="button"><i class="icon-search"></i> Go!</button>
			</div>
		</div>			

		
		<!-- MAIN CONTENT AND INJECTED VIEWS -->
		<div id="main">
			{{ message }}

			<div ng-view></div>
			<!-- angular templating -->
			<!-- this is where content will be injected -->
			
		</div>


	</div><!--/row-->	
</div>
