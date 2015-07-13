<?php

/**
 * Public function for the HTML field callback
 * @param object $field
 * @param string $value
 * @param int $post_id
 */
function voce_color_field_display( $field, $value, $post_id ) {
	$palettes = isset($field->args['palettes']) ? $field->args['palettes'] : true;
	?>
	<p>
		<?php voce_field_label_display( $field ); ?>
		<input data-palettes="<?php echo esc_attr(json_encode($palettes)); ?>" type="text" class="voce-color-picker" id="<?php echo esc_attr( $field->get_input_id( ) ); ?>" name="<?php echo esc_attr( $field->get_name( ) ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	</p>
	<?php
}