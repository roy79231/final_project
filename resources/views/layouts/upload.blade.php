<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpLoader</title>
    <style>
        /* 側邊欄樣式 */
        .sidebar {
            height: 100%;
            width: 20%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
        }

        /* 側邊欄中連結 */
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        /* 側邊欄中連結-鼠標懸停 */
        .sidebar a:hover {
            background-color: #6c1818;
        }

        /* 內容 */
        .content {
            margin-left: 275px; /* 側邊欄寬 */
            padding: 20px;
        }

        /*box樣式*/
        .box {
            background-color: #ece7e7;
            margin-bottom: 10px;
            padding: 5px; /* 調整內容與邊界之間的距離 */
            border-radius: 10px;
        }
        .boxContainer {
            display:inline-flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <!--側邊欄-->
    <div class="sidebar">
        <br>
        <a href="{{ route('talentUpLoader') }}">天賦羅</a>
        <br>
        <a href="{{ route('specialEventUpLoader') }}">加分事件</a>
        <br>
        <a href="{{ route('normalEventUpLoader') }}">一般事件</a>
        <br>
        <a href="{{ route('achievementEventUpLoader') }}">成就事件</a>
        <br>
        <a href="{{ route('achievementUpLoader') }}">成就條件</a>
    </div>

    <div class="boxContainer">
        @yield('name')
    </div>
</body>
</html>