@extends('layouts.yooqin')

@section('css')
<link href="{{ asset('static/editor.md-master/css/editormd.preview.min.css') }}" rel="stylesheet">
<link href="{{ asset('static/css/fix_md.css') }}" rel="stylesheet">
@endsection

@section('meta-title')Sports Dashboard - 优勤网(www.yooqin.com)@endsection
@section('meta-description')运动仪表板@endsection
@section('meta-keywords')仪表板@endsection




@section('main-content')
<style type="text/css">
.main-content{width:100%;}
.comments .left{width:48%; float:left;}
.comments .right{width:48%; float:right;}

.axis--x path {
  display: none;
}

.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 1.5px;
}
.right{margin-top:30px;}

.mytb{
font-size:12px;
margin-top:20px;
}
.mytb>thead>tr>th{color:#3b6427;}
.mytb>tbody>tr>th{color:#3b6427;}
.mytb>tbody>tr>td, .mytb>tbody>tr>th, .mytb>tfoot>tr>td, .mytb>tfoot>tr>th, .mytb>thead>tr>td, .mytb>thead>tr>th{
padding:4px;
}

.fm{padding:50px; background:#fff;}
.fm div{padding:5px 0px;}
.fm div span{width:60px; display:inline-block;}
.fk1,.fk2,.fk3, .fk{display:inline-block; line-height:30px; height:15px; width:15px; margin-right:5px; border-radius:10px;}
.fk{background:#178bc9;}
.fk1{background:#FF7777;}
.fk2{background:#D4AB6A;}
.fk3{background:#6DA398;}

.c1{color:#FF7777;}
.c2{color:#D4AB6A;}
.c3{color:#6DA398;}

.target_list{font-size:12px;}
</style>

<div class="comments clearfix">
	<div class="left">
    <h3 style="color:#178bc9; font-size:16px; line-height:30px;"><?php echo date("Y年m");?>月份目标, 第<?php echo date("j");?>天</h3>
		<!-- 总目标 -->
		<svg id="fillgauge1" width="97%" height="250"></svg>
		<!-- 跑步 -->
		<svg id="fillgauge2" width="30%" height="200"></svg>
		<!-- 器械 -->
		<svg id="fillgauge3" width="30%" height="200"></svg>
		<!-- 骑行 -->
		<svg id="fillgauge6" width="30%" height="200"></svg>
        <div class="target_list">
            <p><span class='fk'></span>完成<?php echo $target_total;?>%</p>
            <?php foreach ($target_list as $_key=>$_item) {?>
            <p><span class='fk<?php echo $_key;?>'></span><?php echo $_item['name'];?>目标<?php echo $_item['target']?>, 完成<?php echo $_item['pre'];?>%</p>
            <?php } ?>
        </div>
	</div>
	<div class="right">
		<div id="cal-heatmap"></div>
        <table class="table table-striped mytb">
      <thead>
        <tr>
          <th>日期</th>
          <th>项目</th>
          <th>距离</th>
          <th>时间</th>
          <th>执行时间</th>
          <th>备注</th>
        </tr>
      </thead>
      <tbody>
        @foreach($list['list'] as $_item)
        <tr class="c{{$_item['type']}}">
          <th scope="row">{{$_item['day']}}</th>
          <td>{{$_item['type_name']}}</td>
          <td>
            @if ($_item['type'] != 3)
            {{$_item['distance']}}KM
            @else 
            0
            @endif
            </td>
          <td>
            @if ($_item['type'] == 3)
            {{$_item['distance']}}分钟
            @else 
            0
            @endif
            </td>
            <td>{{$_item['time_date']}}</td>
            <td>{{$_item['title']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div>{{$list['paginate']}}</div>
	</div>
</div>


@if (Auth::id())
<form style="padding:20px;" class="fm">
    <div>
        <span>Title:</span><input type="input" name="title" value="" />
    </div>
    <div>
    <span>time:</span><input type="input" name="time" value="<?php echo date('Ymd H:i:s')?>" />
    </div>
    <div>
        <span>Type:</span>
        <select name="type">
            <option value="1">跑</option>
            <option value="2">骑</option>
            <option value="3">器械</option>
        </select>
    </div>
    <div>
        <span>Distance/Minutes:</span><input type="input" name="distance" value="5" />KM/Minutes
    </div>
    <div>

    </div>
    <div>
        <input type="button" value="提交" id="submit"/>
    </div>
</form>
@endif


@endsection

@section('js')
<script src="/static/d3/d3.v3.min.js" language="JavaScript"></script>
<script src="/static/d3/liquidFillGauge.js"></script>


<script type="text/javascript" src="/static/d3/cal-heatmap.min.js"></script>
<link rel="stylesheet" href="/static/d3/cal-heatmap.css" />

<script type="text/javascript">

	var config = liquidFillGaugeDefaultSettings();
    config.circleThickness = 0.2;
    config.textVertPosition = 0.2;
    config.waveAnimateTime = 1500;
    config.textVertPosition = 0.5;
    config.waveHeight = 0.2;
    config.waveCount = 1;


    var gauge1 = loadLiquidFillGauge("fillgauge1", <?php echo $target_total;?>, config);
    var config1 = liquidFillGaugeDefaultSettings();
    config1.circleColor = "#FF7777";
    config1.textColor = "#FF4444";
    config1.waveTextColor = "#FFAAAA";
    config1.waveColor = "#FFDDDD";
    config1.circleThickness = 0.1;
    config1.textVertPosition = 0.5;
    config1.waveAnimateTime = 1000;

    var gauge2= loadLiquidFillGauge("fillgauge2", <?php echo $target_list[1]['pre'];?>, config1);
    var config2 = liquidFillGaugeDefaultSettings();
    config2.circleColor = "#D4AB6A";
    config2.textColor = "#553300";
    config2.waveTextColor = "#805615";
    config2.waveColor = "#AA7D39";
    config2.circleThickness = 0.1;
    //config2.circleFillGap = 0.2;
    config2.textVertPosition = 0.5;
    config2.waveAnimateTime = 1000;
    //config2.waveHeight = 0.3;
    //config2.waveCount = 1;
    var gauge3 = loadLiquidFillGauge("fillgauge3", <?php echo $target_list[2]['pre'];?>, config2);
    
    var config5 = liquidFillGaugeDefaultSettings();
    config5.circleColor = "#6DA398";
    config5.textColor = "#0E5144";
    config5.waveTextColor = "#6DA398";
    config5.waveColor = "#246D5F";
	config5.circleThickness = 0.1;
    //config5.circleFillGap = 0.2;
    config5.textVertPosition = 0.5;
    config5.waveAnimateTime = 1000;
    //config5.waveHeight = 0.3;
    //config5.waveCount = 1;
    var gauge6 = loadLiquidFillGauge("fillgauge6", <?php echo $target_list[3]['pre'];?>, config5);
</script>

<script>
var cal = new CalHeatMap();
	cal.init({
		start: new Date(2017, 8), // January, 1st 2000
		end: new Date(2018, 10), // January, 1st 2000
		range: 12,
		domain: "month",
		subDomain: "x_day",
		range:6,
		domainGutter:6,
        tooltip:true,
        legend:[1, 2, 3, 5],
        domainDynamicDimension:true,
        data:'/dashboard/record?<?php echo "start={{d:start}}&stop={{d:end}}";?>'	
	});
</script>

<script>

$(document).ready(function(){

    $("#submit").click(function(){

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN':window.window.YOOQIN.csrf_token}
        });

        $.ajax({
        type:'post',
        url:'/dashboard', 
        data:$("form").serialize(),
        success:function(data){
            if (data.status == 'success') {
                alert('成功'); 
                window.location.reload();
            } else {
                alert(data.message); 
            }
            },
        error:function(data){
            alert('网络错误');
            }
        });
    
    });

});

</script>

@endsection
