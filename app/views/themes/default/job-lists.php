<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Description Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
        }
        .page-header {
            background-image: url('images/job-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            text-align: center;
            color: white;
            position: relative;
        }
        .page-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .page-header h1 {
            position: relative;
            z-index: 2;
            font-size: 3rem;
            font-weight: bold;
        }
        .page-header p {
            position: relative;
            z-index: 2;
            font-size: 1.2rem;
        }
        .job-details {
            padding: 50px 15px;
        }
        .job-section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }
        .job-info {
            margin-bottom: 40px;
        }
        .job-info p {
            font-size: 1rem;
            color: #555;
            line-height: 1.8;
        }
        .requirements {
            margin-bottom: 40px;
        }
        .requirements ul {
            list-style: none;
            padding: 0;
        }
        .requirements ul li {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #555;
            display: flex;
            align-items: center;
        }
        .requirements ul li i {
            margin-right: 10px;
            color: #27ae60;
        }
        .apply-button {
            text-align: center;
            margin-top: 20px;
        }
        .apply-button a {
            padding: 12px 30px;
            font-size: 1rem;
            color: white;
            background-color: #27ae60;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .apply-button a:hover {
            background-color: #219150;
        }
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: #333;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            font-size: 1.5rem;
            display: none;
        }
        .scroll-top.show {
            display: flex;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <header class="page-header">
        <h1>Senior Frontend Developer</h1>
        <p>Join our team and create amazing digital experiences.</p>
    </header>

    <!-- Job Details Section -->
    <section class="job-details container">
        <div class="job-info">
            <h2 class="job-section-title">Job Description</h2>
            <p>As a Senior Frontend Developer, you will be responsible for creating user-friendly web interfaces that deliver exceptional user experiences. You will collaborate with cross-functional teams to design, develop, and optimize websites and applications using modern tools and technologies.</p>
        </div>

        <div class="requirements">
            <h2 class="job-section-title">Requirements and Skills</h2>
            <ul>
                <li><i class="fas fa-check"></i> Proficient in HTML, CSS, and JavaScript.</li>
                <li><i class="fas fa-check"></i> Experience with modern JavaScript frameworks (React, Angular, or Vue.js).</li>
                <li><i class="fas fa-check"></i> Strong understanding of responsive design principles.</li>
                <li><i class="fas fa-check"></i> Familiarity with version control systems like Git.</li>
                <li><i class="fas fa-check"></i> Excellent problem-solving skills and attention to detail.</li>
            </ul>
        </div>

        <div class="job-info">
            <h2 class="job-section-title">Key Details</h2>
            <ul>
                <li><strong>Location:</strong> Remote or On-site (Flexible)</li>
                <li><strong>Salary:</strong> $70,000 - $90,000 per year</li>
                <li><strong>Experience:</strong> Minimum 3 years in a similar role</li>
            </ul>
        </div>

        <div class="apply-button">
            <a href="#">Apply Now</a>
        </div>
    </section>

    <!-- Scroll to Top -->
    <a href="#top" class="scroll-top"><i class="fas fa-chevron-up"></i></a>

    <script>
        // Scroll to Top Button
        const scrollTopBtn = document.querySelector('.scroll-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
    </script>
</body>
</html>
