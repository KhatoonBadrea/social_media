<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>index</th>
                <th>name</th>
            </tr>
        </thead>
        
        @foreach ($categories as $category)
        <tbody>
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$category->name}}</td>
                <td><a href={{route('category.edit',$category->id)}}>edit</a></td>
                <td>
                    <form action="{{route('category .destroy',$category->id)}} " method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="delete">
                </form>
                </td>
                
            </tr>
        </tbody>
        @endforeach
    </table>
</body>
</html>