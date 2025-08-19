<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .maintenance-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .maintenance-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            margin: 2rem;
        }
        .maintenance-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: pulse 2s infinite;
        }
        .maintenance-icon i {
            font-size: 3rem;
            color: white;
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }
        .maintenance-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .maintenance-text {
            color: #5a6c7d;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .contact-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        .progress-container {
            margin-top: 2rem;
        }
        .progress {
            height: 8px;
            border-radius: 10px;
            background-color: #e9ecef;
            overflow: hidden;
        }
        .progress-bar {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            animation: progress 3s ease-in-out infinite;
        }
        @keyframes progress {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 0%; }
        }
        .social-links {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
        }
        .social-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            border-color: transparent;
        }
        @media (max-width: 768px) {
            .maintenance-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            .maintenance-icon {
                width: 100px;
                height: 100px;
            }
            .maintenance-icon i {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid maintenance-container">
        <div class="maintenance-card text-center">
            <div class="maintenance-icon">
                <i class="bi bi-gear-fill"></i>
            </div>
            
            <h1 class="maintenance-title">We'll be back soon!</h1>
            
            <p class="maintenance-text">
                We're currently performing scheduled maintenance to improve your experience. 
                Our team is working hard to get everything back online as quickly as possible.
            </p>
            
            <div class="progress-container">
                <div class="progress">
                    <div class="progress-bar" role="progressbar"></div>
                </div>
                <small class="text-muted mt-2 d-block">Maintenance in progress...</small>
            </div>
            
            <div class="mt-4">
                <a href="mailto:contact@example.com" class="contact-btn">
                    <i class="bi bi-envelope-fill"></i>
                    Contact Support
                </a>
            </div>
            
            <div class="social-links">
                <a href="#" class="social-link" title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="social-link" title="Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="social-link" title="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="#" class="social-link" title="LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>
            
            <p class="text-muted mt-4 mb-0">
                <small>&mdash; The Development Team</small>
            </p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>