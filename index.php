<!DOCTYPE html>
<html>
<head>
    <title>StudyShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9f2ff);
        }

        .hero {
            text-align: center;
            padding: 60px 20px 30px;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 3rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #555;
            margin-top: 10px;
        }

        .search-box {
            max-width: 600px;
            margin: 30px auto;
        }

        .tagline {
            font-style: italic;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HERO SECTION -->
    <div class="hero">
        <h1>📚 StudyShare</h1>

        <p class="tagline">
            “Knowledge grows when it is shared — learn, upload, and empower others.”
        </p>

        <p>
            A simple space for students to share notes, learn faster, and grow together.
        </p>
    </div>

    <!-- SEARCH BAR -->
    <div class="search-box">
        <form method="GET" class="d-flex shadow-sm">
            <input type="text" name="search" class="form-control form-control-lg" placeholder="Search notes, subjects, topics...">
            <button class="btn btn-primary px-4">Search</button>
        </form>
    </div>

</div>

</body>
</html>