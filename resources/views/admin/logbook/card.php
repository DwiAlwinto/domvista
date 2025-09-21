<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibrant Book Card</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .book-card {
            max-width: 320px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            position: relative;
            margin: 25px auto;
            border: none;
        }
        
        .book-card:hover {
            transform: translateY(-15px) rotate(2deg);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }
        
        .book-cover {
            height: 220px;
            background: linear-gradient(135deg, #e63946 0%, #d90429 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
            border-bottom: 8px solid #2b9348;
        }
        
        .book-cover::before {
            content: "";
            position: absolute;
            top: 0;
            left: 15px;
            width: 25px;
            height: 100%;
            background: rgba(255,255,255,0.15);
            transform: skewX(-15deg);
            filter: blur(2px);
        }
        
        .book-title-cover {
            font-family: 'Palatino', serif;
            font-weight: 800;
            text-align: center;
            padding: 0 20px;
            font-size: 1.8rem;
            line-height: 1.3;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            transform: rotate(-3deg);
        }
        
        .book-author {
            color: #2b9348;
            font-weight: 600;
            text-align: center;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .book-details {
            padding: 25px;
            background: linear-gradient(to bottom, #ffffff 0%, #f8f9fa 100%);
        }
        
        .book-title {
            font-family: 'Georgia', serif;
            font-weight: bold;
            color: #d90429;
            margin-bottom: 5px;
            font-size: 1.6rem;
        }
        
        .book-description {
            color: #495057;
            margin-bottom: 20px;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .book-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .book-meta-item {
            display: flex;
            align-items: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .book-meta-item i {
            margin-right: 8px;
            color: #2b9348;
            font-size: 1.1rem;
        }
        
        .book-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #2b9348;
            color: white;
            border-radius: 30px;
            padding: 5px 15px;
            font-weight: bold;
            font-size: 0.8rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .book-spine {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 18px;
            background: linear-gradient(to bottom, #d90429, #a4161a);
            border-right: 2px solid rgba(0,0,0,0.1);
        }
        
        .btn-book {
            background: linear-gradient(135deg, #2b9348 0%, #007f5f 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(43, 147, 72, 0.3);
        }
        
        .btn-book:hover {
            background: linear-gradient(135deg, #007f5f 0%, #2b9348 100%);
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(43, 147, 72, 0.4);
            color: white;
        }
        
        .rating {
            color: #ffd700;
            font-size: 1.1rem;
            text-align: center;
            margin: 15px 0;
        }
        
        .book-pages {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: rgba(255,255,255,0.7);
            font-size: 0.7rem;
            font-style: italic;
        }
        
        .corner-ribbon {
            width: 150px;
            background: #2b9348;
            position: absolute;
            top: 25px;
            left: -50px;
            text-align: center;
            line-height: 30px;
            letter-spacing: 1px;
            color: white;
            transform: rotate(-45deg);
            font-weight: bold;
            font-size: 0.8rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="book-card">
                    <div class="corner-ribbon">Bestseller</div>
                    <div class="book-spine"></div>
                    <div class="book-badge">Limited</div>
                    <div class="book-cover">
                        <h3 class="book-title-cover">Creative<br>Journey</h3>
                        <span class="book-pages">320 pages</span>
                    </div>
                    <div class="book-details">
                        <h4 class="book-title">Creative Journey</h4>
                        <p class="book-author">By Alex Greenfield</p>
                        
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span style="color: #6c757d; font-size: 0.8rem;"> (128 reviews)</span>
                        </div>
                        
                        <p class="book-description">
                            Embark on an extraordinary adventure through the landscapes of creativity. This book reveals powerful techniques to unlock your imagination and transform ideas into reality.
                        </p>
                        
                        <div class="book-meta">
                            <span class="book-meta-item">
                                <i class="fas fa-calendar-alt"></i> 2023
                            </span>
                            <span class="book-meta-item">
                                <i class="fas fa-tags"></i> Creativity
                            </span>
                            <span class="book-meta-item">
                                <i class="fas fa-book"></i> 320p
                            </span>
                        </div>
                        
                        <button class="btn btn-book">
                            <i class="fas fa-cart-plus me-2"></i>Add to Cart - $24.99
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>