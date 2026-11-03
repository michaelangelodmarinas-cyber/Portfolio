<?php 
include("db.php");
$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Michael Angelo D. Mariñas | Portfolio</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />

 <style>
    /* Added some basic styling for the dynamic project cards */
    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
      padding: 20px 0;
    }
    .project-card {
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .project-card:hover {
      transform: translateY(-5px);
    }
    .project-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .project-info {
      padding: 15px;
    }
    .project-info h3 {
      margin: 0 0 10px;
      color: #333;
    }
    .project-info p {
      font-size: 0.9em;
      color: #666;
      margin-bottom: 10px;
    }
    .project-date {
      font-size: 0.8em;
      color: #999;
    }
    .admin-link {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 1000;
    }
  </style>
</head>
<body>

  <header class="navbar">
    <div class="logo">Portfolio</div>
    <nav>
      <ul>
        <li><a href="#about">About Me</a></li>
        <li><a href="#skills">Skill</a></li>
        <li><a href="#education">Education</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="post.php">post</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h4 class="intro-text">Hi, I am</h4>
      <h1>Michael Angelo D. Mariñas</h1>

      <h2>
        Cybersecurity Analyst<br>
        <span>UI/UX Designer</span>
      </h2>

      <p>
        I am a Cybersecurity Analyst and UI/UX Designer focused on protecting
        digital systems while creating secure, user-friendly interfaces that
        enhance safety, usability, and trust.
      </p>

      <button class="cta" onclick="scrollToContact()">
        LET'S TALK →
      </button>
    </div>

    <div class="hero-image">
      <img src="image/me.png" alt="Hero Image">
      <div class="name-vertical">MICHAEL</div>
    </div>
  </section>

  <section class="services" id="services">
    <h2 class="section-title">My Best Services</h2>
    <div class="services-grid">
      <div class="service-card">
        <i class="service-icon">💻</i>
        <h3>Web Design</h3>
        <p>As a Cybersecurity Analyst and UI/UX Designer, I focus on building visually appealing and functional web designs while implementing best practices to ensure security, usability, and trust.</p>
      </div>
      <div class="service-card">
        <i class="service-icon">👥</i>
        <h3>User Awareness</h3>
        <p>I educate users on cybersecurity awareness, safe digital behavior, and usability best practices, ensuring that security and user experience work hand-in-hand.</p>
      </div>
      <div class="service-card">
        <i class="service-icon">🛡️</i>
        <h3>System & Web Security</h3>
        <p>I secure systems and web applications by implementing robust security measures, vulnerability protection, and secure design principles.</p>
      </div>
      <div class="service-card">
        <i class="service-icon">📷</i>
        <h3>Photography</h3>
        <p>I create visually compelling photography that enhances digital experiences while maintaining data protection and ethical design standards.</p>
      </div>
      <div class="service-card">
        <i class="service-icon">🌐</i>
        <h3>Web Development</h3>
        <p>I develop secure, responsive, and performance-optimized websites where functionality, usability, and cybersecurity meet.</p>
      </div>
      <div class="service-card">
        <i class="service-icon">📊</i>
        <h3>Monitoring</h3>
        <p>I provide continuous monitoring of systems and interfaces to detect vulnerabilities, threats, and usability issues in real time.</p>
      </div>
    </div>
  </section>

  <section class="timeline-section" id="experience-education">
    <div class="timeline-container">
      <div class="timeline-column">
        <h2 class="timeline-title">My Experience</h2>
        <div class="timeline-card">
          <span class="year">2024 – Present</span>
          <h3>Cybersecurity Analyst</h3>
          <p>Makati City</p>
        </div>
        <div class="timeline-card">
          <span class="year">2020 – 2023</span>
          <h3>UI Designer</h3>
          <p>Pasay City</p>
        </div>
        <div class="timeline-card">
          <span class="year">2018 – 2019</span>
          <h3>UX Designer</h3>
          <p>Quezon City</p>
        </div>
      </div>

      <div class="timeline-column" id="education">
        <h2 class="timeline-title">My Education</h2>
        <div class="timeline-card">
          <span class="year">2014 – 2017</span>
          <h3>Cybersecurity Courses</h3>
          <p>Makati City</p>
        </div>
        <div class="timeline-card">
          <span class="year">2014 – 2017</span>
          <h3>UI/UX Courses</h3>
          <p>Pasay City</p>
        </div>
        <div class="timeline-card">
          <span class="year">2021 – 2022</span>
          <h3>Web Developer Courses</h3>
          <p>Quezon City</p>
        </div>
      </div>
    </div>
  </section>

  <section class="projects-section" id="projects">
    <div class="projects-header">
      <span class="projects-badge">Projects</span>
    </div>

    <div class="projects-grid">
      <?php if (count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
          <div class="project-card">
            <?php if (!empty($post['image_path'])): ?>
              <img src="<?= htmlspecialchars($post['image_path']); ?>" alt="<?= htmlspecialchars($post['title']); ?>">
            <?php else: ?>
              <img src="image/placeholder.png" alt="No image">
            <?php endif; ?>
            <div class="project-info">
              <h3><?= htmlspecialchars($post['title']); ?></h3>
              <p><?= htmlspecialchars($post['description']); ?></p>
              <span class="project-date">Completed on: <?= htmlspecialchars($post['date']); ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No projects added yet.</p>
      <?php endif; ?>
    </div>
  </section>

  <section class="about-section" id="about">
    <div class="about-container">
      <div class="about-image">
        <img src="image/me.png" alt="Michael Angelo">
        <div class="dots"></div>
      </div>
      <div class="about-content">
        <h2>About me</h2>
        <p>
          I am a Cybersecurity Analyst and UI/UX Designer passionate about creating
          secure, user-friendly digital experiences. I specialize in protecting
          systems and websites from cyber threats, promoting user awareness, and
          developing intuitive interfaces that enhance usability and engagement.
        </p>
        <a href="cv.pdf" class="btn-cv" download>Download CV</a>
      </div>
    </div>
    <div class="about-cta">
      <div class="avatar">M</div>
      <h3>Let’s Talk with Me!</h3>
      <p>I am always open to discuss your project, improve your online presence, or help with your UI/UX design and Cybersecurity Analyst needs.</p>
    </div>
  </section>

  <section class="skills-section" id="skills">
    <div class="skills-header">
      <span class="skills-badge">Skills</span>
      <p class="skills-desc">We transform your vision into bespoke web experiences that captivate your brand and inspire your customers.</p>
    </div>
    <div class="skills-grid">
      <div class="skill-card"><div class="skill-icon">🎨</div><h4>91%</h4><p>Figma</p></div>
      <div class="skill-card"><div class="skill-icon">🔍</div><h4>90%</h4><p>Sketch</p></div>
      <div class="skill-card"><div class="skill-icon">📝</div><h4>92%</h4><p>WordPress</p></div>
      <div class="skill-card"><div class="skill-icon">⚛️</div><h4>85%</h4><p>React</p></div>
      <div class="skill-card"><div class="skill-icon">💻</div><h4>80%</h4><p>JavaScript</p></div>
    </div>
  </section>

  <section class="contact-section" id="contact">
    <div class="contact-header">
      <span class="contact-badge">Contact</span>
    </div>
    <div class="contact-container">
      <div class="contact-form">
        <h3>Let’s work together!</h3>
        <p>Contact me if you are interested. Thank you.</p>
        <form onsubmit="sendMessage(event)">
          <div class="form-row">
            <input type="text" placeholder="First name" required>
            <input type="text" placeholder="Last name" required>
          </div>
          <div class="form-row">
            <input type="email" placeholder="Email address" required>
            <input type="tel" placeholder="Phone number">
          </div>
          <textarea placeholder="Message" required></textarea>
          <button type="submit">Send Message →</button>
        </form>
      </div>
      <div class="contact-info">
        <div class="info-item"><span class="icon">📞</span><div><h4>Phone</h4><p>09624906903</p></div></div>
        <div class="info-item"><span class="icon">✉️</span><div><h4>Email</h4><p>michaelangelomarinas@gmail.com</p></div></div>
        <div class="info-item"><span class="icon">📍</span><div><h4>Address</h4><p>Amanacao, Mapandan Pangasinan<br>2429, Philippines</p></div></div>
      </div>
    </div>
    <footer class="contact-footer">
      <span>© 2026 All rights reserved.</span>
      <div><a href="#">Terms of Use</a><a href="#">Privacy Policy</a></div>
    </footer>
  </section>

  <!-- Admin link to manage posts -->
  <a href="admin.php" class="admin-link">Manage Projects</a>

  <script src="script.js"></script>
</body>
</html>
