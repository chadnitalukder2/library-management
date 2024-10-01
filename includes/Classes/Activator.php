<?php

namespace libraryManagement\Classes;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Ajax Handler Class
 * @since 1.0.0
 */
class Activator
{
    public function migrateDatabases($network_wide = false)
    {
        global $wpdb;
        if ($network_wide) {
            // Retrieve all site IDs from this network (WordPress >= 4.6 provides easy to use functions for that).
            if (function_exists('get_sites') && function_exists('get_current_network_id')) {
                $site_ids = get_sites(array('fields' => 'ids', 'network_id' => get_current_network_id()));
            } else {
                $site_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs WHERE site_id = $wpdb->siteid;");
            }
            // Install the plugin for all these sites.
            foreach ($site_ids as $site_id) {
                switch_to_blog($site_id);
                $this->migrate();
                restore_current_blog();
            }
        } else {
            $this->migrate();
        }
    }

    private function migrate()
    {
        /*
        * database creation commented out,
        * If you need any database just active this function bellow
        * and write your own query at createBookmarkTable function
        */

        $this->migrateBooksTable();
        $this->migrateMembersTable();
        $this->migrateBorrowRecordsTable();
        $this->migrateCategoryTable();
        $this->migrateStaffTable();
    }

    public function migrateBooksTable()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'lmt_books';
        $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        book_name varchar(255)  NOT NULL,
        images varchar(255) DEFAULT NULL,
        category_name varchar(255) NOT NULL,
        author varchar(255)  NOT NULL,
        publisher varchar(255)   NULL,
        published_date varchar(255) NULL,
        quantity int(11)    NULL,
        edition varchar(255) NULL,
        description varchar(255) NULL,
        added_date varchar(255) NULL,
        created_at timestamp NULL,
        updated_at timestamp NULL,
        PRIMARY KEY (id)
        ) $charset_collate;";
        $this->runSQL($sql, $table_name);
    }

    public function migrateMembersTable()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'lmt_members';
        $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255)  NOT NULL,
        phone int(11) NOT NULL,
        address varchar(255) NULL,
        membership_date varchar(255)  NULL,
        membership_type varchar(255) NULL,
        created_at timestamp NULL,
        updated_at timestamp NULL,
        PRIMARY KEY (id)
        ) $charset_collate;";
        $this->runSQL($sql, $table_name);
    }

    public function migrateBorrowRecordsTable()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'lmt_borrow_records';
        $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        book_id int(11) NOT NULL,
        member_id int(11) NOT NULL,
        borrow_date varchar(255) NULL,
        return_date varchar(255) NULL,
        status varchar(255) NULL,
        created_at timestamp NULL,
        updated_at timestamp NULL,
        PRIMARY KEY (id)
        ) $charset_collate;";
        $this->runSQL($sql, $table_name);
    }

    public function migrateCategoryTable()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'lmt_category';
        $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        description TEXT NULL,
        created_at timestamp NULL,
        updated_at timestamp NULL,
        PRIMARY KEY (id)
        ) $charset_collate;";
        $this->runSQL($sql, $table_name);
    }

    public function migrateStaffTable()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'lmt_staff';
        $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) DEFAULT NULL,
        email varchar(255)  DEFAULT NULL,
        role  varchar(255)  DEFAULT NULL,
        joined_date varchar(255) NULL,
        created_at timestamp NULL,
        updated_at timestamp NULL,
        PRIMARY KEY (id)
        ) $charset_collate;";
        $this->runSQL($sql, $table_name);
    }


    private function runSQL($sql, $tableName)
    {
        global $wpdb;
        if ($wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
}
