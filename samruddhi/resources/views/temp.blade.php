<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}">
<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
@include('sweetalert::alert')


<section class="form">
    <div class="container mt-5">
        @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        <span style="color: red">{{$error}}</span>
        <br>
        @endforeach
        @endif

        <form action="/add_file" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">File1</label>
                <input type="file" class="form-control" name="file1">
                {{-- <span style="color: red">@error('file1'){{$message}}@enderror</span> --}}
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">File2</label>`
                <input type="file" class="form-control" name="file2">
                {{-- <span style="color: red">@error('file2'){{$message}}@enderror</span> --}}
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</section>
