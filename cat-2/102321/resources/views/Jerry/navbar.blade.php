<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand btn btn-primary" href="#">AMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active p-2">
                <a style="text-decoration: none; font-size: 18px;" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item p-2">
                <a style="text-decoration: none; font-size: 18px;" href="{{ route('student') }}">Register</a>
            </li>
            <li class="nav-item p-2">
                <a style="text-decoration: none; font-size: 18px;" href="{{ url('all/students/')}}">Students</a>
            </li>
            <li class="nav-item p-2">
                <a style="text-decoration: none; font-size: 18px;" href="{{ route('fees') }}">Fee Deposit</a>
            </li>
            <li class="nav-item p-2">
                <a style="text-decoration: none; font-size: 18px;" href="{{ route('paid') }}">Payments</a>
            </li>
        </ul>
    </div>

</nav>