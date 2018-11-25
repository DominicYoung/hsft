@extends('widget/layout/Admin/body.blade.php')
@section('title','banner管理')
@require('static/lib/datatables/css/dataTables.bootstrap.css')
@section('body')

<div class="box box-primary">
    <div class="box-header with-border">
        <div class="">
           <a href="/admin/banner/create" class="btn btn-flat bg-purple"><i class="fa fa-plus"></i>&nbsp;添加</a>
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->

    <div class="box-body">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>编号</th>
                <th>跳转链接</th>
                <th>图片</th>
                <th>操作</th>
            </tr>
            </thead>

        </table>
    </div>
</div><!-- /.nav-tabs-custom -->

@script()
require('page/Admin/banner/index');

@endscript
@endsection

@section("fis_resource")@parent @require('page/Admin/banner/index.blade.php')@stop