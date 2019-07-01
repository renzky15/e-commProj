<?php 
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $connection->query($sql);
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<a id="brand-title" href="index.php" class="navbar-brand"><span id="red">Red</span> Stone Shop</a>
		<ul class="nav navbar-nav">
			<?php while($parent = mysqli_fetch_assoc($pquery)): ?>
				<?php 
				$parent_id = $parent['id'];
				$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id' ";
				$cquery = $connection->query($sql2);
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><?php echo $parent['category']; ?><span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php while($child = mysqli_fetch_assoc($cquery)): ?>					
							<li>
								<a href="#"><?php echo $child['category'] ?></a>
							</li>
						<?php endwhile; ?>
					</ul>
				</li>
			<?php endwhile; ?>
			<li>
				<a href="myCart.php" id="btnCart"><span class="glyphicon glyphicon-shopping-cart"> Cart</span></a>
			</li>
		</ul>

	</div>
	
</nav>
