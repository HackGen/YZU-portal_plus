<?php include('_header.php'); ?>
<div class="row">
	<div class="col-md-10">

		<div class="container">
			<div id="product_items" class="js-masonry container" data-masonry-options='{ "columnWidth": 40, "itemSelector": ".product_item" }'>
				
				<?php foreach($product_info as $item) {
					$url = preg_split('/[;]/', $item->product_image);
					$status = $item->product_status;
					$statue = ($status == 1 ? '<span class="label label-primary">目前有貨</span>' : '<span class="label label-danger">已經售出</span>')
				?>

				<div class="product_item">
					<a href="<?php echo base_url() . 'index.php/market/info/' . $item->product_id ?>">
						<img class="img_size" src="<?php echo $url[0]; ?>">
					</a>
					<p>
						<ul class="product_info">
							<li> <a href="<?php echo base_url() . 'index.php/market/info/' . $item->product_id ?>"><?php echo $item->product_title; ?></a></li><br />
							<div class="btn-group">
								<button type="button" class="btn btn-primary">
									<?php echo $item->product_type; ?>
								</button>	
							    <button type="button" class="btn btn-default disabled">
									<?php echo $item->product_price; ?>
								</button>
							</div>
							<div class="product_status">
								<?php echo $statue ; ?>
							</div>
							
							<div class="btn-group btn-down">
								<?php if ($item->product_status != 0) { ?>
								<button type="button" class="btn btn-info sold_out" val="<?php echo $item->product_id ?>">
									售出
								</button>
								<?php } ?>
								<button type="button" class="btn btn-danger delete_item" val="<?php echo $item->product_id ?>">
									刪除
								</button>
							</div>
					</p>
				</div>
				<?php } ?>
			</div>
		</div>

	</div>

	<div class="col-md-2 sub_nav">
		<input type="text" class="form-control pos search_product_by_name" placeholder="搜尋商品...">
		<ul class="nav nav-pills nav-stacked well">
			<li><a href="<?php echo base_url().'index.php/market/mine/all'; ?>">商品總覽</a></li>
			<li><a href="<?php echo base_url().'index.php/market/mine/books'; ?>">二手書籍</a></li>
			<li><a href="<?php echo base_url().'index.php/market/mine/cloths'; ?>">二手服飾</a></li>
			<li><a href="<?php echo base_url().'index.php/market/mine/others'; ?>">其他商品</a></li>
		</ul>
	</div>
</div>

<?php include('_footer.php'); ?>