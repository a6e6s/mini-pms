<?php

$translations = [
    // Navigation
    'navigation' => [
        'tasks' => 'Tasks',
        'kanban_board' => 'Kanban Board',
        'projects' => 'Projects',
        'users' => 'Users',
        'task_statuses' => 'Task Statuses',
        'comments' => 'Comments',
        'attachments' => 'Attachments',
    ],

    // Resources
    'resources' => [
        'tasks' => 'Tasks',
        'projects' => 'Projects',
        'users' => 'Users',
        'task_statuses' => 'Task Statuses',
        'comments' => 'Comments',
        'attachments' => 'Attachments',
    ],

    // Fields
    'fields' => [
        'title' => 'Title',
        'description' => 'Description',
        'project' => 'Project',
        'status' => 'Status',
        'due_date' => 'Due Date',
        'estimated_time' => 'Estimated Time',
        'time_taken' => 'Time Taken',
        'assigned_user' => 'Assigned User',
        'attachments' => 'Attachments',
        'name' => 'Name',
        'email' => 'Email',
        'email_address' => 'Email Address',
        'address' => 'Address',
        'password' => 'Password',
        'role' => 'Role',
        'user_role' => 'User Role',
        'phone' => 'Phone',
        'active' => 'Active',
        'owner' => 'Owner',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'color' => 'Color',
        'body' => 'Body',
        'file_path' => 'File Path',
        'file_name' => 'File Name',
        'file_size' => 'File Size',
        'mime_type' => 'MIME Type',
        'due_at' => 'Due At',
        'time_estimated' => 'Time Estimated (minutes)',
        'select_user' => 'Select User',
        'your_comment' => 'Your Comment',
        'user_id' => 'User ID',
        'full_name' => 'Full Name',
        'phone_number' => 'Phone Number',
        'registered_at' => 'Registered At',
        'last_updated' => 'Last Updated',
    ],

    // Kanban Board
    'kanban' => [
        'all_tasks' => 'All Tasks',
        'my_tasks' => 'My Tasks',
        'my_project_tasks' => 'My Project Tasks',
        'all_projects' => 'All Projects',
        'all_users' => 'All Users',
        'task' => 'task',
        'tasks' => 'tasks',
        'due' => 'Due',
        'new_task' => 'New Task',
        'view_task' => 'View Task',
        'add_comment' => 'Add Comment',
        'assign_to' => 'Assign to',
        'close' => 'Close',
        'not_set' => 'Not set',
        'click_to_add_description' => 'Click to add description...',
        'comments' => 'Comments',
        'no_comments_yet' => 'No comments yet.',
        'write_comment_placeholder' => 'Write your comment here...',
        'comment_added_successfully' => 'Comment added successfully',
        'user_assigned_successfully' => 'User assigned successfully',
        'upload_attachment' => 'Upload Attachment',
        'attachment_uploaded_successfully' => 'Attachment uploaded successfully',
        'no_attachments_yet' => 'No attachments yet.',
        'minutes' => 'min',
        'no_tasks' => 'No tasks',
    ],

    // Actions
    'actions' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'view' => 'View',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
    ],

    // Messages
    'messages' => [
        'success' => 'Operation completed successfully',
        'error' => 'An error occurred',
        'validation_error' => 'Please check the form for errors',
        'unauthorized' => 'You do not have permission to perform this action',
    ],

    // Filters
    'filters' => [
        'all' => 'All',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    // Sections
    'sections' => [
        'user_information' => 'User Information',
        'user_details' => 'User Details',
    ],

    // Form Labels
    'form' => [
        'required' => 'Required',
        'optional' => 'Optional',
        'search' => 'Search',
        'select_option' => 'Select an option',
        'multiple_selection' => 'Multiple selection allowed',
        'file_upload' => 'File Upload',
        'max_file_size' => 'Maximum file size: 10MB',
        'accepted_file_types' => 'Accepted file types: PDF, Images, Word documents, Text files',
        'estimated_time_help' => 'Estimated time to complete this task in minutes',
    ],

    // Widgets
    'widgets' => [
        'total_projects' => 'Total Projects',
        'all_projects_count' => 'All projects count',
        'avg_completed' => 'Avg. Completed',
        'average_completion_rate' => 'Average completion rate',
        'avg_incomplete' => 'Avg. Incomplete',
        'average_incomplete_rate' => 'Average incomplete rate',
        'task_statuses_distribution' => 'Task Statuses Distribution',
        'tasks_count' => 'Tasks Count',
        'projects_by_status' => 'Projects by Task Status',
        'total_tasks' => 'Total Tasks',
        'projects_completion_progress' => 'Projects Completion Progress',
        'completion_percentage' => 'Completion %',
    ],

    // Activity Feed
    'activity' => [
        'activity' => 'Activity',
        'recent_activity' => 'Recent Activity',
        'activity_log' => 'Activity Log',
        'no_activity_yet' => 'No activity yet',
        'unknown_user' => 'Unknown User',
        'task_created' => ':user created the task',
        'task_updated' => ':user updated the task',
        'task_deleted' => ':user deleted the task',
        'status_changed' => ':user changed the status from :old to :new',
        'assignee_added' => ':user assigned the task to :assignee',
        'assignee_removed' => ':user removed :assignee from the task',
        'comment_added' => ':user commented: ":comment"',
        'attachment_added' => ':user uploaded an attachment: :filename',
        'due_date_changed' => ':user changed the due date from :old to :new',
        'title_changed' => ':user changed the title from ":old" to ":new"',
        'description_changed' => ':user updated the description',
        'project_changed' => ':user moved the task from :old to :new',
        'time_taken_changed' => ':user updated time taken from :old min to :new min',
        'unknown_action' => ':user performed an action',
    ],

    // Global enum translations
    'Admin' => 'Admin',
    'User' => 'User',
    'Primary' => 'Primary',
    'Secondary' => 'Secondary',
    'Success' => 'Success',
    'Danger' => 'Danger',
    'Warning' => 'Warning',
    'Info' => 'Info',
    'Light' => 'Light',
    'Dark' => 'Dark',
];

return $translations;
