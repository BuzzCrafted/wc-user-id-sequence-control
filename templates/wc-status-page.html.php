<table class="wc_status_table wc_status_table--tools widefat" cellspacing="0">
	<tbody class="tools">
		<tr class="wc-header">
			<th class="wc-header-content" colspan="2"><?php esc_html_e( 'Utils', 'wc-user-id-sequence-control' ); ?></th>
		</tr>
		<tr class="regenerte_order_nums">
			<th>
				<strong class="name"><?php esc_html_e( 'Regenerate order numbers', 'wc-user-id-sequence-control' ); ?></strong>
				<p class="description">	<?php esc_html_e( 'This tool will update order numbers according to the plugin settings.', 'wc-user-id-sequence-control' ); ?>		</p>
			</th>
			<td class="run-tool">					
				<button type="submit" form="form_regenerte_order_nums" class="button button-large button--utils js-con-utils-regenerate"><?php esc_html_e( 'Regenerate order numbers', 'wc-user-id-sequence-control' ); ?></button>
			</td>
		</tr>
		<tr class="reset_order_nums">
			<th>
				<strong class="name"><?php esc_html_e( 'Reset order numbers', 'wc-user-id-sequence-control' ); ?></strong>
				<p class="description">	<?php esc_html_e( 'This tool will reset order numbers according to the plugin settings.', 'wc-user-id-sequence-control' ); ?>		</p>
			</th>
			<td class="run-tool">					
				<button type="submit" form="form_reset_order_nums" class="button button-large button--utils  js-con-utils-reset" ><?php esc_html_e( 'Reset order numbers', 'wc-user-id-sequence-control' ); ?></button>
			</td>
		</tr>
		<tr class="fix_order_nums">
			<th>
				<strong class="name"><?php esc_html_e( 'Fix order numbers', 'wc-user-id-sequence-control' ); ?></strong>
				<p class="description">	<?php esc_html_e( 'This tool will fix order numbers and fill gaps in the sequence.', 'wc-user-id-sequence-control' ); ?>		</p>
			</th>
			<td class="run-tool">					
				<button type="submit" class="button button-large button--utils  js-con-utils-fix" ><?php esc_html_e( 'Fix order numbers', 'wc-user-id-sequence-control' ); ?></button>
			</td>
		</tr>
	</tbody>
</table>
<div class="message-box hidden" id="message-box-message"></span></div>
