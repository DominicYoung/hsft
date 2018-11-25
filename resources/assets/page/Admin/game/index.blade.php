@extends('/widget/layout/Admin/body.blade.php')
@section('title','首页')
@section('header')

@endsection

@section('body')

@require('/static/lib/datatables/css/dataTables.bootstrap.css')


<div class="box box-primary">

    <div class="box-header with-border">
        <p>已结束比赛：<mark>{{$games}}</mark>个&nbsp;&nbsp;&nbsp;&nbsp;共计参赛人数：<mark>{{$people}}</mark>人&nbsp;&nbsp;&nbsp;&nbsp;参赛且关注人数：<mark>{{$focuspeople}}</mark>人</p>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <span class="label label-primary"><i class="glyphicon glyphicon-th-list"></i> </span>
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->

    <div class="box-body">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>编号</th>
                <th>比赛名称</th>
                <th>标签</th>
                <th>发起人</th>
                <th>联系人</th>
                <th>联系电话</th>
                <th>报名截止时间</th>
                <th>报名人数</th>
                <th>新增参赛且关注人数</th>
                <th>发起人暂停</th>
                <th>管理员暂停</th>
                <th>操作</th>
            </tr>
            </thead>

        </table>
    </div>


</div> <!-- /container -->
    @script()
        require('./index');

    @endscript


@endsection

