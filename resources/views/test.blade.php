<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- <link rel="stylesheet" href="/css/datepickk.min.css"> --}}

    <link rel="stylesheet" href="/css/daterangepicker.css">

    <script src="/js/jquery.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <link rel="stylesheet" href="/css/app.css">
    <title>Document</title>


    
</head>
<body>

    


        <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
        <script>
                $(function() {
                  $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                  }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                  });
                });
                </script>
                
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/js/daterangepicker.js"></script>

</body>
</html>