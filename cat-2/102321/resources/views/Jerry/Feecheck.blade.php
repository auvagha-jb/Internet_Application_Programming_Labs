<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search</title>
    @include('links')
</head>

<body>
    @include('Jerry.navbar')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <form style="margin-left: 400px; width: 300px;" action="{{ URL::to('find') }}" method="POST">
                {{ csrf_field() }}
                <div class="input-group p-3">
                    <input type="text" id="search" name="search" class="form-control"
                        placeholder="Search payment history">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div id="result" class="panel panel-default"
        style="width:400px; position:absolute; left:180px; top:55px; z-index:1; display:none">
        <ul style="margin-top:10px; list-style-type:none;" id="memList">

        </ul>
    </div>
    <div class="container">
        @yield('content')

    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search').keyup(function() {
            var search = $('#search').val();
            if (search == "") {
                $("#feeList").html("");
                $('#result').hide();
            } else {
                $.get("{{ URL::to('search') }}", {
                    search: search
                }, function(data) {
                    $('#feeList').empty().html(data);
                    $('#result').show();
                })
            }
        });
    });
    </script>
</body>

</html>