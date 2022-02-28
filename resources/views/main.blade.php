<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('vendor/prequel/favicon.png') }}">
  <link rel="stylesheet" href="{{ asset('vendor/prequel/app.css') }}">

  <title>{{ (config('app.name')) }} Prequel</title>
</head>
<body>

<div id="prequel"></div>

<script>
    // Pass initial data to JavaScript
    window.Prequel = {};
    window.Prequel.i18n = @json($lang);
    window.Prequel.env = @json($env);
    window.Prequel.error = {
        error   : false,
        detailed: '',
        code    : '',
    };
    window.Prequel.data = @json($data['collection']);
    window.Prequel.flat = @json($data['flatTableCollection']);
</script>
<script src="{{ asset('/vendor/prequel/app.js') }}"></script>
</body>
</html>
