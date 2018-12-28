@extends('layouts.app')
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
    <h3>create(Show the form for creating a new resource)</h3>
    <h5>GET|HEAD| admin/category/create| category.create| App\Http\Controllers\Admin\CategoryController@create| web</h5>
    @include('components.validationErrorMessage')
    <form action="{{ url('admin/category') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
        <table border=1 width=100%>
            <tr>
                <td colspan="2">
                    <img id="preview-img" src="{{ url('/images/default-merchandise.png') }}" width=350/>
                </td>
            </tr>
            <tr>
                <td>category_no</td>
                <td><input type="text" name="category_no" id="" value="{{ old('category_no') }}" required autocomplete="off"></td>
            </tr>
            <tr>
                <td>name</td>
                <td><input type="text" name="name" id="" value="{{ old('name') }}" required autocomplete="off"></td>
            </tr>
            <tr>
                <td>name_en</td>
                <td><input type="text" name="name_en" id="" value="{{ old('name_en') }}" required  autocomplete="off"></td>
            </tr>
            <tr>
                <td>Logo</td>
                <td><input type="file" name="logo" id="" onchange="previewHandle(this)"></td>
            </tr>
            <tr>
                <td>info</td>
                <td><textarea rows="4" cols="25" name="info">{{ old('info') }}</textarea></td>
            </tr>
            <tr>
                <td>info_en</td>
                <td><textarea rows="4" cols="25" name="info_en">{{ old('info_en') }}</textarea></td>
            </tr>
            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
            <input type="hidden" name="display" value="1">
            <input type="hidden" name="view" value="0">
            <input type="hidden" name="created_by_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="updated_by_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="layer" value="{{ $layer }}">
            <tr>
                <td></td>
                <td><button type="submit">submit</button></td>
            </tr>
        </table>
    </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugins')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript">
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

