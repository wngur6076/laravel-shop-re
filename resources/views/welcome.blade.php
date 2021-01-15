<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body>
    <div id="app">
        <index></index>
    </div>

    @include('includes.page-js')
</body>

</html>
