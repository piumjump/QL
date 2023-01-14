<?php
/*
 * 后台Ajax入口文件
 * Author：许愿
 * QQ群：740331903
 * Date:2019/10/13
 */

include '../../Core/Common.php';

$data = $_REQUEST;
$pay = new Pay(config('pid'), config('key'));
if ($pay->verify($data)) {
    $order = Db('select * from yyhy_order where trade_no="' . $data['out_trade_no'] . '"');
    if (!$order) exit('fail');
    $order = $order[0];
    if ($order['status'] != 1) {
        Db('update yyhy_order set `status`=1,`endtime`="' . date('Y-m-d H:i:s') . '" where trade_no="' . $data['out_trade_no'] . '"');
    }
    alert('施舍成功，好人有好报！', '/');
} else {
    alert('支付验证失败,施舍失败了，又吃不到饭饭了！', '/');
}