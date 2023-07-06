<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

</head>

<body>

    <?php $url = config('base_url'); ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 offset-3 mt-lg-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center text-dark"> Update User </h2>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{config('base_url')}}/users/{{$data->id}}" method="POST">
                        @CSRF
                        <div class="form-group">
                            <label class="control-label col-sm-12">Name :</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$data->name}}" required>
                                @error('name')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-12">Email:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{$data->email}}" required>
                                @error('email')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">Update user</button>
                               
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            </div>
            
        </div>
    </div>
</body>

</html>