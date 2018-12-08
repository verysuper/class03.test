<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>merchandise edit(Show the form for editing the specified resource)</h1>
    <h3> GET|HEAD  | admin/merchandise/{merchandise}/edit| merchandise.edit| App\Http\Controllers\Admin\MerchandiseController@edit| web,auth</h3>
    @include('components.validationErrorMessage')
    <form action="{{ url('admin/merchandise/'.$merchandise->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
        <table border=1>
            <tr>
                <td colspan="2">
                    <img id="preview-img" src="{{ is_null($merchandise->image)?url('/images/default-merchandise.png'):url('/images/merchandise/'.$merchandise->image) }}" width=350/>
                </td>
            </tr>
            <tr>
                <td>merchandise_no</td>
                <td><input type="text" name="merchandise_no" id="" value="{{ old('merchandise_no',$merchandise->merchandise_no) }}" required autocomplete="off"></td>
            </tr>
            <tr>
                <td>name</td>
                <td><input type="text" name="name" id="" value="{{ old('name',$merchandise->name) }}" required autocomplete="off"></td>
            </tr>
            <tr>
                <td>name_en</td>
                <td><input type="text" name="name_en" id="" value="{{ old('name_en',$merchandise->name_en) }}" required  autocomplete="off"></td>
            </tr>
            <tr>
                <td>image</td>
                <td><input type="file" name="image" id="" onchange="previewHandle(this)"></td>
            </tr>
            <tr>
                <td>info</td>
                <td><textarea rows="4" cols="25" name="info" required>{{ old('info',$merchandise->info) }}</textarea></td>
            </tr>
            <tr>
                <td>info_en</td>
                <td><textarea rows="4" cols="25" name="info_en" required>{{ old('info_en',$merchandise->info_en) }}</textarea></td>
            </tr>
            <tr>
                <td>price</td>
                <td><input type="text" name="price" id="" value="{{ old('price',$merchandise->price) }}" required  autocomplete="off"></td>
            </tr>
            <tr>
                <td>brand_id</td>
                <td><input type="text" name="brand_id" id="" value="{{ old('brand_id',$merchandise->brand_id) }}" required  autocomplete="off"></td>
            </tr>
            <tr>
                <td>vendor_id</td>
                <td><input type="text" name="vendor_id" id="" value="{{ old('vendor_id',$merchandise->vendor_id) }}" required  autocomplete="off"></td>
            </tr>
            <tr>
                <td>remain_qty</td>
                <td><input type="text" name="remain_qty" id="" value="{{ old('remain_qty',$merchandise->remain_qty) }}" required  autocomplete="off"></td>
            </tr>
            <input type="hidden" name="updated_by_id" value="{{ Auth::user()->id }}">
            <tr>
                <td></td>
                <td><button type="submit">submit</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
<script>
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
