<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - PAVS Clinic</title>
    <link rel="shortcut icon" href="{{ asset('asset/cutienobg.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #36b9cc;
            --accent-color: #f6c23e;
            --light-bg: #f8f9fc;
            --dark-text: #2e3a59;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark-text);
        }
        
        .header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .logo-container img {
            max-width: 180px;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }
        
        .page-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .back-btn {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .section-title {
            position: relative;
            font-weight: 700;
            margin: 2rem 0 1.5rem;
            padding-bottom: 0.5rem;
            color: var(--primary-color);
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }
        
        .section-subtitle {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 2rem;
            color: var(--dark-text);
        }
        
        .animal-card, .service-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            height: 100%;
            background: white;
        }
        
        .animal-card:hover, .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }
        
        .animal-card .card-img-top {
            height: 220px;
            object-fit: cover;
        }
        
        .animal-card .card-body {
            padding: 1.5rem;
        }
        
        .animal-card .card-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.75rem;
            font-size: 1.25rem;
        }
        
        .animal-card .card-text {
            color: #5a5c69;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .service-card {
            border-left: 4px solid var(--secondary-color);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }
        
        .service-card .card-title {
            display: flex;
            align-items: center;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .service-card .card-title i {
            background: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        .service-card .card-text {
            color: #5a5c69;
            font-size: 0.95rem;
            line-height: 1.6;
            flex-grow: 1;
        }
        
        .feature-banner {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 15px;
            padding: 2rem;
            margin: 3rem 0;
            color: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .feature-banner h3 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .feature-banner p {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .contact-btn {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s;
            display: block;
            margin: 0 auto;
            width: fit-content;
        }
        
        .contact-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        
        footer {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2.5rem 0;
            margin-top: 4rem;
        }
        
        .footer-content {
            text-align: center;
            font-size: 1.1rem;
        }
        
        .footer-content a {
            color: var(--accent-color);
            font-weight: 600;
            text-decoration: none;
        }
        
        .footer-content a:hover {
            text-decoration: underline;
        }
        
        .animal-section, .service-section {
            padding: 3rem 0;
        }
        
        .animal-section {
            background: var(--light-bg);
        }
        
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        @media (max-width: 768px) {
            .animal-card, .service-card {
                margin-bottom: 1.5rem;
            }
            
            .section-title {
                text-align: center;
            }
            
            .section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('asset/cutienobg.png') }}" alt="PAVS Clinic Logo">
            </div>
            <h1 class="page-title animate__animated animate__fadeIn">Welcome to PAVS Clinic Services</h1>
            <div class="text-center">
                <a href="{{route('auth.login')}}" class="btn back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Back to Login
                </a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Animals Section -->
        <section class="animal-section">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title animate__animated animate__fadeIn">We Care For</h2>
                    <p class="section-subtitle animate__animated animate__fadeIn">We extend our pet healthcare to certain groups of animals with specialized services tailored to their unique needs.</p>
                    
                    <div class="row">
                        <!-- Dog Card -->
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="animal-card animate-on-scroll">
                                <img src="{{asset('imgs/dog.jpg')}}" class="card-img-top" alt="Dog">
                                <div class="card-body">
                                    <h5 class="card-title">Dogs</h5>
                                    <p class="card-text">
                                        Loyal companions with specific healthcare needs. Our services ensure they receive proper treatments to maintain their health and vitality.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cat Card -->
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="animal-card animate-on-scroll">
                                <img src="{{asset('imgs/cat - Copy.jpg')}}" class="card-img-top" alt="Cat">
                                <div class="card-body">
                                    <h5 class="card-title">Cats</h5>
                                    <p class="card-text">
                                        Independent yet affectionate, cats require specialized care. We provide vaccinations and treatments for common feline diseases.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cow Card -->
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="animal-card animate-on-scroll">
                                <img src="{{asset('imgs/cow.jpg')}}" class="card-img-top" alt="Cow">
                                <div class="card-body">
                                    <h5 class="card-title">Cows</h5>
                                    <p class="card-text">
                                        Gentle herbivores that benefit from our specialized care including reproductive services and disease prevention programs.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Goat Card -->
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="animal-card animate-on-scroll">
                                <img src="{{asset('imgs/goat.jpg')}}" class="card-img-top" alt="Goat">
                                <div class="card-body">
                                    <h5 class="card-title">Goats</h5>
                                    <p class="card-text">
                                        Curious and intelligent animals that thrive with our comprehensive healthcare including parasite control and nutritional guidance.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Services Section -->
        <section class="service-section">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title animate__animated animate__fadeIn">Our Services</h2>
                    <p class="section-subtitle animate__animated animate__fadeIn">Comprehensive veterinary care designed to keep your pets healthy and happy</p>
                    
                    <div class="row">
                        <!-- Consultation -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-stethoscope"></i>Consultation
                                </h5>
                                <p class="card-text">
                                    Expert advice and personalized treatment plans for your pet's health needs. Our veterinarians provide thorough examinations and diagnosis.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Laboratory -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-microscope"></i>Laboratory & Tests
                                </h5>
                                <p class="card-text">
                                    Advanced diagnostic tests to accurately assess your pet's health. We offer blood work, urinalysis, and imaging services.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Admission -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-procedures"></i>Admission
                                </h5>
                                <p class="card-text">
                                    Comfortable facilities providing a safe, stress-free environment for your pet's extended care and recovery.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Vaccination -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-syringe"></i>Vaccination
                                </h5>
                                <p class="card-text">
                                    Essential immunizations to protect your pet from diseases. Customized vaccine schedules for all life stages.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Deworming -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-bug"></i>Deworming
                                </h5>
                                <p class="card-text">
                                    Effective treatments to eliminate internal parasites and keep your pet healthy. Regular deworming prevents serious health issues.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Surgery -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-scalpel"></i>Surgery
                                </h5>
                                <p class="card-text">
                                    Routine and specialized surgical procedures performed with utmost care and expertise using modern techniques.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Grooming -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-spa"></i>Grooming
                                </h5>
                                <p class="card-text">
                                    Professional grooming services for a clean, healthy, and happy pet. Includes bathing, haircuts, and nail trimming.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Dental -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-tooth"></i>Dental Care
                                </h5>
                                <p class="card-text">
                                    Comprehensive dental services including cleanings, extractions, and oral health assessments.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Emergency -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="service-card animate-on-scroll">
                                <h5 class="card-title">
                                    <i class="fas fa-ambulance"></i>Emergency Care
                                </h5>
                                <p class="card-text">
                                    24/7 emergency services for critical situations. Our team is ready to provide immediate care when your pet needs it most.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Contact Banner -->
        <div class="feature-banner animate__animated animate__pulse">
            <h3>Ready to Schedule an Appointment?</h3>
            <p>Wanna avail our services? Contact us today to book your pet's next visit!</p>
            <a href="mailto:pavsclinic@gmail.com" class="contact-btn">
                <i class="fas fa-envelope me-2"></i>pavsclinic@gmail.com
            </a>
        </div>
    </div>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>© 2023 PAVS Clinic. All rights reserved.</p>
                <p>Book an appointment if you are already a member. New clients are always welcome!</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>