@extends('layouts.test')
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/r-2.2.2/datatables.min.css"/>

    <style type="text/css">
    </style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">{{ __('New Record') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('employee/salesRecord') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="customer_name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>

                            <div class="col-md-6">
                                <input id="customer_name" type="text" class="form-control{{ $errors->has('customer_name') ? ' is-invalid' : '' }}" name="customer_name" value="{{ old('customer_name') }}" required autofocus>

                                @if ($errors->has('customer_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('customer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_description" class="col-md-4 col-form-label text-md-right">{{ __('Product Description') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control{{ $errors->has('product_description') ? ' is-invalid' : '' }}" id="product_description" rows="2"  name="product_description" required>{{ old('product_description') }}</textarea>
                                @if ($errors->has('product_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="record_image" class="col-md-4 col-form-label text-md-right">{{ __('Upload Image') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control-file{{ $errors->has('record_image') ? ' is-invalid' : '' }}" id="record_image"  name="record_image" onchange="previewHandle(this);" required>

                                @if ($errors->has('record_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('record_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <img id="preview-img" width=100% height=100%/>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Record') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (count($salesRecords) > 0)
            <div class="card">
                <table id="example" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <!-- <th>created_at</th> -->
                            <th>product_description</th>
                            <th>customer_name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesRecords as $record)
                        <tr>
                            <td></td>
                            <!-- <td>2018-12-23 11:24:15</td> -->
                            <td>{{ $record->product_description }}</td>
                            <td>{{ $record->customer_name }}</td>
                            <td><img src="{{ url($record->record_image) }}" style="width:300px;"></td>
                            <td>
                                <form action="{{url('employee/salesRecord/'.$record->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('plugins')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ url('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
    <script type="text/javascript">
    var $j=$.noConflict();
    $j(document).ready( function () {
        $j.extend( $j.fn.dataTable.defaults, {
                searching: false,
                paging:   false,
                ordering: false,
                info:     false,
                // responsive: true,
            } );
        $j('#example').dataTable( {
            responsive: {
                details: {
                    type: 'column',
                },
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0,
            } ],
            order: [ 1, 'asc' ],
        } );
    } );
    function previewHandle(fileDOM) {
        var file = fileDOM.files[0], // 获取文件
            imageType = /^image\//,
            reader = '';

        // 文件是否为图片
        if (!imageType.test(file.type)) {
            alert("请选择图片！");
            return;
        }
        // 判断是否支持FileReader
        if (window.FileReader) {
            reader = new FileReader();
        }
        // IE9及以下不支持FileReader
        else {
            alert("您的浏览器不支持图片预览功能，如需该功能请升级您的浏览器！");
            return;
        }

        // 读取完成
        reader.onload = function (event) {
            // 获取图片DOM
            var img = document.getElementById("preview-img");
            // 图片路径设置为读取的图片
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
    </script>
@endpush
