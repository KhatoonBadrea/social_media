<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit category</title>
</head>
<body>
    <h1>Edit Category</h1>
    <form action="{{route('category.update',$category->id)}}" method="post">
        @csrf
        @method('PUT')
        <label for="name">category Name:</label>
        <input type="text" name='name' value="{{$category->name}}"><br><br>
        
        <input type="submit" value="submit">
        
    </form>
    
</body>
</html> 