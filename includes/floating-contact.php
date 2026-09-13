<?php
/**
 * Global floating contact actions for Forsk Coding School.
 *
 * This component is intentionally self-contained so every template that loads
 * the shared footer gets the same always-visible enquiry actions. The widget is
 * moved to <body> before the site's smooth-scroll scripts initialise; this keeps
 * position: fixed relative to the viewport instead of a transformed scroll
 * wrapper.
 */
$contactPhoneDisplay = '+91 72319 68183';
$contactPhoneHref = '+917231968183';
$contactWhatsApp = '917231968183';
$contactWhatsAppText = rawurlencode('Hi Forsk Coding School, I want course counselling.');
?>
<style>
  .forsk-floating-contact {
    position: fixed !important;
    left: 0 !important;
    right: auto !important;
    top: auto !important;
    bottom: max(24px, env(safe-area-inset-bottom)) !important;
    transform: none !important;
    z-index: 2147483000 !important;
    display: flex !important;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    margin: 0 !important;
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: none;
    isolation: isolate;
  }

  .forsk-floating-contact__link {
    min-height: 52px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 0 17px 0 14px;
    border: 0;
    border-radius: 0 999px 999px 0;
    color: #fff !important;
    text-decoration: none !important;
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: .01em;
    box-shadow: 0 8px 24px rgba(9, 20, 50, .22);
    transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    pointer-events: auto;
    white-space: nowrap;
    -webkit-tap-highlight-color: transparent;
  }

  .forsk-floating-contact__link:hover,
  .forsk-floating-contact__link:focus-visible {
    color: #fff !important;
    transform: translateX(4px);
    box-shadow: 0 10px 28px rgba(9, 20, 50, .30);
    filter: brightness(1.04);
  }

  .forsk-floating-contact__link:focus-visible {
    outline: 3px solid rgba(255, 255, 255, .96);
    outline-offset: -5px;
  }

  .forsk-floating-contact__link--whatsapp { background: #128c7e; }
  .forsk-floating-contact__link--call { background: #2156c8; }

  .forsk-floating-contact__icon {
    width: 25px;
    height: 25px;
    min-width: 25px;
    display: block;
    fill: none;
    stroke: currentColor;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .forsk-floating-contact__icon--whatsapp {
    width: 27px;
    height: 27px;
  }

  @media (max-width: 767px) {
    .forsk-floating-contact {
      bottom: max(16px, env(safe-area-inset-bottom)) !important;
      gap: 8px;
    }

    .forsk-floating-contact__link {
      width: 52px;
      min-width: 52px;
      height: 52px;
      min-height: 52px;
      justify-content: center;
      padding: 0;
      gap: 0;
      border-radius: 0 50% 50% 0;
    }

    .forsk-floating-contact__label { display: none; }
  }

  @media (prefers-reduced-motion: reduce) {
    .forsk-floating-contact__link { transition: none; }
  }
</style>

<nav id="forsk-floating-contact" class="forsk-floating-contact" aria-label="Quick enquiry actions">
  <a
    class="forsk-floating-contact__link forsk-floating-contact__link--whatsapp"
    href="https://wa.me/<?= htmlspecialchars($contactWhatsApp, ENT_QUOTES, 'UTF-8') ?>?text=<?= htmlspecialchars($contactWhatsAppText, ENT_QUOTES, 'UTF-8') ?>"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Message Forsk Coding School on WhatsApp"
    title="WhatsApp Forsk Coding School"
  >
    <svg class="forsk-floating-contact__icon forsk-floating-contact__icon--whatsapp" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
      <path d="M20.5 11.7a8.4 8.4 0 0 1-12.4 7.4L3.5 20.5l1.4-4.4A8.4 8.4 0 1 1 20.5 11.7Z"></path>
      <path d="M8.2 7.8c.2-.5.4-.5.7-.5h.5c.2 0 .4.1.5.4l.8 2c.1.3.1.5-.1.7l-.6.8c-.2.2-.1.4 0 .6.7 1.2 1.6 2.1 2.8 2.8.2.1.4.2.6 0l.9-1c.2-.2.4-.3.7-.2l2 .9c.3.1.4.3.4.5 0 .3-.1 1.4-.7 2-.6.6-1.4.9-2.3.9-1.2 0-3.2-.7-5.4-2.6-2.2-1.9-3.5-4.6-3.6-5.7 0-.8.3-1.3.8-1.6Z"></path>
    </svg>
    <span class="forsk-floating-contact__label">WhatsApp</span>
  </a>

  <a
    class="forsk-floating-contact__link forsk-floating-contact__link--call"
    href="tel:<?= htmlspecialchars($contactPhoneHref, ENT_QUOTES, 'UTF-8') ?>"
    aria-label="Call Forsk Coding School at <?= htmlspecialchars($contactPhoneDisplay, ENT_QUOTES, 'UTF-8') ?>"
    title="Call <?= htmlspecialchars($contactPhoneDisplay, ENT_QUOTES, 'UTF-8') ?>"
  >
    <svg class="forsk-floating-contact__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
      <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2Z"></path>
    </svg>
    <span class="forsk-floating-contact__label">Click to Call</span>
  </a>
</nav>

<script>
(function () {
  var widget = document.getElementById('forsk-floating-contact');
  if (!widget) return;

  // GSAP ScrollSmoother transforms #smooth-content. A fixed descendant of a
  // transformed element scrolls with that element, so keep this widget as a
  // direct body child before smooth-scroll scripts initialise.
  if (widget.parentNode !== document.body) {
    document.body.appendChild(widget);
  }
})();
</script>
