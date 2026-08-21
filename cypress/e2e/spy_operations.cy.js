describe('Spy Operations', () => {
  const username = Cypress.env('E2E_USERNAME') || 'demo_commander';
  const password = Cypress.env('E2E_PASSWORD') || 'StargateDemo!2026';

  beforeEach(() => {
    cy.visit('/login.php');
    cy.get('input[name="username"]').type(username);
    cy.get('input[name="password"]').type(password, { log: false });
    cy.contains('button', 'Authenticate commander').click();
    cy.location('pathname').should('include', 'game.php');
  });

  it('renders validated target and agent controls for all covert operations', () => {
    cy.visit('/game.php?page=spy');
    cy.contains('h1', 'Spy Operations').should('be.visible');
    cy.contains('Available agents').should('be.visible');
    cy.contains('Mission state').should('be.visible');
    cy.get('form[action="actions/game.php"]').should('have.length.at.least', 3).each(($form) => {
      cy.wrap($form).find('input[name="action"]').invoke('val').should('match', /^covert:(recon|spy|sabotage)$/);
      cy.wrap($form).find('input[name="redirect"]').should('have.value', 'spy');
      cy.wrap($form).find('select[name="target_id"]').should('exist');
      cy.wrap($form).find('input[name="agents"]').should('have.attr', 'min', '1');
      cy.wrap($form).find('input[name="agents"]').should('have.attr', 'max');
      cy.wrap($form).find('button[type="submit"]').should('exist');
    });
    cy.contains('Action could not be completed').should('not.exist');
  });

  it('keeps protected targets visible but relies on server validation', () => {
    cy.visit('/game.php?page=spy');
    cy.get('select[name="target_id"]').first().find('option').should('have.length.greaterThan', 1);
    cy.contains('target ownership validated').should('be.visible');
    cy.contains('All mutations require authentication, CSRF, RBAC, ownership, protection, resource, cooldown, and transaction checks.').should('be.visible');
  });
});
