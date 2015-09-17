<br/>
<div id="__CORE_DIV_DEBUG" class="__core_div_debug__">

	<div class="__core_div_debug_field__">
		<div id="__DEBUG_CONTAINER__" class="__debug_nav_indices__"><a href="javascript:void(0);" onclick="debugDisplayField('__DEBUG_CONTAINER_FIELD__')">CONTAINER</a></div>
		<div id="__DEBUG_CONTAINER_FIELD__" rel="__DEBUG_CONTAINER__" class="__debug_vals_hidden__" style="display:none">
			<?php varz($debug['__CONTAINER__']); ?>
		</div>
	</div>

	<div class="__core_div_debug_field__">
		<div id="__DEBUG_SESSION__" class="__debug_nav_indices__"><a href="javascript:void(0);" onclick="debugDisplayField('__DEBUG_SESSION_FIELD__')">SESSION</a></div>
		<div id="__DEBUG_SESSION_FIELD__" rel="__DEBUG_SESSION__" class="__debug_vals_hidden__" style="display:none">
			<?php varz($debug['__SESSION__']); ?>
		</div>
	</div>

	<div class="__core_div_debug_field__">
		<div id="__DEBUG_GET__" class="__debug_nav_indices__"><a href="javascript:void(0);" onclick="debugDisplayField('__DEBUG_GET_FIELD__')">GET</a></div>
		<div id="__DEBUG_GET_FIELD__" rel="__DEBUG_GET__" class="__debug_vals_hidden__" style="display:none">
			<?php varz($debug['__GET__']); ?>
		</div>
	</div>

	<div class="__core_div_debug_field__">
		<div id="__DEBUG_POST__" class="__debug_nav_indices__"><a href="javascript:void(0);" onclick="debugDisplayField('__DEBUG_POST_FIELD__')">POST</a></div>
		<div id="__DEBUG_POST_FIELD__" rel="__DEBUG_POST__" class="__debug_vals_hidden__" style="display:none">
			<?php varz($debug['__POST__']); ?>
		</div>
	</div>

	<div class="__core_div_debug_field__">
		<div id="__DEBUG_SERVER__" class="__debug_nav_indices__"><a href="javascript:void(0);" onclick="debugDisplayField('__DEBUG_SERVER_FIELD__')">SERVER</a></div>
		<div id="__DEBUG_SERVER_FIELD__" rel="__DEBUG_SERVER__" class="__debug_vals_hidden__" style="display:none">
			<?php varz($debug['__SERVER__']); ?>
		</div>
	</div>
</div>
<script>
	if (!document.all) {
		function debugDisplayField(id) {
			var element = document.getElementById(id);
			if (element.style.display == 'none') {
				element.style.display = "block";
			}
			else {
				element.style.display = "none";
			}
		}
	}
</script>