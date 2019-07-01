<?php
require_once 'core/init.php';  
$sql = "SELECT * FROM products WHERE featured = 1";
$featured = $connection->query($sql);
?>
<?php include 'partials/head.php'?>
<?php include 'partials/nav.php' ?>
<?php include 'partials/headerFull.php' ?>
<div class="container">
	<div class="col-md-2"></div>

	<div class="col-md-8">
		<div class="row">
			<h2 style="margin-bottom: 50px; margin-left: 40%;">Featured Products</h2>
			<?php while($product = mysqli_fetch_assoc($featured)): ?>
				<div class="col-md-3">
					<h4><?= $product['title'];?></h4>
					<img src="<?= $product['image'];?>" alt="<?= $product['title'];?>" id="images">
					<p class="list-price text-danger">List Price: <s>$<?= $product['list_price'];?></s></p>
					<p class="price">Price: $<?= $product['price'];?></p>
					<button type="button" class="btn btn-success" onclick="detailsModal(<?= $product['id']; ?>)">Details</button>
					<!-- <?php echo var_dump($product['id']); ?> -->
				</div>
			<?php  endwhile;?>

		</div>
	</div>
</div>


<?php include 'partials/footer.php' ?>