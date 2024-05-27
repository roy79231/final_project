@extends('layouts.app')

@section('content')
    <style>
        .uploadBoxContainer {
            display: flex; /* 設置為彈性容器 */
            /*justify-content: space-between;  將子元素分佈在容器中，保持相等間距 */
            flex-direction: column;
            flex-wrap: wrap;
            width: 100%;
            /*background-color: #f6f4e8;*/
        }
        .uploadBox1 {
            display: flex; /* 設置為彈性容器 */
            flex-direction: row;
            justify-content: center;
            width: 100%;
            height: 40%;
            padding: 20px 20px 0px 20px;
        }
        .uploadCenter {
            display: flex; /* 設置為彈性容器 */
            flex-direction: column;
            justify-content: center;
        }
        .uploadBox2 {
            display: flex; /* 設置為彈性容器 */
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            padding: 0px 20px;
            justify-content: center;
        }
        .uploadInnerBox {
            display: flex; /* 設置為彈性容器 */
            flex-direction: column;
            width: 40%;
            height: 40%;
            padding: 20px;
            margin: 5px;
        }
    </style>

    <div class="uploadBoxContainer">
        @yield('uploader')
    </div>
@endsection