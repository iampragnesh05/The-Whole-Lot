<?php
$pageTitle = 'Contact — The Whole Lot';
$pageDescription = 'Start a conversation with The Whole Lot about strategy, research, marketing, communications, Ground Signal or The Founders Lab.';
$canonicalUrl = 'https://thewholelotmedia.com/contact.php';
$currentPage = 'contact';
require_once __DIR__ . '/includes/header.php';
$status = $_GET['status'] ?? '';
?>

<main>
<section class="page-hero">
  <div class="container reveal">
    <div class="eyebrow">GOT A QUESTION?</div>
    <h1 class="display">GOOD.<br><span class="pink">WE LIKE THOSE.</span></h1>
    <p class="intro">You don’t need to arrive knowing whether you need brand strategy, research, marketing, Ground Signal or a complicated combination of everything. Tell us what’s happening.</p>
  </div>
</section>

<section class="section">
  <div class="container contact-wrap">
    <div class="reveal">
      <div class="card">
        <h3>Work with The Whole Lot</h3>
        <p>For business, brand, marketing and communications work.</p>
      </div>
      <div class="card">
        <h3>Ground Signal</h3>
        <p>Have a research question or beta collaboration in mind?</p>
      </div>
      <div class="card">
        <h3>The Founders Lab</h3>
        <p>University, entrepreneur or potential mentor?</p>
      </div>
      <div class="card">
        <h3>Something we haven’t thought of</h3>
        <p>Arguably our favourite category.</p>
      </div>
    </div>

    <div class="reveal" data-delay="150">
      <?php if ($status === 'missing'): ?>
        <div style="background:#fff0f5;border:1px solid var(--pink-spec);padding:14px 18px;margin-bottom:20px;color:var(--ink);border-radius:4px">
          Please fill in all required fields (Name, Email, Message) to send your note.
        </div>
      <?php endif; ?>

      <form id="contact-form" class="form" action="contact-submit.php" method="post">
        <div class="field">
          <label for="name">Name</label>
          <input id="name" name="name" required placeholder="Your name">
        </div>
        <div class="field">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" required placeholder="your@email.com">
        </div>
        <div class="field">
          <label for="organisation">Organisation</label>
          <input id="organisation" name="organisation" placeholder="Company or project (optional)">
        </div>
        <div class="field">
          <label for="type">What are you here for?</label>
          <select id="type" name="type">
            <option>Start a Project</option>
            <option>Ground Signal</option>
            <option>The Founders Lab</option>
            <option>Speaking / Workshop</option>
            <option>Something Else</option>
          </select>
        </div>
        <div class="field">
          <label for="message">Tell us what’s happening</label>
          <textarea id="message" name="message" required placeholder="The interesting bit usually starts here."></textarea>
        </div>
        <button class="btn pink" type="submit">Start a Conversation →</button>
        <p class="form-note">Your message will be sent directly to The Whole Lot. We read every note carefully.</p>
      </form>
    </div>
  </div>
</section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
