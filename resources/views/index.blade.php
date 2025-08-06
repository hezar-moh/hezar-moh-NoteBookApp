<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome to NoteKeep</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to right, #f2f2f2, #e6f0ff);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      color: #333;
    }

    .container {
      text-align: center;
      padding: 2rem;
      background: white;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      border-radius: 12px;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    p {
      font-size: 1.2rem;
      color: #555;
    }

    .start-btn {
      margin-top: 2rem;
      padding: 12px 24px;
      background-color: #4f46e5;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .start-btn:hover {
      background-color: #3730a3;
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }

      .start-btn {
        padding: 10px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to NoteKeeping App</h1>
    <p>Your Simple and Easy note-taking solution.</p>

    {{-- Button that links to the notes index route --}}
    <a href="/showRegister">
      <button class="start-btn">Start Taking Notes</button>
    </a>
  </div>
</body>
</html>
