(() => {
  const qs = (selector, root = document) => root.querySelector(selector);
  const csrf = () => { const field = qs('input[name="csrf_token"]'); if (field) return field.value || ''; const raw = (typeof state !== 'undefined' && state.csrf) ? String(state.csrf) : ''; const match = raw.match(/value=["']([^"']+)["']/); return match ? match[1] : ''; };
  const setFeedback = (message, state = 'ready') => {
    let node = qs('#generated-page-feedback') || qs('#intent-feedback');
    if (!node) {
      node = document.createElement('div');
      node.id = 'generated-page-feedback';
      node.className = 'feedback';
      (qs('#content') || document.body).prepend(node);
    }
    node.dataset.state = state;
    node.textContent = message || '';
    node.style.display = message ? 'block' : 'none';
  };
  async function sendGeneratedIntent(intent, route, action = '') {
    setFeedback('Contacting the server…', 'loading');
    const body = new URLSearchParams({ intent, route, action, csrf_token: csrf() });
    try {
      const response = await fetch('actions/page_intent.php', {
        method: 'POST', credentials: 'same-origin',
        headers: { Accept: 'application/json', 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
        body
      });
      const data = await response.json();
      if (!response.ok || !data.ok) throw new Error(data.message || 'The server rejected this page intent.');
      setFeedback(data.message || 'Server state synchronized.', data.state || 'ready');
      document.dispatchEvent(new CustomEvent('generated-page:intent-complete', { detail: data }));
      return data;
    } catch (error) {
      setFeedback(error.message || 'The page intent could not be completed.', 'error');
      return null;
    }
  }
  document.addEventListener('click', event => {
    const button = event.target.closest('.page-intent,[data-generated-intent]');
    if (!button) return;
    event.preventDefault();
    const route = button.dataset.route || new URLSearchParams(location.search).get('page') || 'dashboard';
    const intent = button.dataset.generatedIntent || 'inspect_page';
    sendGeneratedIntent(intent, route, button.dataset.action || '');
  });
  window.GeneratedPageInteractions = { sendGeneratedIntent, setFeedback };
})();
