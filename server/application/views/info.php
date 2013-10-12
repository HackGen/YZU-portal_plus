<?php include('_header.php'); ?>

<div class="row">
	<div class="col-md-10">

		<div class="container">
			<?php if (isset($item)) { ?>
			<div id="product_items" class="container product_info">
				<div class="col-md-5 info_image">
					<a href="<?php echo base_url() . 'index.php/market/info/' . $item->product_id ?>">
						<img src="<?php echo $url; ?>">
					</a>
				</div>
				<div class="col-md-7 info_right">
					<div class="content_info">
						<h3 class="text-success"> <?php echo $item->product_title ?></h3>
						<span class="label label-success">拍賣中</span>
					</div>
					<div class="content_info">
						<label> 商品分類：<?php echo $item->product_type ; if ($item->product_type == '二手書籍') echo ' (' . $item->product_course . ')'?> </label> <br />
						<label> 賣家學號：<?php echo $item->product_owner ?> </label> <br />
						<hr>
						<label> 商品價格：<h3 class="hightlight_price"> <?php echo $item->product_price ?> </h3> </label> <br />
						<button class="btn btn-success btn-long">詢問</button>
					</div>
				</div>
			</div>

			<div class="container product_info">
				<span> <?php echo $item->product_description ?> </span>
			</div>

			<div class="container product_info">
				<?php foreach ($urls as $each_url) { ?>
					<span class="info_thumb">
						<a class="fancybox-effects-a" rel="gallery" href="<?php echo str_replace('_maker', '', $each_url); ?>" title="<?php echo $item->product_description ?>">
							<img src="<?php echo str_replace('_maker' , '_thumb' , $each_url); ?>" alt="">
						</a> 
					</span>
				<?php } ?>
			</div>
			<?php } else { ?>
				此商品已被賣家刪除。<br />
				This product had been removed.
			<?php } ?>
		</div>

	</div>

	<div class="col-md-2 sub_nav">
		<input type="text" class="form-control pos search_product_by_name" placeholder="搜尋商品...">
		<ul class="nav nav-pills nav-stacked well">
			<li><a href="<?php echo base_url().'index.php/market/product/all'; ?>">商品總覽</a></li>
			<li><a href="<?php echo base_url().'index.php/market/product/books'; ?>">二手書籍</a></li>
			<li><a href="<?php echo base_url().'index.php/market/product/cloths'; ?>">二手服飾</a></li>
			<li><a href="<?php echo base_url().'index.php/market/product/others'; ?>">其他商品</a></li>
		</ul>
	</div>
</div>


<?php include('_footer.php'); ?>