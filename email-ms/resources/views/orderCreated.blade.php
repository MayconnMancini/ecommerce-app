<p> O pedido #{{ $order['id'] }} foi criado com sucesso.</p> 


  ID: {{ $order['id'] }} <br>
  Total: R$ {{ $order['total'] }}<br>
  Data: {{ $order['date'] }} <br>
  Status: {{ $order['orderStatus'] }}<br>

  <br>
  Itens
  <br>

<?php
    foreach ($order['order_items']  as $item) {   
?>
    Id: <?php echo $item['product_id'] ?>  <br>
    Nome: <?php echo $item['product_name'] ?> <br>
    Preço: <?php echo $item['price'] ?> <br>
    Quantidade: <?php echo $item['quantity'] ?> <br>
    Subtotal: <?php echo $item['subtotal'] ?> <br>
    ---------------------
    <br>-----
<?php
    }
?>
