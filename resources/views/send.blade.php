<!-- resources/views/backend/send-message.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
</head>
<body>
    <div>
        <h2>Send Message</h2>
        <form action="{{ route('test.message') }}" method="POST">
            @csrf
            <!-- <div>
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" placeholder="Enter phone number" required>
            </div> -->
            <div>
                <label for="message">Message:</label>
                <textarea id="body" name="body" placeholder="Enter your message" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
        <div id="responseMessage"></div>
    </div>
</body>
</html>
