from pathlib import Path
root=Path('/home/ubuntu/stargatewars')
def q(v): return "'"+str(v).replace('\\','\\\\').replace("'","\\'")+"'"
def php(v,level=0):
    ind='  '*level; nxt='  '*(level+1)
    if isinstance(v,bool): return 'true' if v else 'false'
    if isinstance(v,(int,float)): return str(v)
    if isinstance(v,str): return q(v)
    if isinstance(v,list):
        if not v:return 'array ()'
        return 'array (\n'+''.join(f'{nxt}{i} => {php(x,level+1)},\n' for i,x in enumerate(v))+ind+')'
    if isinstance(v,dict):
        if not v:return 'array ()'
        return 'array (\n'+''.join(f'{nxt}{q(k)} => {php(x,level+1)},\n' for k,x in v.items())+ind+')'
    raise TypeError(type(v))
pages={
'premium':('Premium Hub','Premium command center for wallet, passes, officers, and services.', ['Open Store','Claim daily premium','Review transaction history'], ['premium_purchase','premium_claim_daily','premium_activate'], ['premium_catalog','player_premium','premium_transactions','game_events'], ['wallet summary','season pass progression','officer status','service credits']),
'store':('Premium Store','Purchase non-pay-to-win convenience services and season rewards with Dark Matter.', ['Buy item','Inspect catalogue','Review purchases'], ['premium_purchase'], ['premium_catalog','player_premium','premium_transactions'], ['catalogue pricing','purchase validation','transaction history','balance telemetry']),
'commander':('Commander','Manage the commander premium profile, daily claim, and season pass progression.', ['Claim daily reward','Activate season pass','Refresh profile'], ['premium_claim_daily','premium_activate'], ['player_premium','premium_transactions','game_events'], ['daily claim cooldown','season pass state','season points','wallet balance']),
'premium-officers':('Premium Officers','Activate time-limited officers with transparent modifiers and expiry tracking.', ['Activate officer','Inspect effects','Refresh officer status'], ['premium_activate'], ['premium_catalog','player_premium','premium_transactions'], ['officer roster','effect modifiers','expiry state','activation history']),
'premium-services':('Premium Services','Consume bounded convenience services such as queue priority and colony scan credits.', ['Activate service','Inspect service credits','Refresh services'], ['premium_activate'], ['premium_catalog','player_premium','premium_transactions'], ['service catalogue','credit balances','cooldown state','audit history']),
}
for route,(title,purpose,controls,actions,tables,details) in pages.items():
    base={'route':route,'group':'premium','group_label':'Premium','title':title,'layout':'dashboard','controls':controls,'actions':actions,'tables':tables,'details':details,'interaction':{'server_authoritative':True,'feedback_states':['ready','empty','cooldown','insufficient-resource','success','error']},'logic':{'purpose':purpose,'workflow':['load wallet and catalogue','validate authentication, CSRF, ownership, price, quantity, and cooldown','lock wallet rows and commit transaction','render updated state and feedback'],'validation':['authenticated commander','server-side catalogue item','wallet row lock','positive bounded quantity','cooldown and ownership checks'],'calculations':['purchase cost = catalogue price × quantity','season progression = claimed rewards + validated activity','service effect = catalogue effect × active duration'],'mutations':['premium wallet debit or reward credit','officer/service activation','transaction audit event']},'features':['wallet telemetry','server-validated controls','transaction history','feedback states']}
    logic={'purpose':purpose,'workflow':['load wallet and catalogue','validate intent','lock and mutate transactionally','render result'],'validation':['authenticated commander','CSRF token','catalogue ownership and active status','wallet balance','cooldown and quantity bounds'],'calculations':['purchase cost = price × quantity','daily reward = 100 Dark Matter once per 24 hours','officer effect = catalogue modifier while active'],'mutations':['premium wallet update','premium transaction audit','game event emission']}
    features=['Premium wallet and Dark Matter balance','Season pass and daily claim tracking','Officer effect and expiry telemetry','Bounded service credits','Purchase and activation audit history','Responsive dashboard controls']
    design={'template':'premium-dashboard','sections':['wallet header','premium catalogue','active effects','transaction history','server contract','feedback'],'components':['metric-strip','catalogue-table','effect-badges','action-controls','audit-table','status-badge'],'responsive':'stacked mobile layout','theme':'inherits Default White, Window Blue Sci-Fi, and Deep Space Blue tokens'}
    systems={'services':['PremiumService'],'reads':tables,'writes':['player_premium','premium_transactions','game_events'],'actions':actions,'feedback_states':['ready','empty','cooldown','insufficient-resource','success','error'],'security':['authentication','CSRF','server-side price lookup','transaction row locks','ownership and cooldown validation']}
    for directory,obj in [('page_definitions',base),('page_logic',logic),('page_features',features),('page_design_specs',design),('page_systems',systems)]:
        (root/'config'/directory/'premium'/f'{route}.php').write_text('<?php\nreturn '+php(obj)+';\n')
