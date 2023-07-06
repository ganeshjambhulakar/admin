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
    <div class="container">
        <div class="row">
            <div class="col">
                <div class=" mt-5">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
                        <a class="navbar-brand" href="#">Product Management</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="/products">Products</a>
                                </li>
                                @if(session()->get("ROLE") == 'ADMIN')
                                 <li class="nav-item">
                                    <a class="nav-link" href="/users"> Users</a>
                                 </li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                        </svg> <?php echo session()->get("USER")['name']; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{config('base_url')}}/users/logout"> <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>

                                    </div>
                                </li>


                            </ul>
                        </div>
                    </nav>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    $(".watch").css('display', "none");
    $(".start").css('display', "block");
    $(".end").css('display', "none");

    var id;
    $(".startTime").click(function() {
        id = $(".id").val();
        var description = $(".description").val();
        if (description == "") {
            $(".err_dsc").text("Please enter description");
        } else {
            startTime(id);
            $("#frm" + id).submit()

        }
        // console.log(id)
    })

    const startTime = (uid) => {
        id = uid;
        Clock.start(id);

        // if (localStorage.getItem("status") == "pause") {
        //     Clock.pause();
        // }else if(localStorage.getItem("status") == "resume") {
        //     Clock.resume();
        // }
        if (localStorage.getItem("id") == null || localStorage.getItem("id") == undefined) {
            localStorage.setItem("id", parseInt(id));
        } else {
            localStorage.setItem("id", parseInt(id));

        }
        $("#watch" + localStorage.getItem("id")).css('display', "block");
        $(".start").css('display', "none");
        $(".end").css('display', "block");
        $(".pauseButton").css('display', "block");
        $("#action" + localStorage.getItem("id")).html("<a href='../timelog/list'>Wroking</a>");

    }

    var Clock = {
        totalSeconds: 0,
        start: function(id) {
            var self = this;
            this.interval = setInterval(function() {
                self.totalSeconds += 1
                if (localStorage.getItem("Watch" + id) != null) {
                    self.totalSeconds = parseInt(localStorage.getItem("Watch" + id));
                    localStorage.setItem("Watch" + id, parseInt(self.totalSeconds) + 1)
                } else {
                    localStorage.setItem("Watch" + id, parseInt(self.totalSeconds));
                }
                $("#hour" + localStorage.getItem("id")).text(Math.floor(self.totalSeconds / 3600) > 0 ? Math.floor(self.totalSeconds / 3600) + " Hours :" : "");
                $("#min" + localStorage.getItem("id")).text(Math.floor(self.totalSeconds / 60 % 60) > 0 ? Math.floor(self.totalSeconds / 60 % 60) + " Min :" : "");
                $("#sec" + localStorage.getItem("id")).text(parseInt(self.totalSeconds % 60) + " Sec");
                $("#duration" + localStorage.getItem("id")).val(Math.floor(self.totalSeconds / 3600) + ":" + Math.floor(self.totalSeconds / 60 % 60) + ":" + parseInt(self.totalSeconds % 60));

            }, 1000);
        },

        pause: function() {
            clearInterval(this.interval);
            delete this.interval;
        },

        resume: function() {
            if (!this.interval) this.start();
        }

    };
    $('.pauseButton').click(function() {
        $(".pauseButton").css('display', "none");
        $(".resumeButton").css('display', "block");
        Clock.pause();
        localStorage.setItem("status", "pause");
    });
    $('.resumeButton').click(function() {
        $(".resumeButton").css('display', "none");
        $(".pauseButton").css('display', "block");
        Clock.resume();
        // console.log(localStorage.getItem("id"));
        localStorage.setItem("status", "resume");

    });
    $(".end").click(function() {
        localStorage.clear();
        delete this.interval;
        Clock.pause();
        localStorage.setItem("id", id);
        $(".start").css('display', "block");
        $("#watch" + localStorage.getItem("id")).css('display', "none");

    });

    //   localStorage.clear();
    $(".resumeButton").css('display', "none");
    if (localStorage.getItem("Watch" + localStorage.getItem("id")) != "" && localStorage.getItem("Watch" + localStorage.getItem("id")) != null) {
        startTime(localStorage.getItem("id"));


    };
</script>

</html>