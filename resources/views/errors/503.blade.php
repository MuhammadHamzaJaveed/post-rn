<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UHS- University of Health Sciences</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    h1{
        font-size:72px;
        font-family:comic-sans;
        font-weight:bolder;
        
    }
</style>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img style="width: -webkit-fill-available;" src="{{ asset('images/5febnotice.jpg') }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body style="background-image:url('images/uhs-bg.jpg'); background-size:cover; height: 100vh; margin: 0; display: flex; justify-content: center; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center justify-content-center">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h1>
                            Registration Opening Soon
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // $("#exampleModal").modal('show');
        });
    </script>
</body>

</html>