<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
        .info {
            background: #f9f9f9;
            padding: 10px;
            border-left: 5px solid #007BFF;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .message {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Message</h2>
        <p class="info"><strong>Name:</strong> {{ $name }}</p>
        <p class="info"><strong>Phone:</strong> {{ $phone }}</p>
        <p class="info"><strong>Email:</strong> {{ $email }}</p>
        @if(!empty($partner))
        <p class="info"><strong>Partner:</strong> {{ $partner }}</p>
        @endif
        <p><strong>Message:</strong></p>
        <p class="message">{{ $contact_message }}</p>
    </div>
</body>
</html>
