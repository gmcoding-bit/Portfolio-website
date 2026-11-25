# Portfolio Website

A personal portfolio website built with PHP, MySQL, HTML, CSS and JavaScript. It brings together an "About me" style site (Home, About me, Education, Skills, Experience, Portfolio) with a custom-built blog system that supports user login, posting new entries, previewing them before posting, and filtering published entries by month.

Built as a learning project to practise full-stack web development without relying on a framework or CMS — the login system, blog storage/sorting and filtering logic are all implemented from scratch in PHP and vanilla JavaScript.

## Features

- **Static info pages** — Home, About me, Education, Skills, Experience and Portfolio, each with its own HTML/CSS.
- **Login system** — a session-based login (`loginProcess.php`) backed by a MySQL `USERS` table, gating access to the blog.
- **Blog**
  - `addentry.php` — a form for logged-in users to write a new blog entry (title + text), with client-side validation and confirmation prompts (`addentryButton.js`).
  - `preview.php` — lets a user preview an entry before publishing it.
  - `viewBlog.php` — lists published entries, with a dropdown (`monthChoice.js`) to filter entries by month or show all of them.
  - Entries are sorted newest-first using a **bubble sort implemented from scratch** (rather than a built-in PHP sort function) over each entry's parsed date/time.
- **Logout** — `logout.php` ends the session.

## Tech stack

- **Backend:** PHP (`mysqli`), session-based authentication
- **Database:** MySQL
- **Frontend:** HTML, CSS, vanilla JavaScript
- **Local environment:** XAMPP (Apache + MySQL)
- **Fonts:** Google Fonts (DM Sans, Montserrat)

## Project structure

```
.
├── index.php            # Home page + login form
├── About_me.html / .css
├── Education.html / .css
├── Skills.html / .css
├── Experience.html / .css
├── Portfolio.html / .css
├── addentry.php / addentryButton.js   # New blog entry form + client-side logic
├── preview.php           # Blog entry preview
├── viewBlog.php / monthChoice.js      # Blog listing + month filter
├── loginProcess.php      # Login handler
├── logout.php            # Session logout
├── css/                  # Stylesheets (incl. reset.css)
├── images/               # Site images, icons and logos
└── phase2/               # A later iteration of the site, mirroring the structure above
```

> **Note:** `phase2/` contains a parallel, slightly more developed copy of the site (including an extra `applications.html` file left over from a local XAMPP install). It's kept here to show how the project evolved rather than as a separate deliverable.

## Setup

This project expects a local [XAMPP](https://www.apachefriends.org/) (or equivalent Apache + PHP + MySQL) environment.

1. Clone this repository into your XAMPP `htdocs` folder.
2. Start Apache and MySQL (e.g. via the XAMPP control panel).
3. Create a database named `portfolio_website`, with:
   - a `USERS` table containing at least `user_id`, `email` and `password` columns
   - a `blogs` table containing at least `title`, `content` and `datemade` columns
4. Update the database credentials in `loginProcess.php`, `addentry.php` and `viewBlog.php` if your local MySQL setup differs from the defaults (`127.0.0.1`, user `root`, no password).
5. Visit `index.php` in your browser (e.g. `http://localhost/portfolio-website/index.php`), log in with a user from the `USERS` table, and use the nav bar to browse the site, add a blog entry and filter the blog by month.

## Known limitations

This is a learning project and a few rough edges are intentionally left as-is for now:

- Passwords are stored and compared in plain text, and SQL queries are built with string interpolation rather than prepared statements — fine for local practice, but not production-ready.
- `preview.php` is still a work in progress and doesn't yet render the submitted title/text correctly.
- There's no password hashing, CSRF protection, or input sanitisation beyond basic `required` fields on the client side.

## Author

**Rahul Rai**
