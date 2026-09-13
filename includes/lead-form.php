<?php
$lead_channel = ($lead_channel ?? 'academic') === 'college' ? 'college' : 'academic';
$lead_interest = trim((string)($lead_interest ?? ''));
$lead_heading = trim((string)($lead_heading ?? ($lead_channel === 'college' ? 'Request Admission Guidance' : 'Request Free Counselling')));
$lead_submit_label = trim((string)($lead_submit_label ?? ($lead_channel === 'college' ? 'Request Admission Call' : 'Send Enquiry')));
$lead_options = is_array($lead_options ?? null) ? $lead_options : [];
$lead_return_path = trim((string)($lead_return_path ?? basename((string)($_SERVER['SCRIPT_NAME'] ?? 'contact.php'))));
$lead_college_category = trim((string)($lead_college_category ?? ''));
$lead_college_slug = trim((string)($lead_college_slug ?? ''));
$lead_college_name = trim((string)($lead_college_name ?? ''));
$lead_program = trim((string)($lead_program ?? ''));
$lead_form_id = 'lead-' . substr(md5($lead_channel . '|' . $lead_interest . '|' . ($page_canonical ?? '')), 0, 10);
$formError = trim((string)($_GET['form_error'] ?? ''));
?>
<div class="contact-form forsk-lead-form" id="enquiry">
  <div class="form-title-wrap">
    <span class="forsk-badge"><?= $lead_channel === 'college' ? 'College Admissions' : 'Forsk Academic Team' ?></span>
    <h2 class="form-title"><?= htmlspecialchars($lead_heading, ENT_QUOTES, 'UTF-8') ?></h2>
    <p class="desc"><?= $lead_channel === 'college'
      ? 'Share your details for course, eligibility and admission-process guidance. Final admission is subject to the selected college/university rules and seat availability.'
      : 'Share your details and our academic team can guide you about the program, learning path, batches and practical project work.' ?></p>
  </div>

  <?php if ($formError !== ''): ?>
    <div class="alert alert-danger" role="alert">Please check the form details and submit again, or call +91 72319 68183.</div>
  <?php endif; ?>

  <form action="<?= htmlspecialchars(site_url('lead-submit.php'), ENT_QUOTES, 'UTF-8') ?>" method="post" id="<?= htmlspecialchars($lead_form_id, ENT_QUOTES, 'UTF-8') ?>">
    <div class="row">
      <div class="col-md-6"><div class="form-input"><label class="cf-label">Full name</label><input type="text" name="name" maxlength="100" autocomplete="name" required></div></div>
      <div class="col-md-6"><div class="form-input"><label class="cf-label">Mobile number</label><input type="tel" name="phone" maxlength="10" pattern="[6-9][0-9]{9}" inputmode="numeric" autocomplete="tel" required></div></div>
      <div class="col-md-6"><div class="form-input"><label class="cf-label">Email address</label><input type="email" name="email" maxlength="190" autocomplete="email" required></div></div>
      <div class="col-md-6"><div class="form-input"><label class="cf-label">City</label><input type="text" name="city" maxlength="100" value="Jaipur" autocomplete="address-level2" required></div></div>
      <div class="col-md-6"><div class="form-input"><label class="cf-label">Current qualification</label>
        <div class="tj-select"><select name="qualification" required>
          <option value="">Select qualification</option>
          <option>Class 12 / Appearing</option><option>Diploma</option><option>Undergraduate Student</option><option>Graduate</option><option>Postgraduate</option><option>Working Professional</option><option>Other</option>
        </select></div>
      </div></div>
      <div class="col-md-6"><div class="form-input"><label class="cf-label"><?= $lead_channel === 'college' ? 'Program' : 'Interested program' ?></label>
        <?php if ($lead_interest !== ''): ?>
          <input type="text" value="<?= htmlspecialchars($lead_interest, ENT_QUOTES, 'UTF-8') ?>" readonly aria-readonly="true">
          <input type="hidden" name="interest" value="<?= htmlspecialchars($lead_interest, ENT_QUOTES, 'UTF-8') ?>">
        <?php else: ?>
          <div class="tj-select"><select name="interest" required><option value="">Select program</option>
            <?php foreach ($lead_options as $option): ?><option><?= htmlspecialchars((string)$option, ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?>
          </select></div>
        <?php endif; ?>
      </div></div>
      <div class="col-12"><div class="form-input message-input"><label class="cf-label">Message / requirement</label><textarea name="message" maxlength="2000" placeholder="Tell us what you need help with..."></textarea></div></div>

      <div style="position:absolute;left:-10000px;width:1px;height:1px;overflow:hidden" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
      <input type="hidden" name="lead_channel" value="<?= htmlspecialchars($lead_channel, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="return_path" value="<?= htmlspecialchars($lead_return_path, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="source_page" value="">
      <input type="hidden" name="page_title" value="<?= htmlspecialchars((string)($page_title ?? ''), ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="referrer" value="">
      <input type="hidden" name="college_category" value="<?= htmlspecialchars($lead_college_category, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="college_slug" value="<?= htmlspecialchars($lead_college_slug, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="college_name" value="<?= htmlspecialchars($lead_college_name, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="college_program" value="<?= htmlspecialchars($lead_program, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="utm_source" value=""><input type="hidden" name="utm_medium" value=""><input type="hidden" name="utm_campaign" value=""><input type="hidden" name="utm_term" value=""><input type="hidden" name="utm_content" value="">

      <div class="col-12"><div class="form-input"><label><input type="checkbox" name="consent" value="1" required> I agree that Forsk Coding School may contact me about this enquiry.</label></div></div>
      <div class="col-12"><div class="form-submit"><button class="tj-btn-primary flip-text-wrap" type="submit"><span class="btn-text"><?= htmlspecialchars($lead_submit_label, ENT_QUOTES, 'UTF-8') ?></span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></button></div></div>
    </div>
  </form>
</div>
<script>
(function(){
  var form=document.getElementById('<?= $lead_form_id ?>'); if(!form) return;
  var q=new URLSearchParams(location.search);
  var set=function(n,v){var e=form.querySelector('[name="'+n+'"]'); if(e)e.value=v||'';};
  set('source_page',location.href); set('referrer',document.referrer);
  ['source','medium','campaign','term','content'].forEach(function(k){set('utm_'+k,q.get('utm_'+k));});
}());
</script>
