<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
    <div >
        <img src="{{ asset('images/login.png') }}" class="logo" alt="uhs-portal Logo">
    </div>
    <p style="margin-bottom: 2rem; font-weight: bold; font-family: 'Inter', sans-serif;">
       UNIVERSITY OF HEALTH SCIENCES
    </p>

    <div style="background-color: #fff; border-radius: 0.5rem; box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.3); padding: 2rem; width: 400px;">
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;" class="font-inter font-semibold">Verification Code</h2>
        <p style="margin-bottom: 1.25rem; font-family: 'Inter', sans-serif;">Your OTP code is: <strong>{{ $otp }}</strong>. The code is valid for 10 minutes.</p>
    </div>

    <p style="margin-bottom: 4rem; font-weight: bold; font-family: 'Inter', sans-serif;">
       Regards, <br> UHS
    </p>
</div>

