<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eLECTRA - Sistem Pembayaran Listrik Pintar</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ----- PENGATURAN DASAR & GLOBAL ----- */
    * { box-sizing: border-box; }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, #1d2b64, #f8cdda, #232526, #414345);
      background-size: 400% 400%;
      animation: gradientBG 18s ease-in-out infinite;
      overflow: hidden;
    }

    /* ----- ANIMASI KEYFRAMES ----- */
    @keyframes gradientBG {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    @keyframes twinkle {
      from { opacity: 0.5; }
      to   { opacity: 1; }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }


    /* ----- ELEMEN Latar Belakang Bintang ----- */
    .stars {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      z-index: 0;
      pointer-events: none;
    }

    .star {
      position: absolute;
      background: white;
      border-radius: 50%;
      animation: twinkle 2s infinite alternate;
    }

    /* ----- KONTEN UTAMA ----- */
    .center-content {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      z-index: 1;
      position: relative;
    }

    .magic-box {
      display: flex;
      align-items: center;
      gap: 80px;
      background: rgba(30, 30, 40, 0.85); 
      box-shadow: 0 8px 32px rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(16px);
      border-radius: 24px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 35px 60px;
      color: white;
      text-align: left;
      animation: fadeInUp 1.5s ease-in-out;
      max-width: 90vw;
    }

    /* ----- LOGO & EFEKNYA ----- */
    .logo-glow {
      width: 240px;
      height: 240px;
      border-radius: 50%;
      background: radial-gradient(circle at center, #f8cdda 0%, #0f1b29 80%);
      box-shadow:
        0 0 20px #f8cdda,
        0 0 40px #f8cdda,
        0 0 60px #f8cdda,
        0 0 100px rgba(248, 205, 218, 0.65);
      /* PERUBAHAN: Animasi putaran dihapus dari sini untuk membuat logo statis. */
      display: flex;
      align-items: center;
      justify-content: center;
      transition: box-shadow 0.5s ease; /* Transisi halus jika ada perubahan di masa depan */
    }

    .logo-glow img {
      width: 140px;
      height: 140px;
      object-fit: contain;
      filter: drop-shadow(0 0 8px #f8cdda);
      z-index: 2;
    }

    /* ----- TEKS & TOMBOL ----- */
    .magic-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #ffffff;
      /* PERUBAHAN: Efek bayangan teks disederhanakan agar lebih bersih dan mudah dibaca. */
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      margin-bottom: 12px;
    }

    .magic-desc {
      font-size: 1.1rem;
      line-height: 1.6;
      color: #e0e0e0; /* Sedikit menggelapkan warna teks untuk kontras yang lebih baik */
      margin-bottom: 20px;
      /* PERUBAHAN: Efek bayangan teks dihapus untuk kejelasan maksimal. */
      text-shadow: none;
      animation: fadeIn 2s ease-out forwards;
    }
    
    .btn-custom {
      font-size: 1rem;
      font-weight: bold;
      padding: 10px 30px;
      border-radius: 30px;
      margin-right: 10px;
      box-shadow: 0 2px 16px rgba(248, 205, 218, 0.4), 0 0 8px rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      transform: scale(1.07);
      box-shadow: 0 4px 32px rgba(248, 205, 218, 0.6);
    }

    .magic-footer {
      font-size: 0.9rem;
      color: #eeeeee;
      opacity: 0.75;
      margin-top: 20px;
    }

    /* ----- DESAIN RESPONSIVE ----- */
    @media (max-width: 992px) {
      .magic-box {
        flex-direction: column;
        text-align: center;
        padding: 40px 20px;
        gap: 30px;
      }

      .logo-glow {
        width: 160px;
        height: 160px;
      }

      .logo-glow img {
        width: 80px;
        height: 80px;
      }
    }
  </style>
</head>
<body>
  <div class="stars" id="stars"></div>

  <div class="center-content">
    <div class="magic-box">
      
      <div class="logo-glow">
        <img src="{{ asset('images/Electra.png') }}" alt="Logo eLECTRA" />
      </div>

      <div>
        <div class="magic-title">Sistem Pembayaran Listrik Pintar</div>
        <div class="magic-desc">
          Selamat datang di <strong>eLECTRA</strong>.<br />
          <span style="color: #fff; font-weight: 600;">
            Portal pembayaran listrik pascabayar yang mengubah cara Anda melihat tagihan menjadi pengalaman magis.
          </span>
          <br /><br />
          Dengan teknologi modern, keamanan tinggi, dan tampilan menakjubkan, <strong>eLECTRA</strong> hadir memudahkan hidup Anda.<br />
          <em>Keajaiban kini hadir di genggaman Anda.</em>
        </div>

        <div>
          <a href="{{ route('login') }}" class="btn btn-primary btn-custom">Masuk</a>
          <a href="{{ route('register') }}" class="btn btn-outline-light btn-custom">Daftar</a>
        </div>
        
        <div class="magic-footer">
          Powered by eLECTRA &mdash; <span style="color:#f8cdda;">Membawa Keajaiban ke Setiap Rumah</span>
        </div>
      </div>

    </div>
  </div>

  <script>
    const starCount = 80;
    const stars = document.getElementById('stars');

    for (let i = 0; i < starCount; i++) {
      const s = document.createElement('div');
      s.className = 'star';
      
      s.style.top = `${Math.random() * 100}vh`;
      s.style.left = `${Math.random() * 100}vw`;
      
      const size = (Math.random() * 2 + 1);
      s.style.width = `${size}px`;
      s.style.height = `${size}px`;
      
      s.style.animationDuration = `${1.5 + Math.random() * 2}s`;
      s.style.opacity = 0.5 + Math.random() * 0.5;
      
      stars.appendChild(s);
    }
  </script>
</body>
</html>