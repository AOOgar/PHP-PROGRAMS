<?php
defined( 'ABSPATH' ) || die();

global $wpdb;

$page_url = WLSM_M_Staff_Accountant::get_expenses_page_url();

$school_id = $current_school['id'];

$expense = NULL;

$nonce_action = 'add-expense';

$label          = '';
$expense_date   = '';
$invoice_number = '';
$amount         = '';
$note           = '';
$attachment           = '';

$expense_category_id = NULL;

if ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) {
	$id      = absint( $_GET['id'] );
	$expense = WLSM_M_Staff_Accountant::fetch_expense( $school_id, $id );

	if ( $expense ) {
		$nonce_action = 'edit-expense-' . $expense->ID;

		$label          = $expense->label;
		$expense_date   = $expense->expense_date;
		$invoice_number = $expense->invoice_number;
		$amount         = $expense->amount;
		$note           = $expense->note;
		$attachment           = $expense->attachment;

		$expense_category_id = $expense->expense_category_id;
	}
}

$categories = WLSM_M_Staff_Accountant::fetch_expense_categories( $school_id );
?>
<div class="row">
	<div class="col-md-12">
		<div class="mt-3 text-center wlsm-section-heading-block">
			<span class="wlsm-section-heading-box">
				<span class="wlsm-section-heading">
					<?php
					if ( $expense ) {
						printf(
							wp_kses(
								/* translators: %s: expense title */
								__( 'Edit Expense: %s', 'school-management' ),
								array(
									'span' => array( 'class' => array() )
								)
							),
							esc_html( stripcslashes( $label ) )
						);
					} else {
						esc_html_e( 'Add New Expense', 'school-management' );
					}
					?>
				</span>
			</span>
			<span class="float-md-right">
				<a href="<?php echo esc_url( $page_url ); ?>" class="btn btn-sm btn-outline-light">
					<i class="fas fa-file-invoice"></i>&nbsp;
					<?php esc_html_e( 'View All', 'school-management' ); ?>
				</a>
			</span>
		</div>
		<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlsm-save-expense-form">

			<?php $nonce = wp_create_nonce( $nonce_action ); ?>
			<input type="hidden" name="<?php echo esc_attr( $nonce_action ); ?>" value="<?php echo esc_attr( $nonce ); ?>">

			<input type="hidden" name="action" value="wlsm-save-expense">

			<?php if ( $expense ) { ?>
			<input type="hidden" name="expense_id" value="<?php echo esc_attr( $expense->ID ); ?>">
			<?php } ?>

			<div class="wlsm-form-section">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="wlsm_label" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Title', 'school-management' ); ?>:
						</label>
						<input type="text" name="label" class="form-control" id="wlsm_label" placeholder="<?php esc_attr_e( 'Enter expense title', 'school-management' ); ?>" value="<?php echo esc_attr( stripcslashes( $label ) ); ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="wlsm_category" class="wlsm-font-bold">
							<?php esc_html_e( 'Category', 'school-management' ); ?>:
						</label>
						<select name="category_id" class="form-control selectpicker" id="wlsm_category" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Expense Category', 'school-management' ); ?></option>
							<?php foreach ( $categories as $category ) { ?>
							<option value="<?php echo esc_attr( $category->ID ); ?>" <?php selected( $category->ID, $expense_category_id, true ); ?>>
								<?php echo esc_html( WLSM_M_Staff_Accountant::get_label_text( $category->label ) ); ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="wlsm_amount" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Amount', 'school-management' ); ?>:
						</label>
							<input type="number" step="any" min="0" name="amount" class="form-control" id="wlsm_amount" placeholder="<?php esc_attr_e( 'Enter amount', 'school-management' ); ?>" value="<?php echo esc_attr( $amount ? WLSM_Config::sanitize_money( $amount ) : '' ); ?>">
					</div>
					<div class="form-group col-md-4">
						<label for="wlsm_invoice_number" class="wlsm-font-bold">
							<?php esc_html_e( 'Invoice Number', 'school-management' ); ?>:
						</label>
						<input type="text" name="invoice_number" class="form-control" id="wlsm_invoice_number" placeholder="<?php esc_attr_e( 'Enter invoice number', 'school-management' ); ?>" value="<?php echo esc_attr( $invoice_number ); ?>">
					</div>
					<div class="form-group col-md-4">
						<label for="wlsm_expense_date" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Expense Date', 'school-management' ); ?>:
						</label>
						<input type="text" name="expense_date" class="form-control" id="wlsm_expense_date" placeholder="<?php esc_attr_e( 'Expense Date', 'school-management' ); ?>" value="<?php echo esc_attr( WLSM_Config::get_date_text( $expense_date ) ); ?>">
					</div>
				</div>

				
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="wlsm_attachment" class="wlsm-font-bold">
							<?php esc_html_e( 'Attachment', 'school-management' ); ?>:
						</label>
						<?php if (!empty($attachment)) { ?>
									<br>
									<a target="_blank" href="<?php echo esc_url(wp_get_attachment_url($attachment)); ?>" class="text-primary wlsm-font-bold wlsm-attachment"><?php esc_html_e('Attachment', 'school-management'); ?></a>
								<?php } ?>
						<input type="file" name="attachment" class="form-control" id="wlsm_attachment" >
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="wlsm_note" class="wlsm-font-bold">
							<?php esc_html_e( 'Note', 'school-management' ); ?>:
						</label>
						<textarea name="note" class="form-control" id="wlsm_note" cols="30" rows="2" placeholder="<?php esc_attr_e( 'Enter note', 'school-management' ); ?>"><?php echo esc_html( $note ); ?></textarea>
					</div>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary" id="wlsm-save-expense-btn">
						<?php
						if ( $expense ) {
							?>
							<i class="fas fa-save"></i>&nbsp;
							<?php
							esc_html_e( 'Update Expense', 'school-management' );
						} else {
							?>
							<i class="fas fa-plus-square"></i>&nbsp;
							<?php
							esc_html_e( 'Add New Expense', 'school-management' );
						}
						?>
					</button>
				</div>
			</div>

		</form>
	</div>
</div>
