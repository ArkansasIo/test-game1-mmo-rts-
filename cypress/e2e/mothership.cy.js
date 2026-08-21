describe('Mothership page', () => {
  const username = Cypress.env('E2E_USERNAME') || 'demo_commander';
  const password = Cypress.env('E2E_PASSWORD') || 'StargateDemo!2026';

  beforeEach(() => {
    cy.visit('/login.php');
    cy.get('input[name="username"]').type(username);
    cy.get('input[name="password"]').type(password, { log: false });
    cy.contains('button', 'Authenticate commander').click();
    cy.location('pathname').should('include', 'game.php');
  });

  it('renders live Mothership state instead of generic page details', () => {
    cy.visit('/game.php?page=ship');
    cy.contains('h1', 'Mothership').should('be.visible');
    cy.contains('MOTHERSHIP CONTROL').should('be.visible');
    cy.contains('Hull integrity').should('be.visible');
    cy.contains('Hangar capacity').should('be.visible');
    cy.contains('Shield systems').should('be.visible');
    cy.contains('UPGRADE CONTROL').should('be.visible');
    cy.get('form[action="actions/game.php"] input[name="action"][value="mothership_upgrade"]').should('exist');
    cy.get('form[action="actions/game.php"] select[name="module"]').should('exist');
    cy.contains('Action could not be completed').should('not.exist');
  });

  it('shows authoritative queue and resource safeguards', () => {
    cy.visit('/game.php?page=ship');
    cy.contains('INSTALLED MODULES').should('be.visible');
    cy.contains('UPGRADE QUEUE').should('be.visible');
    cy.contains('Costs are validated and deducted transactionally, including Deuterium.').should('be.visible');
    cy.contains('Every upgrade checks ownership, module validity, prerequisites, queue capacity, cooldown, Naquadah, Deuterium, and transaction state.').should('be.visible');
  });
});
