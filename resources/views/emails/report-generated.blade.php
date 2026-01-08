<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($template) && $template == 'pref')
        <title>Report with Preference for Verification Team</title>
    @elseif(isset($template) && $template == 'pref_overseas')
        <title>Report with Preference Overseas for Verification Team</title>
    @else
        <title>Report for Verification Team</title>
    @endif
</head>
<body>
    <h4>Please find the report attached to this email for the verification team.</h4>
</body>
</html>