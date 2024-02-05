<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @component('mail::message')
# Contact Inquiry Reply

Thank you for contacting us. Here is our reply:

@component('mail::panel')
{!! $reply !!}
@endcomponent

If you have any further questions, feel free to reach out.

Thank you,
The StarMotors Team
@endcomponent
</body>
</html>