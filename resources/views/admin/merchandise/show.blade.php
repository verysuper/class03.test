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
    <table border=1>
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
</body>
</html>
