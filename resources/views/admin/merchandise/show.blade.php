<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>merchandise show(Display the specified resource.)</h1>
    <h3>GET|HEAD| admin/merchandise/{merchandise}| merchandise.show| App\Http\Controllers\Admin\MerchandiseController@show| web,auth</h3>
    @include('components.validationErrorMessage')
    <a href="{{ url('admin/merchandise/'.$category_id.'/create') }}"><button type="submit">create</button></a>
    <table border=1>
        <tr>
            <td>id</td>
            <td>merchandise_no</td>
            <td>name</td>
            <td>name_en</td>
            <td>image</td>
            <td>info</td>
            <td>info_en</td>
            <td>category_id</td>
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
            <td>{{ $item->image }}</td>
            <td>{{ $item->info }}</td>
            <td>{{ $item->info_en }}</td>
            <td>{{ $item->category_id }}</td>
            <td>{{ $item->remain_qty }}</td>
            <td>{{ $item->created_by_id }}</td>
            <td>{{ $item->updated_by_id }}</td>
            <td>{{ $item->view }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->brand_id }}</td>
            <td>{{ $item->vendor_id }}</td>
            <td>{{ $item->highly_qty }}</td>
            <td>edit</td>
            <td>delete</td><!-- display -->
        </tr>
        @endforeach
    </table>
</body>
</html>
