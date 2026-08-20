/*
 * Browser-console E2E test for the integrated game.php dashboard.
 * Paste this async IIFE into the live dashboard console or adapt it to a browser runner.
 * It exercises navigation, combat intents, espionage intents, sabotage, and feedback.
 */
(async () => {
  const report = { status: 'passed', checks: [], errors: [] };
  const sleep = ms => new Promise(resolve => setTimeout(resolve, ms));
  const assert = (name, passed, detail = '') => {
    report.checks.push({ name, passed: Boolean(passed), detail });
    if (!passed) {
      report.status = 'failed';
      report.errors.push({ name, detail });
    }
  };
  const clickNav = async label => {
    const button = [...document.querySelectorAll('button.link')]
      .find(element => element.textContent.trim().startsWith(label));
    assert(`navigation:${label}`, Boolean(button), 'route navigation control found');
    if (button) { button.click(); await sleep(20); }
  };
  const runIntent = async (label, expectedAction) => {
    const button = [...document.querySelectorAll('button.page-intent, button.attack-intent, button.sabotage-intent')]
      .find(element => element.textContent.trim() === label);
    assert(`intent-control:${label}`, Boolean(button), 'intent button found');
    if (button) {
      button.click();
      await sleep(20);
      const feedback = document.querySelector('#intent-feedback, #attack-feedback, #sabotage-feedback');
      assert(
        `feedback:${expectedAction}`,
        Boolean(feedback && feedback.textContent.includes(expectedAction)),
        feedback?.textContent || 'missing feedback'
      );
    }
  };

  await clickNav('Target Selection');
  assert('combat-page-title', document.querySelector('#title')?.textContent === 'Target Selection');
  assert('combat-formula', document.body.innerText.includes('deterministic resolver'));
  await runIntent('Attack', 'combat');
  await runIntent('Raid', 'combat:raid');

  await clickNav('Spy Operations');
  assert('spy-page-title', document.querySelector('#title')?.textContent === 'Spy Operations');
  assert('spy-formula', document.body.innerText.includes('detection'));
  await runIntent('Run reconnaissance', 'covert:recon');
  await runIntent('Run spy mission', 'covert:spy');

  await clickNav('Sabotage Operations');
  assert('sabotage-page-title', document.querySelector('#title')?.textContent === 'Sabotage Operations');
  await runIntent('Run sabotage', 'covert:sabotage');

  console.log(JSON.stringify(report, null, 2));
  return report;
})();
