<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update IP</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ff8c00;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            animation: fadeInUp 0.5s ease-in-out; /* Animasi fade in dan slide up */
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            /* Tambahkan warna merah dan bold pada nilai IP */
            color: red;
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3490dc;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2779bd;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Form Alamat IP Internet</h2>
        </div>
        <form action="{{ route('update-ip') }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="ip">ISP Saat Ini:</label>
                <!-- Tambahkan warna merah dan bold pada nilai IP -->
                <input type="text" name="ip" id="ip" value="{{ config('absensi.ip_internet') }}" required style="color: red; font-weight: bold;">
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>

</html>
