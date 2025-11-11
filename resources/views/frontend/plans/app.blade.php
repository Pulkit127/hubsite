<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade Plan - HUB</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: "Poppins", sans-serif;
        }

        h1,
        h3,
        h4,
        h5 {
            color: #f1c40f;
        }

        .plan-card {
            background-color: #1e1e1e;
            border: 2px solid #f1c40f;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px #f1c40f33;
        }

        .plan-card h5 {
            margin-bottom: 10px;
        }

        .plan-card p {
            color: #ccc;
            margin-bottom: 8px;
        }

        .btn-upgrade {
            background-color: #f1c40f;
            color: #121212;
            font-weight: 600;
            border: none;
            transition: background 0.3s;
        }

        .btn-upgrade:hover {
            background-color: #d4ac0d;
        }

        @media (max-width: 576px) {
            .plan-card {
                text-align: center;
            }
        }

        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>