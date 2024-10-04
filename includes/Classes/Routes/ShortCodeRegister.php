<?php
// Step 1: Create a class to handle shortcodes
namespace libraryManagement\Classes\Routes;

class ShortcodeRegister {

    // Step 2: Register your shortcode function
    public function register() {
        add_shortcode('lmt_book_search', array($this, 'bookSearchShortCode'));
    }

    // Step 3: Define what the shortcode does
    public function bookSearchShortCode($atts) {
        ob_start(); // Capture the output
        echo "<h1>Welcome to the Book Search</h1>"; // This is where your dynamic content goes
        return ob_get_clean(); // Return the output
    }
}


