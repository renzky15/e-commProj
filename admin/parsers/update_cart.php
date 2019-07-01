<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/e-comm/core/init.php';
  $mode = sanitize($_POST['mode']);
  $edit_size = sanitize($_POST['edit_size']);
  $edit_id = sanitize($_POST['edit_id']);
  $cartQ = $connection->query("SELECT * FROM cart WHERE id = '{$cartID}'");
  $result = mysqli_fetch_assoc($cartQ);
  $items = json_decode($result['items'],true);var_dump($result);
  $updated_items = array();
  $domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

  if($mode == 'removeone'){
    foreach($items as $item){
      if($item['id'] == $edit_id && $item['size'] == $edit_size){
        $item['quantity'] = $item['quantity'] - 1;
      }
      if($item['quantity'] > 0){
        $updated_items[] = $item;
      }
    }
  }

  if($mode == 'addone'){
    foreach($items as $item){
      if($item['id'] == $edit_id && $item['size'] == $edit_size){
        $item['quantity'] = $item['quantity'] + 1;
      }
      $updated_items[] = $item;
    }
  }

  if(!empty($updated_items)){
    $json_updated = json_encode($updated_items);
    $connection->query("UPDATE cart SET items = '{$json_updated}' WHERE id = '{$cartID}'");
    $_SESSION['success_flash'] = 'Your shopping cart has been updated!';
  }

  if(empty($updated_items)){
    $connection->query("DELETE FROM cart WHERE id = '{$cartID}'");
    setcookie(CART_COOKIE,'',1,"/",$domain,false);
  }
 ?>
