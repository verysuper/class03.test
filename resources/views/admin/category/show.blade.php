<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Category show(Display the specified resource.)</h1>
    <h3>GET|HEAD| admin/category/{parent_id}/show/{display}|| App\Http\Controllers\Admin\CategoryController@show| web,auth</h3>
    @include('components.validationErrorMessage')

    <table border=1>
        <tr>
            <td colspan=15>
                @if(!is_null($parent))
                    @if($display==0)
                        <a href="{{ url('admin/category/'.$parent->id.'/show/1') }}" style=""><button type="submit"><-back</button></a>
                    @else
                        <a href="{{ url('admin/category/'.$parent->parent_id.'/show/1') }}" style=""><button type="submit"><-back</button></a>
                    @endif
                @endif
                <a href="{{ url('admin/category/'.$parent_id.'/create') }}" style="float: right;"><button type="submit">create</button></a>
                <a href="{{ url('admin/category/'.$parent_id.'/show/0') }}" style="float: right;"><button type="submit">restore</button></a>
            </td>
        </tr>
        <tr>
            <td>id</td>
            <td>category_no</td>
            <td>name</td>
            <td>name_en</td>
            <td>image</td>
            <td>info</td>
            <td>info_en</td>
            <td>edit</td>
            <td>delete</td><!-- display -->
            <td>quantity</td>
            <td>view</td>
            <td>layer</td>
            <td>created_by_id</td>
            <td>updated_by_id</td>
            <td>parent_id</td>
        </tr>
        @foreach($categorys as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->category_no }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->name_en }}</td>
            <td><img src="{{ is_null($category->image)?url('/images/default-merchandise.png'):url('/images/category/'.$category->image) }}" width=100/></td>
            <td>{{ $category->info }}</td>
            <td>{{ $category->info_en }}</td>
            <td><a href="{{ url('admin/category/'.$category->id.'/edit') }}"><button type="submit">edit</button></a></td>
            <td><!-- update display -->
            @if($category->display)
                <form action="{{ url('admin/category/'.$category->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="delete">
                </form>
            @else
                <form action="{{ url('admin/category/'.$category->id.'/restore') }}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" value="restore">
                </form>
            @endif
            </td>
            @if($category->layer < 2)
            <td><a href="{{ url('admin/category/'.$category->id.'/show/1') }}">{{ $category->sub_qty!=0?$category->sub_qty:'0' }} piece</a></td>
            @else
            <td><a href="{{ url('admin/merchandise/'.$category->id.'/show/1') }}">{{ $category->sub_qty!=0?$category->sub_qty:'0' }} piece</a></td>
            @endif
            <td>{{ $category->view }}</td>
            <td>{{ $category->layer }}</td>
            <td>{{ $category->created_by_id }}</td>
            <td>{{ $category->updated_by_id }}</td>
            <td>{{ $category->parent_id }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
