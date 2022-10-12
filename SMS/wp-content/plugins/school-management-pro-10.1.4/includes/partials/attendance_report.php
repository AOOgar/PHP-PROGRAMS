<?php
defined( 'ABSPATH' ) || die();
?>
<div class="wlsm-st-attendance-section table-responsive w-100 wlsm-w-100">
	<table class="wlsm-st-attendance-table table table-hover table-bordered wlsm-w-100 wlsm-text-left">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Month', 'school-management' ); ?></td>
				<th><?php esc_html_e( 'Total Attendance', 'school-management' ); ?></td>
				<th><?php esc_html_e( 'Total Present', 'school-management' ); ?></td>
				<th><?php esc_html_e( 'Total Absent', 'school-management' ); ?></td>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_attendance = 0;
			$total_present    = 0;
			$total_absent     = 0;
			foreach ( $attendance as $monthly ) {
				$month = new DateTime();
				$month->setDate( $monthly->year, $monthly->month, 1 );
				$total_attendance += $monthly->total_attendance;
				$total_present    += $monthly->total_present;
				$total_absent     += $monthly->total_absent;
				?>
			<tr>
				<td><?php echo esc_html( $month->format( 'F Y' ) ); ?></td>
				<td><?php echo esc_html( $monthly->total_attendance ); ?></td>
				<td><?php echo esc_html( $monthly->total_present ); ?></td>
				<td><?php echo esc_html( $monthly->total_absent ); ?></td>
			</tr>
				<?php
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th><?php esc_html_e( 'Overall', 'school-management' ); ?></td>
				<th><?php echo esc_html( $total_attendance ); ?></td>
				<th><?php echo esc_html( $total_present ); ?></td>
				<th><?php echo esc_html( $total_absent ); ?></td>
			</tr>
		</tfoot>
	</table>
</div>


<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlsm-view-attendance-form">
	<?php $nonce_action = 'view-attendance-student'; ?>
	<?php $nonce = wp_create_nonce( $nonce_action ); ?>
	<input type="hidden" name="<?php echo esc_attr( $nonce_action ); ?>" value="<?php echo esc_attr( $nonce ); ?>">
	<input type="hidden" name="action" value="<?php echo esc_attr( 'wlsm-view-attendance' ); ?>">
	<input type="hidden" id="wlsm_class" name="class_id" value="<?php echo esc_attr( $student->class_id); ?>">
	<input type="hidden" id="wlsm_section" name="section_id" value="<?php echo esc_attr( $student->section_id ); ?>">
	<input type="hidden" id="wlsm_school_id" name="school_id" value="<?php echo esc_attr( $school_id ); ?>">
	<input type="hidden" id="wlsm_session_id" name="session_id" value="<?php echo esc_attr( $student->session_id ); ?>">
	<input type="hidden" id="wlsm_student_id" name="student_id" value="<?php echo esc_attr( $student->ID ); ?>">

	<div class="form-group col-md-4">
		<label for="wlsm_attendance_year_month" class="wlsm-font-bold">
			<span class="wlsm-important">*</span> <?php esc_html_e( 'Month', 'school-management' ); ?>:
		</label>
		<input type="text" name="year_month" class="form-control" id="wlsm_attendance_year_month" placeholder="<?php esc_attr_e( 'Month', 'school-management' ); ?>">
	</div>
		
	<br> 

	<button type="button" class="btn btn-sm btn-primary" id="wlsm-view-attendance-btn" data-nonce="<?php echo esc_attr( wp_create_nonce( 'view-attendance-student' ) ); ?>">
		<?php esc_html_e( 'View Attendance', 'school-management' ); ?>
	</button>

	<div class="wlsm-students-attendance mt-2"></div>

</form>
