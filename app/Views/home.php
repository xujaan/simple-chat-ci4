<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/cyborg/bootstrap.min.css" integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <title><?= $title; ?></title>
    <style>
        input {
            background-color: #222 !important;
            color: white !important;
            border-color: #111 !important;
        }

        * {
            outline: none !important;
            box-shadow: none !important;
        }

        h5 {
            font-size: 1.5em;
            color: white !important;
        }

        #pesanbox::-webkit-scrollbar {
            display: none;
        }

        #pesanbox {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- <div class="row d-flex justify-content-center mt-5" id="pesanbox" style="max-height: 30vh;"> -->

        <!-- </div> -->
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-7 col-sm-12 overflow-auto" id="pesanbox" style="max-height: 60vh;">
                <!-- chat -->
            </div>
            <div class=" col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (!session()->has('user')) : ?>
                            <form action="<?= base_url('home/set'); ?>" method="post">
                                <div class="input-group">
                                    <input type="text" autofocus placeholder="nama" name="user" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">set</button>
                                    </div>
                                </div>
                            </form>
                        <?php else : ?>
                            <!-- <form action="<?= base_url('home/kirim'); ?>" method="post"> -->
                            <div class="input-group">
                                <input type="text" autofocus name="pesan" placeholder="pesan" id="pesan" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" id="kirim" onclick="kirim();">kirim</button>
                                </div>
                            </div>
                            <!-- </form> -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        // display()
        $(document).ready(function() {
            setInterval(function() {
                display()
            }, 1000);
        });
        $("#pesan").on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                kirim()
            }
        });

        function display() {

            var card = $('#pesanbox');
            $.get("<?= base_url('home/read'); ?>")
                .done(function(data) {
                    card.html('')
                    $.each(data, function(i) {
                        card.append(`
                        <div class="card my-1">
                            <div class="card-body p-2">
                                <h5 class='float-left m-0'><strong class="text-warning">` + data[i]['user'] + `:</strong> ` + data[i]['pesan'] + `</h5>
                                <p class='float-right m-0'>` + data[i]['created_at'] + `</p>
                            </div>
                    </div>
                    `)
                    });
                    $('#pesanbox').scrollTop(1000000)
                });
        }

        function kirim() {
            $.post('<?= base_url('home/kirim'); ?>', {
                    pesan: $('#pesan').val()
                })
                .done(function(data) {
                    // console.log(data);
                    $('#pesan').val('');
                    $('#pesan').focus();
                    display()
                });
        }
    </script>
</body>

</html>