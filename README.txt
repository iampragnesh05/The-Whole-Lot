THE WHOLE LOT — HOSTINGER PRODUCTION PACKAGE (PHP VERSION)

STRUCTURE
- includes/
  - header.php         Global header, meta tags, Google Fonts, and dynamic active navigation
  - footer.php         Global footer, bottom navigation, and animation scripts
- index.php            Homepage (with DM Serif / DM Sans hero spec & scroll animations)
- about.php            About practice and founder page
- services.php         Services & disciplines overview
- ground-signal.php    Ground Signal research framework
- founders-lab.php     The Founders Lab initiative
- blogs.php            Blogs listing page with category filters & featured hero
- blog-post.php        Single blog post template with full SEO & Schema markup
- data/blogs.json      Portable JSON storage for all blog articles
- admin/               Blog Content Management System (CMS)
  - admin/login.php    Admin login (Default: admin / WholeLot2026!)
  - admin/index.php    Blog dashboard with stats, search, and action controls
  - admin/create.php   New blog creator with image upload and formatting
  - admin/edit.php     Existing blog editor
- work.php             Selected client work & approach
- contact.php          Contact form with category selector
- contact-submit.php   Native PHP mail processor
- thank-you.php        Post-submission confirmation page
- 404.php              Custom 404 error page
- assets/css/styles.css Complete stylesheet with scroll effects & responsive design
- assets/js/main.js    Scroll reveal observer, navigation states & parallax

ADMIN CMS ACCESS:
1. Navigate to /admin/ (or https://yourdomain.com/admin/login.php)
2. Default Username: admin
3. Default Password: WholeLot2026!
4. From the dashboard, you can add new articles, edit existing ones, toggle published/draft status, or change your password. Any update directly syncs to the live site.

UPLOAD TO HOSTINGER:
1. In Hostinger hPanel → Websites → Manage → File Manager, open public_html.
2. Upload all files and folders directly inside public_html (so index.php sits in public_html).
3. Test https://thewholelotmedia.com and https://thewholelotmedia.com/admin.
