<div style="font-family: sans-serif; background-color: #f0f0f0;">

<div style="padding: 1cm; font-family: sans-serif; background-color: #f0f0f0;">
    <p style="text-align: justify; font-weight: bold;"><span style="font-weight: bold;color: red;">Important Note:</span>The candidate shall not be able to add program choices once application
        processing fee is submitted as per system-generated challan</p>
    <div style="text-align: center; border: 2px solid #000; padding: 10px; background-color: #f0f0f0; font-size: large; font-weight: bold;">
        <table style="width: 100%; border-collapse: collapse;">
            
            <tr>
                <td style="text-align: center;">
                    <img style="width: 50px; height: 50px" class="profile"
                         src="images/login.png" alt="placeholder image">
                </td>

                <td style="text-align: center; font-weight: bold;">Depositor Receipt (Applicant Copy)</td>

                <td style="text-align: center;">
                    <img style="width: 50px; height: 50px" class="profile"
                         src="images/bop.jpeg" alt="placeholder image">
                </td>
            </tr>
        </table>

        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));  margin-top: 10px;">
            <div style="font-size: small; text-align: left; font-weight: bold;">Challan ID: {{ $challanId }} </div>
            <div style="font-size: small; text-align: left; font-weight: bold;">CNIC No: {{ $cnic }}</div>
            <div style="font-size: small; text-align: left; font-weight: bold;">Name: {{ $name }}</div>
            <div style="font-size: small; text-align: left; font-weight: bold;">Father Name: {{ $fatherName }}</div>
           <div style="font-size: small; text-align: right; font-weight: bold; margin-top: 10px;">Date: {{ now()->format('d-m-Y') }}</div>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            @if($programId === 1 || $programId === 2)
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">Application Fee</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">2000.00</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">Bank Service Charges</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">82.00</td>
            </tr>
            @endif
             @if($programId === 3)   
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">MBBS</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">2000.00</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">BDS</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">2000.00</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">Bank Service Charges</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">82.00</td>
            </tr>

            @endif
           
        </table>
        @if($programId === 1 || $programId === 2)
        <div style="text-align: right; font-size: large; font-weight: bold; margin-top: 15px;">Total Amount: Rs 2082/-</div>
        <div style="border: 2px solid #000; padding: 10px; background-color: #f0f0f0; font-size: small; font-weight: bold; margin-top: 10px;">Amount In Words: <span style="text-decoration: underline;">Two Thousand and Eighty Two Rupees Only.</span></div>
        @endif
        @if($programId === 3)
        <div style="text-align: right; font-size: large; font-weight: bold; margin-top: 15px;">Total Amount: Rs 4082/-</div>
        <div style="border: 2px solid #000; padding: 10px; background-color: #f0f0f0; font-size: small; font-weight: bold; margin-top: 10px;">Amount In Words: <span style="text-decoration: underline;">Four Thousand and Eighty Two Rupees Only.</span></div>
        @endif
        <div style="display: flex; width: 100%; justify-content: space-between; margin-top: 20px; font-size: small; font-weight: bold;">
            <div style="text-align: left; width: 48%;">______________________<br>Applicant Signature</div>
            <div style="text-align: right; width: 100%; margin-top:-100px">______________________<br>Depositor Signature</div>
        </div>
    </div>
</div>
<!-- Bank Copy -->
<div style="padding: 1cm; font-family: sans-serif; background-color: #f0f0f0; margin-top: -10px;">
    <div style=" text-align: center; border: 2px solid #000; padding: 10px; background-color: #f0f0f0; font-size: large; font-weight: bold;">

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="text-align: center;">
                    <img style="width: 50px; height: 50px" class="profile"
                         src="images/login.png" alt="placeholder image">
                </td>

                <td style="text-align: center; font-weight: bold;">Depositor Receipt (Bank Copy)</td>

                <td style="text-align: center;">
                    <img style="width: 50px; height: 50px" class="profile"
                         src="images/bop.jpeg" alt="placeholder image">
                </td>
            </tr>
        </table>

        <div style="margin-top: 10px; display: flex; width: 100%; justify-content: space-between;">
            <div style="font-size: small; text-align: left; font-weight: bold;">Challan ID: {{ $challanId }}</div>
            <div style="font-size: small; text-align: left; font-weight: bold; ">CNIC No: {{ $cnic }}</div>
            <div style="font-size: small; text-align: left; font-weight: bold; ">Name: {{ $name }}</div>
            <div style="font-size: small; text-align: left; font-weight: bold; ">Father Name: {{ $fatherName }}</div>
            <div style="font-size: small; text-align: right; font-weight: bold; ">Date: {{ now()->format('d-m-Y') }}</div>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            @if($programId === 1 || $programId === 2)
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">Application Fee</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">2000.00</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">Bank Service Charges</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">82.00</td>
            </tr>
            @endif
             @if($programId === 3)   
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">MBBS</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">2000.00</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">BDS</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">2000.00</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">Bank Service Charges</td>
                <td style="border: 1px solid #000; padding: 5px; font-size: small;">82.00</td>
            </tr>
            @endif
           
        </table>
        @if($programId === 1 || $programId === 2)
        <div style="text-align: right; font-size: large; font-weight: bold; margin-top: 15px;">Total Amount: Rs 2082/-</div>
        <div style="border: 2px solid #000; padding: 10px; background-color: #f0f0f0; font-size: small; font-weight: bold; margin-top: 10px;">Amount In Words: <span style="text-decoration: underline;">Two Thousand and Eighty Two Rupees Only.</span></div>
        @endif
        @if($programId === 3)
        <div style="text-align: right; font-size: large; font-weight: bold; margin-top: 15px;">Total Amount: Rs 4082/-</div>
        <div style="border: 2px solid #000; padding: 10px; background-color: #f0f0f0; font-size: small; font-weight: bold; margin-top: 10px;">Amount In Words: <span style="text-decoration: underline;">Four Thousand and Eighty Two Rupees Only.</span></div>
        @endif
        <div style="display: flex; width: 100%; justify-content: space-between; margin-top: 20px; font-size: small; font-weight: bold;">
            <div style="text-align: left; width: 48%;">______________________<br>Applicant Signature</div>
            <div style="text-align: right; width: 100%; margin-top:-100px">______________________<br>Depositor Signature</div>
        </div>
    </div>
</div>
</div>
