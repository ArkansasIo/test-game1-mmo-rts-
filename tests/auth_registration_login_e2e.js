#!/usr/bin/env node
'use strict';

const base = process.env.STAGING_BASE_URL || 'http://127.0.0.1:8095';
const suffix = `${Date.now()}_${Math.floor(Math.random() * 100000)}`;
const username = `e2e_${suffix}`;
const displayName = `E2E Commander ${suffix}`;
const password = 'E2E-Strong-Password-2026!';
let cookie = '';

function assert(condition, message) {
  if (!condition) throw new Error(message);
}
function rememberCookies(headers) {
  const values = headers.getSetCookie ? headers.getSetCookie() : [];
  if (values.length) cookie = values.map(v => v.split(';')[0]).join('; ');
  else {
    const raw = headers.get('set-cookie');
    if (raw) cookie = raw.split(',').map(v => v.trim().split(';')[0]).join('; ');
  }
}
async function request(path, options = {}) {
  const headers = new Headers(options.headers || {});
  if (cookie) headers.set('Cookie', cookie);
  const response = await fetch(base + path, {...options, headers, redirect: 'manual'});
  rememberCookies(response.headers);
  const body = await response.text();
  return {response, body};
}
function tokenFrom(html) {
  const match = html.match(/name=["']csrf_token["'][^>]*value=["']([^"']+)["']/i) || html.match(/value=["']([^"']+)["'][^>]*name=["']csrf_token["']/i);
  return match ? match[1] : '';
}

(async () => {
  const registration = await request('/register.php');
  assert(registration.response.status === 200, `registration page status ${registration.response.status}`);
  const registrationToken = tokenFrom(registration.body);
  assert(registrationToken.length >= 32, 'registration CSRF token missing');
  const badCsrf = new URLSearchParams({csrf_token: 'invalid', display_name: displayName, username, password, race_id: '1', government_id: '1'});
  const badRegistration = await request('/register.php', {method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: badCsrf});
  assert(badRegistration.response.status >= 400 && badRegistration.response.status < 500, `invalid CSRF registration was not rejected: ${badRegistration.response.status}`);

  const goodRegistration = new URLSearchParams({csrf_token: registrationToken, display_name: displayName, username, password, race_id: '1', government_id: '1'});
  const created = await request('/register.php', {method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: goodRegistration});
  assert([302, 303].includes(created.response.status), `registration did not redirect: ${created.response.status}`);
  const location = created.response.headers.get('location') || '';
  assert(location.includes('game.php') || location.includes('login.php'), `registration redirected unexpectedly: ${location}`);

  cookie = '';
  const login = await request('/login.php');
  assert(login.response.status === 200, `login page status ${login.response.status}`);
  const loginToken = tokenFrom(login.body);
  assert(loginToken.length >= 32, 'login CSRF token missing');
  const invalidLogin = new URLSearchParams({csrf_token: loginToken, username, password: 'wrong-password'});
  const rejected = await request('/actions/login.php', {method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: invalidLogin});
  assert(rejected.response.status === 200, `invalid login response status ${rejected.response.status}`);
  assert(rejected.body.includes('username or password is incorrect'), 'invalid login error message missing');

  const loginPageAgain = await request('/login.php');
  const loginTokenAgain = tokenFrom(loginPageAgain.body);
  const validLogin = new URLSearchParams({csrf_token: loginTokenAgain, username, password});
  const authenticated = await request('/actions/login.php', {method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: validLogin});
  assert([302, 303].includes(authenticated.response.status), `valid login did not redirect: ${authenticated.response.status}`);
  assert((authenticated.response.headers.get('location') || '').includes('game.php'), 'valid login did not redirect to dashboard');
  const dashboard = await request('/game.php');
  assert(dashboard.response.status === 200, `authenticated dashboard status ${dashboard.response.status}`);
  assert(dashboard.body.includes('Command Center') && dashboard.body.includes('Deuterium'), 'authenticated dashboard content missing');
  console.log(JSON.stringify({status: 'passed', base, username, checks: ['registration_csrf_rejection', 'registration_success', 'login_csrf_presence', 'invalid_login_rejection', 'valid_login_session', 'protected_dashboard_access']}, null, 2));
})().catch(error => {
  console.error(JSON.stringify({status: 'failed', error: error.message, base, username}, null, 2));
  process.exit(1);
});
