<?php

/**
 * Returns the ids of tasks assigned to a project
 *
 * @since 1.0
 * @author SFNdesign, Curtis McHale
 *
 * @param   int         $project_id             required            The id of the project we want tasks from
 * @uses    get_post_meta()                                         Returns post_meta given key and post_id
 * @renurn  array       $tasks                                      Array of task ids
 */
function wppm_get_task_ids_for_project( $project_id ){

	$tasks = get_post_meta( absint( $project_id ), '_wppm_task_ids', true );

	return $tasks;

}
