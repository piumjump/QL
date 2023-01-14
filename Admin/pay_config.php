<?php
/*
 * 后台Ajax入口文件
 * Author：许愿
 * QQ群：740331903
 * Date:2019/10/13
 */
$title = '支付配置';
include 'head.php';
?>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 center-block" style="float: none;">
        <div class="panel panel-info">
            <div class="panel-heading">支付配置</div>
            <div class="panel-body">
                <form>
                    <div class="alert alert-success">
                        烟雨云支付三网稳如狗，免费开户，<a href="http://pay.yyhy.me/" target="_blank">http://pay.yyhy.me/</a>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PID</label>
                        <input type="text" class="form-control" name="pid"
                               value="<?php echo config('pid'); ?>" placeholder="请输入PID">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Token</label>
                        <input type="text" class="form-control" name="key" value="<?php echo config('key'); ?>"
                               placeholder="请输入PID">
                    </div>
                    <button type="button" id="submit" class="btn btn-success">保存</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#submit').click(function () {
            layer.open({
                type: 2,
                content: '保存中...',
                time: false
            });
            var cont = $("input,textarea").serialize();
            $.ajax({
                type: "POST",
                url: "/Admin/ajax.php?act=config",
                data: cont,
                dataType: 'json',
                success: function (data) {
                    layer.closeAll();
                    if (data.code == 1) {
                        layer.open({
                            content: data.msg,
                            skin: 'msg',
                            time: 2
                        });
                    } else {
                        layer.open({
                            content: data.msg,
                            skin: 'msg',
                            time: 2
                        });
                    }
                },
                timeout: 10000,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.closeAll();
                    if (textStatus == "timeout") {
                        layer.open({
                            content: '请求超时！',
                            skin: 'msg',
                            time: 2
                        });
                    } else {
                        layer.open({
                            content: '服务器错误！',
                            skin: 'msg',
                            time: 2
                        });
                    }
                }
            });
        });
    </script>
<?php
include 'foot.php';
?>