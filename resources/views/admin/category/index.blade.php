<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>index(Display a listing of the resource.)</h1>
    <h3>GET|HEAD|admin/category|category.index|App\Http\Controllers\Admin\CategoryController@index|web</h3>
    @include('components.validationErrorMessage')
    <a href="{{ url('admin/category/0/create') }}"><button type="submit">create</button></a>
    <table border=1>
        <tr>
            <td>id</td>
            <td>category_no</td>
            <td width="15%">name</td>
            <td>image</td>
            <td width="30%">info</td>
            <td>edit</td>
            <td>delete</td>
        </tr>
        @foreach($categorys as $category)
        <tr>
            <td>{{ $category->id }}</td>
            @if($category->layer < 2)
            <td><a href="{{ url('admin/category/'.$category->id) }}">{{ $category->category_no }}</a></td>
            <td><a href="{{ url('admin/category/'.$category->id) }}">{{ $category->name }}</a></td>
            <td><a href="{{ url('admin/category/'.$category->id) }}">{{ $category->image }}</a></td>
            <td><a href="{{ url('admin/category/'.$category->id) }}">{{ $category->info }}</a></td>
            @else
            <td>{{ $category->category_no }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->image }}</td>
            <td>{{ $category->info }}</td>
            @endif
            <td><a href="{{ url('admin/category/'.$category->id.'/edit') }}"><button type="submit">edit</button></a></td>
            <td>
                <form action="{{ url('admin/category/'.$category->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="delete">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
