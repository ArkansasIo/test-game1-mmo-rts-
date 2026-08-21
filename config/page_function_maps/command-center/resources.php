<?php
return array (
  'route' => 'resources',
  'title' => 'Resources & Vault',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_deposit',
    7 => 'handle_withdraw',
  ),
  'sub_functions' =>
  array (
    0 => 'validate_vault_balance',
    1 => 'calculate_net_settlement',
    2 => 'apply_resource_transfer',
    3 => 'write_economy_event',
  ),
  'actions' =>
  array (
    0 => 'deposit',
    1 => 'withdraw',
  ),
  'state_transitions' =>
  array (
    'loading' => 'load scoped state and render skeleton',
    'ready' => 'display authoritative state and enable permitted controls',
    'empty' => 'display an explicit no-records state without fabricating data',
    'submitting' => 'disable duplicate submission and show progress',
    'success' => 'refresh live state, append event, and announce result',
    'protected' => 'explain protection or ownership restriction without leaking data',
    'cooldown' => 'display remaining server cooldown and disable action',
    'insufficient-resource' => 'display missing resources and preserve state',
    'error' => 'display safe error feedback and retain navigation context',
  ),
);
