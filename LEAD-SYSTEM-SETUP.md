# Lead system setup

The website has two isolated lead channels:

1. **Academic** — course and internship enquiries.
2. **College** — BCA, MCA, B.Tech and BBA admission-support enquiries.

## Production configuration

1. In your hosting control panel, add an environment variable named `FORSK_SETUP_KEY` with a long random value.
2. Open `/admin/integrations-setup.php?setup_key=YOUR_KEY`.
3. Fill the **Academic** database and SMTP panel.
4. Fill the **College Admissions** database and SMTP panel independently.
5. Click **Save Both Configurations**.

Credentials are written to `storage/private/integrations.php`. This file is ignored by Git and blocked from direct Apache web access. Do not commit credentials.

If an external database is disabled or temporarily unavailable, the form processor stores the lead in separate local JSONL fallback files under `storage/leads/`. SMTP failure does not discard a stored lead.

The external database table is created automatically on the first valid submission when the configured MySQL account has `CREATE TABLE` permission. Otherwise create the configured table manually or grant the required permission.
