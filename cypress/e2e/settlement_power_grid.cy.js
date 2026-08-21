describe('Settlement & Power Grid', () => {
  const baseUrl = Cypress.config('baseUrl') || 'http://127.0.0.1:8095';
  const username = Cypress.env('E2E_USERNAME') || 'demo_commander';
  const password = Cypress.env('E2E_PASSWORD') || 'StargateDemo!2026';

  beforeEach(() => {
    cy.visit('/login.php');
    cy.get('input[name="username"]').should('be.visible').type(username);
    cy.get('input[name="password"]').should('be.visible').type(password, { log: false });
    cy.contains('button', 'Authenticate commander').click();
    cy.location('pathname').should('include', 'game.php');
  });

  it('selects the Settlement route and renders the field grid and power metrics', () => {
    cy.visit('/game.php?page=settlement');

    cy.contains('h1', 'Settlement & Power Grid').should('be.visible');
    cy.contains('FIELD GRID').should('be.visible');
    cy.get('.settlement-grid').should('be.visible');
    cy.contains('Power output').should('be.visible');
    cy.contains('Power draw').should('be.visible');
    cy.contains('Grid balance').should('be.visible');
    cy.contains('Minimum brownout floor 25%').should('be.visible');
    cy.contains('Action could not be completed').should('not.exist');
  });

  it('keeps the displayed power balance mathematically consistent', () => {
    cy.visit('/game.php?page=settlement');

    const metricValue = (label) => cy.contains('.metric', label).find('strong').invoke('text').then((value) => {
      const numeric = Number(value.replace(/[^0-9.-]/g, ''));
      expect(numeric, `${label} should be numeric`).to.be.a('number').and.not.be.NaN;
      return numeric;
    });

    metricValue('Power output').then((output) => {
      metricValue('Power draw').then((draw) => {
        metricValue('Grid balance').then((balance) => {
          expect(balance, 'grid balance = output - draw').to.eq(output - draw);
        });
      });
    });
  });

  it('exposes a valid construction control for every visible field', () => {
    cy.visit('/game.php?page=settlement');
    cy.get('.settlement-grid .settlement-field').should('have.length.greaterThan', 0).each(($field) => {
      cy.wrap($field).find('select[name="building_key"]').should('exist');
      cy.wrap($field).contains('Queue build').should('exist');
    });
  });
});
