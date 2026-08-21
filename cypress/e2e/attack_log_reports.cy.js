describe('Attack Log & Reports', () => {
  const username = Cypress.env('E2E_USERNAME') || 'demo_commander';
  const password = Cypress.env('E2E_PASSWORD');
  if (!password) throw new Error('Set E2E_PASSWORD before running authenticated Cypress tests.');

  beforeEach(() => {
    cy.visit('/login.php');
    cy.get('input[name="username"]').type(username);
    cy.get('input[name="password"]').type(password, { log: false });
    cy.contains('button', 'Authenticate commander').click();
    cy.location('pathname').should('include', 'game.php');
  });

  it('renders report rows with complete server-side action payloads', () => {
    cy.visit('/game.php?page=attack-log');
    cy.contains('h1', 'Attack Log & Reports').should('be.visible');
    cy.contains('BATTLE OUTCOMES').should('be.visible');
    cy.get('form[action="actions/game.php"]').filter(':has(input[name="report_id"])').should('have.length.at.least', 2).each(($form) => {
      cy.wrap($form).find('input[name="action"]').invoke('val').should('match', /^(read_report|message_read)$/);
      cy.wrap($form).find('input[name="redirect"]').should('have.value', 'attack-log');
      cy.wrap($form).find('input[name="report_kind"]').should('have.value', 'battle');
      cy.wrap($form).find('input[name="report_id"]').invoke('val').should('match', /^[1-9][0-9]*$/);
      cy.wrap($form).find('input[name="csrf_token"], input[name="csrf"]').should('exist');
    });
    cy.contains('Action could not be completed').should('not.exist');
  });

  it('renders both Open report and Mark read controls with ownership messaging', () => {
    cy.visit('/game.php?page=attack-log');
    cy.contains('Open report').should('be.visible');
    cy.contains('Mark read').should('be.visible');
    cy.contains('Recipient ownership and classification are checked server-side.').should('be.visible');
    cy.contains('Report reads and read-state changes require authentication').should('be.visible');
  });
});
