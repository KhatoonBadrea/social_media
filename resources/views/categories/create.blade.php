<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create categories</title>
</head>
<body>
    <h1>Create New Category</h1>
    <form action="{{route('category.store')}}" method="post">
        @csrf
        <label for="name">category Name:</label>
        <input type="text" name='name'><br><br>
       
        <input type="submit" value="submit">
        
    </form>
</body>
</html>