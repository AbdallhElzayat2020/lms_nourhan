<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Unavailable - 503</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .error-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 60px 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .error-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6c5ce7, #a29bfe, #fd79a8, #fdcb6e);
            background-size: 400% 400%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .error-number {
            font-size: 8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 20px;
            animation: blink 2s infinite;
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0.5; }
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 15px;
        }

        .error-subtitle {
            font-size: 1.2rem;
            color: #718096;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .error-description {
            color: #a0aec0;
            margin-bottom: 40px;
            font-size: 1rem;
            line-height: 1.7;
        }

        .maintenance-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: spin 3s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .maintenance-icon svg {
            width: 40px;
            height: 40px;
            color: white;
        }

        .btn-home {
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            border: none;
            color: white;
            padding: 15px 35px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
            color: white;
        }

        .btn-back {
            background: transparent;
            border: 2px solid #e2e8f0;
            color: #4a5568;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .btn-back:hover {
            border-color: #6c5ce7;
            color: #6c5ce7;
            transform: translateY(-1px);
        }

        .btn-refresh {
            background: transparent;
            border: 2px solid #6c5ce7;
            color: #6c5ce7;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-left: 15px;
        }

        .btn-refresh:hover {
            background: #6c5ce7;
            color: white;
            transform: translateY(-1px);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .icon {
            width: 24px;
            height: 24px;
        }

        @media (max-width: 768px) {
            .error-container {
                padding: 40px 30px;
                margin: 20px;
            }

            .error-number {
                font-size: 6rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-subtitle {
                font-size: 1.1rem;
            }

            .btn-home, .btn-back, .btn-refresh {
                width: 100%;
                margin: 10px 0;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="floating-shapes">
            <div class="shape">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <circle cx="30" cy="30" r="30" fill="currentColor"/>
                </svg>
            </div>
            <div class="shape">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <rect width="40" height="40" rx="8" fill="currentColor"/>
                </svg>
            </div>
            <div class="shape">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none">
                    <polygon points="25,5 45,40 5,40" fill="currentColor"/>
                </svg>
            </div>
        </div>

        <div class="maintenance-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>

        <div class="error-number">503</div>
        <h1 class="error-title">Service Unavailable</h1>
        <p class="error-subtitle">We're currently performing maintenance on our servers.</p>
        <p class="error-description">
            Our website is temporarily unavailable due to scheduled maintenance. We're working hard to improve your experience
            and will be back online shortly. Thank you for your patience!
        </p>

        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
            <a href="javascript:history.back()" class="btn-back">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Go Back
            </a>
            <a href="{{ route('frontend.home') }}" class="btn-home">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Back to Home
            </a>
            <a href="javascript:location.reload()" class="btn-refresh">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Try Again
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
