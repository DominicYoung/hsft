@extends('widget/layout/body.blade.php')
@section('title', '导出参与名单')
@section('body')
    <div class="ui-form ui-border-t">
        <form id="email_form">
            <input type="hidden" name="id" value="{{$id}}">
            <div class="ui-form-item ui-form-item-pure ui-border-b">
                <input type="text" placeholder="邮箱" name="email">
            </div>
            <div class="ui-btn-wrap">
                <button class="ui-btn-lg ui-btn-green export" type="button">
                    确定
                </button>
            </div>
        </form>
    </div>
    @script()
    var main = require('page/Home/list/export');
    main.exportExcel('.export');
    @endscript
@endsection
@section("fis_resource")@parent @require('page/Home/list/export.blade.php')@stop