<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Single Flip Book</title>
    <style>
        body{
            background-color: black;
            display: flex;
            height: 90vh;
            align-items: center;
            justify-content: center;
        }

        .book-container{
            width: 400px;
            height:400px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: grey;
            perspective: 1000px;
        }

        .page{
            width: 150px;
            height: 200px;
            background-color: white;
            transform-style: preserve-3d;
            position: absolute;
            transform: rotateY(0);
            transition: transform 1s ease;
            transform-origin: left center;
        }

        .book-container:hover .page{
            transform: rotateY(-180deg);
        }
        
    </style>
</head>
<body>

    <div class="book-container">
        <div class="page">
            Page 1 Content (Hover to flip)
        </div>
    </div>

</body>
</html>