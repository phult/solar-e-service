<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Setting - Solar-e</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" type="image/png" href="/images/logo.png"/>
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/font-awesome.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
        <!-- jQuery 2.2.3 -->
        <script src="/js/jquery-2.2.3.min.js"></script>
        <script src="/js/angular.js"></script>
        <script src="/js/angular-sanitize.js"></script>
        <script src="/js/solare-app.js"></script>
        <script src="/js/ng-base-controller.js"></script>
        <script src="/js/ng-setting-controller.js"></script>
        <style>
            .js-command {
                cursor: pointer;
            }
        </style>
        <script>
            var setting = <?=$setting;?>;
            var deviceId = "<?=$deviceId;?>";
            var user = <?=$user;?>;
        </script>
    </head>
    <body class="hold-transition skin-blue" ng-app="solareApp">
        <div class="wrapper" style="background-color: white" ng-controller="SettingController">
            <div class="" style="text-align: center">
                <section class="content-header">
                    <h1 style="text-align: left">
                        Setting: {{user.full_name}} - {{deviceId}}
                    </h1>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-success">
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tbody ng-repeat="(key, value) in setting">
                                            <tr>
                                                <th colspan="3">
                                                    {{value.name}} - {{key}}
                                                </th>
                                            </tr>
                                            <tr ng-repeat="item in value.on">
                                                <td>
                                                </td>
                                                <td style="width:50px">
                                                    <i class="fa fa-toggle-on" style="color: orange; font-size:25px"></i>
                                                </td>
                                                <td>
                                                    <input style="width:40%" type="text" placeholder="HH:mm:ss" ng-model="item.time_from"/>
                                                    <b>&nbsp-&nbsp</b>
                                                    <input style="width:40%" type="text" placeholder="HH:mm:ss" ng-model="item.time_to"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <a style="float: left;color: red;font-weight: bold">{{message}}</a>
                                                    <button ng-click="save()" type="button" class="btn btn-sm btn-success" style="float:right;margin-left:15px;font-weight:bold;width:40%">Save</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- ./wrapper -->
        <!-- Bootstrap 3.3.6 -->
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/app.min.js"></script>
    </body>
</html>
