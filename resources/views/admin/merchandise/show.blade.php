@extends('layouts.app')
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/r-2.2.2/datatables.min.css"/>

    <style type="text/css">
    </style>
@endpush
@section('content')
    <h3>merchandise show(Display the specified resource.)</h3>
    <h5>GET|HEAD| admin/merchandise/{merchandise}| merchandise.show| App\Http\Controllers\Admin\MerchandiseController@show| web,auth</h5>
    @include('components.validationErrorMessage')
    <table border=1 width=100%>
        <td colspan=18>
        @if(!is_null($parent))
            @if($display==0)
                <a href="{{ url('admin/merchandise/'.$parent->id.'/show/1') }}" style=""><button type="submit"><-back</button></a>
            @else
                <a href="{{ url('admin/category/'.$parent->parent_id.'/show/1') }}" style=""><button type="submit"><-back</button></a>
            @endif
        @endif
            <a href="{{ url('admin/merchandise/'.$parent_id.'/create') }}" style="float: right;"><button type="submit">create</button></a>
            <a href="{{ url('admin/merchandise/'.$parent_id.'/show/0') }}" style="float: right;"><button type="submit">restore</button></a>
        </td>
        <tr>
            <td>id</td>
            <td>merchandise_no</td>
            <td>name</td>
            <td>name_en</td>
            <td>logo</td>
            <td>info</td>
            <td>info_en</td>
            <td>parent_id</td>
            <td>remain_qty</td>
            <td>created_by_id</td>
            <td>updated_by_id</td>
            <td>view</td>
            <td>price</td>
            <td>brand_id</td>
            <td>vendor_id</td>
            <td>highly_qty</td>
            <td>edit</td>
            <td>delete</td><!-- display -->
        </tr>
        @foreach($merchandise as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->merchandise_no }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->name_en }}</td>
            <td><img src="{{ is_null($item->logo)?url('/images/default-merchandise.png'):url($item->logo) }}" width=100/></td>
            <td>{{ $item->info }}</td>
            <td>{{ $item->info_en }}</td>
            <td>{{ $item->parent_id }}</td>
            <td>{{ $item->remain_qty }}</td>
            <td>{{ $item->created_by_id }}</td>
            <td>{{ $item->updated_by_id }}</td>
            <td>{{ $item->view }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->brand_id }}</td>
            <td>{{ $item->vendor_id }}</td>
            <td>{{ $item->highly_qty }}</td>
            <td><a href="{{ url('admin/merchandise/'.$item->id.'/edit') }}"><button type="submit">edit</button></a></td>
            <td><!-- update display -->
            @if($item->display)
                <form action="{{ url('admin/merchandise/'.$item->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="delete">
                </form>
            @else
                <form action="{{ url('admin/merchandise/'.$item->id.'/restore') }}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" value="restore">
                </form>
            @endif
            </td>
        </tr>
        @endforeach
    </table>
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
