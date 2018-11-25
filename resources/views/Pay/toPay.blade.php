@extends('widget/layout/body.blade.php')
@section('title', '支付')
@section('body')


@require('static/js/pingpp.js')
@script()
    var pay=require('page/Pay/pay');
    pay.sub('{{$id}}');
@endscript
@endsection
@section("fis_resource")@parent @require('page/Pay/toPay.blade.php')@stop