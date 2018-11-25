
@extends('/widget/layout/Admin/body.blade.php')
@section('title', '分类管理')
@section('body')

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="">
                <a href="/admin/category/add" class="btn btn-flat bg-purple"><i class="fa fa-plus"></i>&nbsp;添加</a>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->

        <div class="box-body">
            <table id="datalist" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="23%">ID</th>
                    <th>栏目名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($mylm as $key=>$item)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{!! $item !!}</td>
                        <td>
                         <a href="/admin/category/edit/{{$key}}" class="btn bg-purple btn-flat" data-type="edit"> <span class="glyphicon glyphicon-edit"></span> 编辑</a>&nbsp;&nbsp;
                            <button type="button" class="btn bg-maroon btn-flat del" data-id="{{$key}}"><span class="glyphicon glyphicon-remove"></span> 删除</button>

                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>
    </div><!-- /.nav-tabs-custom -->




    @script()
    var index=require('./index');

    @endscript
@endsection




