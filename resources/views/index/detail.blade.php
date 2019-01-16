<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>医院-患者管理</title>
    <link rel="stylesheet" href="{{ asset('/css/common.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hospital.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/pagination.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/page.css') }}" />
    <style>
    /* 内容 */
    </style>
</head>

<body>
    <header class="header" />
        <div class="header-content">
            <img src="/imgs/home-logo.png" alt="logo">
            <div class="hospital-manage fr">
                <div class="hospital-name">{{$hospital_info['nickname']}}<span></span></div>
                <ul class="hospital-exit">
                    <li class="hospital-update-info">
                        修改信息
                    </li>
                    <li class="logout">
                        退出登录
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- 内容 -->
    <div class="container patient-manage">
        <div class="patient-manage-add">
            <a href="javascript:;" id="add_user">添加</a>
        </div>
        <div class="container-table">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>联系方式</th>
                        <th>账号</th>
                        <th>病历</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($data as $vo)
                    <tr>
                        <td>{{$vo['name']}}</td>
                        @if ($vo['sex'] == 1)
                        <td>男</td>
                        @else
                        <td>女</td>
                        @endif
                        <td>{{$vo['age']}}</td>
                        <td>
                            {{$vo['phone']}}
                        </td>
                        <td>
                            <a href="javascript:;" data="{{$vo['idcard']}}" class="td-btn check-code">查看账号</a>
                            <a href="javascript:;" data="{{$vo['id']}}" class="td-btn pwd-reset-btn">重置密码</a>
                        </td>
                        <td>
                            <a href="javascript:;" data="{{$vo['id']}}" class="td-btn medical-record-add">添加病历</a>
                            <a href="{{ url('User/viewHistory',array('id'=>$vo['id']))}}" target="_blank" class="td-btn">查看病历</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- 分页 -->
        <div id="pagination">{!! $data->links() !!}</div>
    </div>
    <footer class="footer-copy">
        <div class="footer-text">
            Copyright @ 医疗智慧云
            <br> 互联网医疗信息服务资格证书(鄂)-经营性-2018-0000 网站备案编号： 鄂ICP备18000000号
        </div>
    </footer>
    <!-- 登陆免责协议 -->
    <div class="hospotal-popup" style="display: none">
        <div class="hospotal-contect">
            <div class="base-info">
                <label for="">医院</label>
                <input type="text" name="nickname" value="{{$hospital_info['nickname']}}">
            </div>
            <div class="base-info">
                <label class="title" for="">简介</label>
                <textarea maxlength="200" name="descrip" id="descrip" onkeyup="javascript:setShowLength(this, 200, 'hospotal-sizes');">{{$hospital_info['descrip']}}</textarea>
                <span id="hospotal-size"><font id="hospotal-sizes">200</font>/200</span>
            </div>
        </div>
    </div>
    <!-- 填写患者资料弹窗 -->
    <div class="hospotal-info-popup" style="display: none">
        <div class="personal-user">
            <div class="base-info">
                <span for="">姓名</span>
                <input class="miss" name="name" type="text" placeholder="">
            </div>
            <div class="base-info sex">
                <span for="" class="fl">性别</span>
                <div class="male fl">
                    <input id="male" type="radio" name="sex" value="1" checked>
                    <label for="male"></label>
                    <span>男</span>
                </div>
                <div class="female fl">
                    <input id="female" type="radio" name="sex" value="2">
                    <label for="female"></label>
                    <span>女</span>
                </div>
            </div>
            <div class="base-info">
                <span for="">年龄</span>
                <input type="number" name="age" placeholder="">
            </div>
            <div class="base-info">
                <span for="">联系方式</span>
                <input type="text" name="phone" placeholder="" maxlength="11">
            </div>
            <div class="base-info">
                <span for="">身份证</span>
                <input type="type"  name="idcard" placeholder="" maxlength="18">
            </div>
            <div class="xieyi">
                <input id="xieyi" type="checkbox" name="item" value="1">
                <label for="xieyi"></label>
                已告知患者并患者知情协议
            </div>
        </div>
    </div>

    <!-- 重置密码 -->
    <div class="hospotal-pwd-reset" style="display: none">
        <p>确认重置密码？</p>
        <font>密码重置后为“123456”</font>
    </div>
     <!-- 添加病历 -->
    <div class="medical-record" style="display: none">
        <div class="base-info pic">
            <label for="">上传图片</label>
            <div class="layui-upload">
                
                <blockquote class="layui-elem-quote layui-quote-nm fl">
                    <div class="layui-upload-list" id="demo1">
                            
                    </div>
                </blockquote>
                <button type="button" class="layui-btn fl" id="test2">多图片上传</button> 
            </div>
        </div>
        <input type="hidden" name="img_banner" id="img_banner" value="">
        <div class="base-info description">
            <label for="">描述</label>
            <textarea name="content" id="content" cols="30" rows="10" placeholder=""></textarea>
        </div>
        <div class="base-info date">
            <label for="">就诊时间</label>
            <input type="text" name="vtime" class="layui-input" id="test14" placeholder="yyyy/MM/dd">
        </div>
        <div class="xieyi">
            <input id="xieyi" type="checkbox" name="item" value="1">
            <label for="xieyi"></label>
            已告知患者知情协议
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/plugins/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/layui/layui.all.js') }}"></script>
    <script>

    //限制字数
    function setShowLength(obj, maxlength, id) {
        var rem = maxlength - obj.value.length;
        var wid = id;
        if (rem < 0) {
            rem = 0;
        }
        document.getElementById(wid).innerHTML = "" + rem + "";
    }
    $(function() {


        //退出功能
        $(".hospital-name").bind('click', function() {
            $(".hospital-exit").toggle();
        })
        //医院信息弹窗
        $('.hospital-update-info').on('click', function() {
            $(".hospital-exit").toggle();
            var index = layer.open({
                type: 1,
                area: ['640px', '436px'],
                skin: 'layer-ext-moon',
                title: '医院信息',
                content: $('.hospotal-popup'),
                btn: ['取消', '确定'],
                end: function() {
                    $('.hospotal-popup').hide();
                },
                btn1: function() {
                    $('.hospotal-popup').hide();
                    layer.close(index)
                },
                btn2: function() {
                    var nickname = $(":input[name='nickname']").val();
                    var descrip = $("#descrip").val();
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{url('index/edit')}}",
                        data: { nickname: nickname, descrip: descrip,_token:'{{csrf_token()}}' },
                        success: function(json) {
                            $('.error-msg').find('i').text(json.info);
                            $('.error-msg').show()

                            //layer.open(json.msg, { icon: 1, time: 2000 });
                            if (json.status == 200) {
                                window.location.href = "{{url('index/detail')}}";
                            }
                        }
                    })
                    $('.hospotal-popup').hide();
                    layer.close(index)

                }
            });
        });
        $('.logout').on('click', function() {
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{url('index/logout')}}",
                data: {_token:'{{csrf_token()}}'},
                success: function(json) {
                    window.location.href = "/index/index";
                }
            })
        })
        //添加病历
        $('.medical-record-add').on('click', function(){
            var uid = $(this).attr('data');
            var index=layer.open({
                type: 1,
                area: ['640px', '470px'],
                skin: 'medical-record-layer',
                title: '添加病历',
                content: $('.medical-record'),
                btn: ['添加'],
                btn1: function(){ 
                    var item = $(":input[name='item']:checked").val();
                    if (item != 1) {
                        layer.msg('请告知患者知情协议', { time: 3000 });
                        return ;
                    }
                    var content = $('#content').val();
                    var vtime = $(":input[name='vtime']").val();
                    var img_banner = $(":input[name='img_banner']").val();
                    var data = {uid:uid,content:content,vtime:vtime,img_banner};
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{:url('user/addHistory')}",
                        data: data,
                        success: function(json) {
                            if (json.status == 0) {
                                $(":input[name='item']").attr("checked",'false')
                                $('#content').val('');
                                $(":input[name='vtime']").val('');
                                $(":input[name='img_banner']").val('');
                                $("#demo1").html('')
                                layer.close(index);
                                $('.medical-record').hide();
                            }
                            layer.msg(json.info, { time: 3000 });
                        }
                    })
                   
                },
                end: function(){
                    $('.medical-record').hide();
                }
            
            })

        })
        //查看账号
        $('.check-code').on('click', function(){
            var idcard = $(this).attr('data')
            var index=layer.open({
                type: 1,
                area: ['320px', '200px'],
                skin: 'layer-check-code',
                title: '查看账号',
                content:'<p>'+idcard+'</p>' ,
                btn: ['确定'],
                btn1: function(){ 
                    layer.close(index);
                },
               
            })
        });
        //添加患者信息
        $('#add_user').on('click', function() {
            layer.open({
                type: 1,
                area: ['640px', '470px'],
                skin: 'layer-ext-info',
                title: '填写患者资料',
                content: $('.hospotal-info-popup'),
                btn: ['添加'],
                end: function() {
                    $('.hospotal-info-popup').hide();
                },
                btn1: function() {
                    var name = $(":input[name='name']").val();
                    var phone = $(":input[name='phone']").val();
                    var sex = $(":input[name='sex']:checked").val();
                    var idcard = $(":input[name='idcard']").val();
                    var age = $(":input[name='age']").val();

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{url('user/add')}}",
                        data: { name: name,phone: phone,sex: sex,age: age,idcard:idcard},
                        success: function(json) {
                            if (json.status == 0) {
                                layer.msg(json.info, { time: 3000 });
                                $('.hospotal-info-popup').hide();
                                layer.close(index)
                            }else{
                                layer.msg(json.info, { time: 3000 });
                            }
                        }
                    })
                },
            });
        });
        //重置密码
        $('.pwd-reset-btn').on('click', function() {
            var id = $(this).attr('data');
            var index = layer.open({
                type: 1,
                area: ['640px', '242px'],
                skin: 'patient-pwd-reset',
                title: '重置密码',
                content: $('.hospotal-pwd-reset'),
                btn: ['取消', '确定'],
                end: function() {
                    $('.hospotal-pwd-reset').hide();
                }, 
                btn1: function() {
                    $('.hospotal-pwd-reset').hide();
                    layer.close(index)
                },
                btn2: function() {
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{:url('user/reset')}",
                        data: { id: id},
                        success: function(json) {
                            if (json.status == 0) {
                                layer.msg(json.info, { time: 3000 ,shade :0.3});
                            }else{
                                layer.msg(json.info, { time: 3000 });
                            }
                        }
                    })
                    $('.hospotal-pwd-reset').hide();
                    layer.close(index)

                }
            })

        })
    })
    layui.use('upload', function(){
        var $ = layui.jquery,upload = layui.upload;
            //普通图片上传
            var uploadInst = upload.render({
                elem: '#test2',
                url: '{:url("upload")}',
                multiple: true,
                before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        //console.log(result)
                        $('#demo1').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                        //$('#demo1').append('<img src="__PUBLIC__/imgs/banner.png" alt="'+ file.name +'" class="layui-upload-img">')
                    });
                },
                done: function(res){
                    //如果上传失败
                    if(res.code > 0){
                        return layer.msg('上传失败');
                    }
                    var img = $('#img_banner').val();
                    if (img == '') {
                        img = res.url;
                        $('#img_banner').val(img)
                    }else{
                        img +=','+res.url 
                        $('#img_banner').val(img)
                    }

                },
                error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });
        });
        layui.use('laydate', function(){
            var laydate = layui.laydate;
                laydate.render({
                elem: '#test14'
                ,format: 'yyyy/MM/dd'
            });
        })
    </script>
</body>

</html>