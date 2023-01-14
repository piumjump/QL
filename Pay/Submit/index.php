<?php
/*
 * 后台Ajax入口文件
 * Author：许愿
 * QQ群：740331903
 * Date:2019/10/13
 */

include '../../Core/Common.php';

$trade_no = $_GET['trade_no'] ?? alert('订单号不可为空！', '/');
$order = Db('select * from yyhy_order where trade_no="' . $trade_no . '"');
if (!$order) alert('订单不存在！', '/');
$order = $order[0];
$pay = new Pay(config('pid'), config('key'));
$url = $pay->submit($order['type'], $order['trade_no'], 'http://' . $_SERVER['HTTP_HOST'] . '/Pay/Notify', 'http://' . $_SERVER['HTTP_HOST'] . '/Pay/Return', config('sitename') . ' - 支付订单', $order['money'], config('sitename'));
header("Location: {$url}");