<?php

function projects_task_connections() {
	p2p_register_connection_type( array(
		'name' => 'tasks_to_projcets',
		'from' => 'wppm_tasks',
		'to' => 'wppm_project'
	) );
}
add_action( 'p2p_init', 'my_connection_types' );
