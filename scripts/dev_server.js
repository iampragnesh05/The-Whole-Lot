const http = require('http');
const fs = require('fs');
const path = require('path');
const url = require('url');

const PORT = 8088;
const ROOT = path.resolve(__dirname, '..');

const MIME_TYPES = {
  '.html': 'text/html; charset=utf-8',
  '.php': 'text/html; charset=utf-8',
  '.css': 'text/css; charset=utf-8',
  '.js': 'application/javascript; charset=utf-8',
  '.json': 'application/json; charset=utf-8',
  '.svg': 'image/svg+xml',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.webp': 'image/webp',
  '.woff2': 'font/woff2',
  '.xml': 'application/xml',
  '.txt': 'text/plain; charset=utf-8'
};

function renderPhpSimple(filePath, query = {}) {
  let content = fs.readFileSync(filePath, 'utf8');
  const baseDir = path.dirname(filePath);

  // Extract variables
  const pageMatch = content.match(/\$page\s*=\s*['"]([^'"]+)['"]/);
  const page = pageMatch ? pageMatch[1] : '';
  const pageTitleMatch = content.match(/\$pageTitle\s*=\s*['"]([^'"]+)['"]/);
  const pageTitle = pageTitleMatch ? pageTitleMatch[1] : '';
  const pageDescMatch = content.match(/\$pageDescription\s*=\s*['"]([^'"]+)['"]/);
  const pageDescription = pageDescMatch ? pageDescMatch[1] : '';
  const pagePathMatch = content.match(/\$pagePath\s*=\s*['"]([^'"]+)['"]/);
  const pagePath = pagePathMatch ? pagePathMatch[1] : '/';
  const initialType = query.type || 'Start a Project';
  const status = query.status || '';

  // Process includes recursively
  content = content.replace(/<\?php\s+include\s+__DIR__\s*\.\s*['"]([^'"]+)['"];\s*\?>/g, (m, inc) => {
    const incPath = path.resolve(baseDir, '.' + inc);
    if (fs.existsSync(incPath)) {
      let incContent = fs.readFileSync(incPath, 'utf8');
      return incContent;
    }
    return '';
  });

  // Handle meta variables
  const siteTitle = 'The Whole Lot — Strategy · Culture · Research · Growth';
  const metaTitle = pageTitle ? pageTitle + ' — The Whole Lot' : siteTitle;
  const metaDesc = pageDescription || 'The Whole Lot is an independent strategy, research and growth practice exploring how people, culture and context shape businesses and the world around them.';

  content = content.replace(/<\?=\s*htmlspecialchars\(\$metaTitle\)\s*\?>/g, metaTitle);
  content = content.replace(/<\?=\s*htmlspecialchars\(\$metaDescription\)\s*\?>/g, metaDesc);
  content = content.replace(/<\?=\s*htmlspecialchars\(\$canonicalUrl\)\s*\?>/g, 'https://thewholelotmedia.com' + pagePath);
  content = content.replace(/<\?=\s*htmlspecialchars\(\$ogImage\)\s*\?>/g, 'https://thewholelotmedia.com/assets/img/og/og-image.jpg');

  // Handle conditional active classes in header/nav
  const isInitiativeActive = ['ground-signal', 'founders-lab', 'reflections'].includes(page);
  content = content.replace(/<\?=\s*\$page\s*===\s*'([^']+)'\s*\?\s*'active'\s*:\s*''\s*\?>/g, (m, p) => p === page ? 'active' : '');
  content = content.replace(/<\?=\s*\$page\s*===\s*'([^']+)'\s*\?\s*'pink'\s*:\s*''\s*\?>/g, (m, p) => p === page ? 'pink' : '');
  content = content.replace(/<\?=\s*\$page\s*===\s*'([^']+)'\s*\?\s*'aria-current="page"'\s*:\s*''\s*\?>/g, (m, p) => p === page ? 'aria-current="page"' : '');
  content = content.replace(/<\?=\s*\$isInitiativeActive\s*\?\s*'active'\s*:\s*''\s*\?>/g, isInitiativeActive ? 'active' : '');

  // Handle contact form helpers
  content = content.replace(/<\?=\s*\$initialType\s*===\s*'([^']+)'\s*\?\s*'active'\s*:\s*''\s*\?>/g, (m, val) => initialType === val ? 'active' : '');
  content = content.replace(/<\?=\s*stripos\(\$initialType,\s*'([^']+)'\)\s*!==\s*false\s*\?\s*'active'\s*:\s*''\s*\?>/g, (m, val) => initialType.toLowerCase().includes(val.toLowerCase()) ? 'active' : '');
  content = content.replace(/<\?=\s*stripos\(\$initialType,\s*'([^']+)'\)\s*!==\s*false\s*\?\s*'selected'\s*:\s*''\s*\?>/g, (m, val) => initialType.toLowerCase().includes(val.toLowerCase()) ? 'selected' : '');
  content = content.replace(/<\?=\s*\(\$initialType\s*===\s*'Something Else'\s*\|\|\s*\$initialType\s*===\s*'Tell Us About It'\)\s*\?\s*'selected'\s*:\s*''\s*\?>/g, (initialType === 'Something Else' || initialType === 'Tell Us About It') ? 'selected' : '');

  // Status alerts in contact
  content = content.replace(/<\?php\s+if\s*\(\$status\s*===\s*'missing'\):\s*\?>([\s\S]*?)<\?php\s+elseif\s*\(\$status\s*===\s*'turnstile'\):\s*\?>([\s\S]*?)<\?php\s+elseif\s*\(\$status\s*===\s*'mail'\):\s*\?>([\s\S]*?)<\?php\s+endif;\s*\?>/g, (m, c1, c2, c3) => {
    if (status === 'missing') return c1;
    if (status === 'turnstile') return c2;
    if (status === 'mail') return c3;
    return '';
  });

  // Schema condition on about page
  content = content.replace(/<\?php\s+if\s*\(isset\(\$page\)\s*&&\s*\$page\s*===\s*'about'\):\s*\?>([\s\S]*?)<\?php\s+endif;\s*\?>/g, (m, schema) => {
    return page === 'about' ? schema : '';
  });

  // Clean remaining PHP open/close tags
  content = content.replace(/<\?php[\s\S]*?\?>/g, '');
  content = content.replace(/<\?=\s*[\s\S]*?\?>/g, '');

  return content;
}

const server = http.createServer((req, res) => {
  const parsedUrl = url.parse(req.url, true);
  let pathname = parsedUrl.pathname;

  // Extensionless routing
  if (pathname === '/') {
    pathname = '/index.php';
  } else if (!path.extname(pathname)) {
    if (fs.existsSync(path.join(ROOT, pathname + '.php'))) {
      pathname = pathname + '.php';
    } else if (fs.existsSync(path.join(ROOT, pathname, 'index.php'))) {
      pathname = path.join(pathname, 'index.php');
    }
  }

  const filePath = path.join(ROOT, pathname);

  if (!fs.existsSync(filePath)) {
    const notFoundPath = path.join(ROOT, '404.php');
    if (fs.existsSync(notFoundPath)) {
      const body = renderPhpSimple(notFoundPath, parsedUrl.query);
      res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
      return res.end(body);
    }
    res.writeHead(404, { 'Content-Type': 'text/plain' });
    return res.end('404 Not Found');
  }

  const ext = path.extname(filePath).toLowerCase();

  if (ext === '.php') {
    try {
      const html = renderPhpSimple(filePath, parsedUrl.query);
      res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
      return res.end(html);
    } catch (err) {
      console.error(err);
      res.writeHead(500, { 'Content-Type': 'text/plain' });
      return res.end('500 Internal Error');
    }
  }

  const contentType = MIME_TYPES[ext] || 'application/octet-stream';
  res.writeHead(200, { 'Content-Type': contentType });
  fs.createReadStream(filePath).pipe(res);
});

server.listen(PORT, '127.0.0.1', () => {
  console.log(`Development preview server running at http://127.0.0.1:${PORT}`);
});
