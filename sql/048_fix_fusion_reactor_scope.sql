-- Correct the Fusion Reactor placement scope after migration 047.
UPDATE building_types
SET building_class='power', buildable_on='both', field_size=1, base_power_output=120, base_power_consumption=4, placement_rule='power_core_required'
WHERE building_key='fusion_reactor';
