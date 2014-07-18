<?php
/* @var $this SearchController */

	$this->pageTitle = Yii::t('main', Yii::app()->name);
?>

<div ng-controller="searchController">
<div class="span10">
	<div class="row-fluid">
			
		<div class="controls controls-row">
			<div class="input-append">
				<input class="span10" id="appendedInputButton" type="text" ng-model="query" ng-change="searchProducts()">
				
<!--				<span class="add-on"><i class="icon-search"></i></span>-->
				<button class="btn" type="button"><i class="icon-search"></i> Go!</button>
			</div>
			
			<div class="">
			Sort by:
			<select ng-model="productsOrder">
				<option value="price">Price</option>
				<option value="dateCreated">Newest</option>
			</select>
			</div>

		</div>			

		<div id="products">
			<div class="product well" ng-repeat="product in products | orderBy:productsOrder">
				{{product.name}}
				<p>{{product.description}}</p>
				<p>{{product.price}}</p>
				<p>{{product.dateCreated}}</p>
			</div>
		</div>

		<header>
			<nav class="navbar navbar-default">
			<div class="container">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div>
			</nav>
		</header>
		
		<!-- MAIN CONTENT AND INJECTED VIEWS -->
		<div id="main">
			{{ message }}

			<div ng-view></div>
			<!-- angular templating -->
			<!-- this is where content will be injected -->
			
		</div>


	</div><!--/row-->
</div>
</div><!-- /searchController -->
