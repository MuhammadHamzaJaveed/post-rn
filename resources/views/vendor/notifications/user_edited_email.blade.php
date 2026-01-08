<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UHS Application Status</title>
</head>

<body>
    <div style="min-height: 100vh;">
        <div style=" display: flex; flex-direction: column; align-items: center; justify-items: center;">
            <div>
                <img src="{{ asset('images/login.png') }}" class="logo" alt="uhs-portal Logo">
            </div>
            <p style="text-align: center;margin-bottom: 2rem; font-weight: bold; font-family: 'Inter', sans-serif;">
                UNIVERSITY OF HEALTH SCIENCES
            </p>

            <div
                style="background-color: #fff; border-radius: 0.5rem; box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.3); padding: 2rem; width: 600px; height:auto; text-align: center;">
                <p style="margin-bottom: 1.25rem; font-family: 'Inter', sans-serif;">Dear Student, Your application has been modified successfully.
                    @if($isPaid == 1)
                        A PDF copy has been attached for your reference
                    @endif
                    <br />
                    <br />
                    <strong>Best Wishes from UHS.</strong>
                </p>
            </div>

            <p
                style="margin-top: 2rem; margin-bottom: 4rem; font-weight: bold; font-family: 'Inter', sans-serif; text-align: center;">
                Regards, UHS
            </p>
        </div>
    </div>
</body>

</html>
