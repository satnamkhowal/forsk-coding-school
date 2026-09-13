<?php
/**
 * Global floating contact actions for Forsk Coding School.
 * Kept as a standalone component so positioning, labels and destinations can
 * be updated without touching individual page templates.
 */
$contactPhoneDisplay = '+91 72319 68183';
$contactPhoneHref = '+917231968183';
$contactWhatsApp = '917231968183';
$contactWhatsAppText = rawurlencode('Hi Forsk Coding School, I want course counselling.');
?>
<style>
  .forsk-floating-contact {
    position: fixed;
    left: 0;
    top: 58%;
    transform: translateY(-50%);
    z-index: 9998;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    pointer-events: none;
  }

  .forsk-floating-contact__link {
    min-height: 50px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 0 16px 0 13px;
    border-radius: 0 999px 999px 0;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: .01em;
    box-shadow: 0 8px 24px rgba(9, 20, 50, .20);
    transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    pointer-events: auto;
    white-space: nowrap;
  }

  .forsk-floating-contact__link:hover,
  .forsk-floating-contact__link:focus-visible {
    color: #fff;
    transform: translateX(4px);
    box-shadow: 0 10px 28px rgba(9, 20, 50, .28);
    filter: brightness(1.04);
  }

  .forsk-floating-contact__link:focus-visible {
    outline: 3px solid rgba(255, 255, 255, .95);
    outline-offset: -5px;
  }

  .forsk-floating-contact__link--whatsapp { background: #128c7e; }
  .forsk-floating-contact__link--call { background: #2156c8; }

  .forsk-floating-contact__icon {
    width: 24px;
    min-width: 24px;
    text-align: center;
    font-size: 23px;
    line-height: 1;
  }

  @media (max-width: 767px) {
    .forsk-floating-contact {
      top: auto;
      bottom: 92px;
      transform: none;
      gap: 8px;
    }

    .forsk-floating-contact__link {
      width: 50px;
      min-width: 50px;
      height: 50px;
      min-height: 50px;
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

<nav class="forsk-floating-contact" aria-label="Quick contact">
  <a
    class="forsk-floating-contact__link forsk-floating-contact__link--whatsapp"
    href="https://wa.me/<?= htmlspecialchars($contactWhatsApp, ENT_QUOTES, 'UTF-8') ?>?text=<?= htmlspecialchars($contactWhatsAppText, ENT_QUOTES, 'UTF-8') ?>"
    target="_blank"
    rel="noopener"
    aria-label="Message Forsk Coding School on WhatsApp"
    title="WhatsApp Forsk Coding School"
  >
    <i class="tji-whatsapp forsk-floating-contact__icon" aria-hidden="true"></i>
    <span class="forsk-floating-contact__label">WhatsApp</span>
  </a>

  <a
    class="forsk-floating-contact__link forsk-floating-contact__link--call"
    href="tel:<?= htmlspecialchars($contactPhoneHref, ENT_QUOTES, 'UTF-8') ?>"
    aria-label="Call Forsk Coding School at <?= htmlspecialchars($contactPhoneDisplay, ENT_QUOTES, 'UTF-8') ?>"
    title="Call <?= htmlspecialchars($contactPhoneDisplay, ENT_QUOTES, 'UTF-8') ?>"
  >
    <i class="tji-phone-call forsk-floating-contact__icon" aria-hidden="true"></i>
    <span class="forsk-floating-contact__label">Click to Call</span>
  </a>
</nav>
