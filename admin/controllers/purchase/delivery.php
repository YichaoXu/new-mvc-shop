<?php

require_once('admin/models/purchase.php');

global $userNav;

if (!empty($userNav)) {
    $options = [
        'where' => 'status = 2 and user_id =' . $userNav,
        'order_by' => 'createtime DESC',
    ];
    $deliveryOrders = getAll('orders', $options);
    $title = 'Orders In Delivery';
    $yourPurchaseNav = 'class="active open"';
    $status = [
        0 => 'Order Confirmed',
        2 => 'Đang giao hàng',
        1 => 'Đã giao hàng',
    ];
}

require('admin/views/purchase/delivery.php');
