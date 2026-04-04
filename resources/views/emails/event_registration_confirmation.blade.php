<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Registration Confirmation</title>
</head>
<body>
    <h2>Thank you for registering!</h2>
    <p>Hello {{ $registration->user->name }},</p>
    <p>You have successfully registered for the event: <strong>{{ $registration->event->title }}</strong>.</p>
    <p>Event Date: {{ $registration->event->date ?? 'TBA' }}</p>
    <p>We look forward to seeing you there!</p>
    <br>
    <p>Best regards,<br>Event Management Team</p>
</body>
</html>
