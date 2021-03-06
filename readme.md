# Voce Post Meta Colors
Contributors: markparolisi, voceplatforms  
Requires at least: 3.5.0  
Tested up to: 4.0  
Stable tag: 1.3.3
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

## Description
Extend Voce Post Meta with color picker (iris) fields


## Usage
```php
<?php
add_action('init', function(){
  add_metadata_group( 'demo_meta', 'Page Options', array(
      'capability' => 'edit_posts'
  ) );
  add_metadata_field( 'demo_meta', 'demo_color', 'Demo Color', 'color' );
  add_post_type_support( 'page', 'demo_meta' );
});
```

## Installation
1. Upload `voce-post-meta-colors` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Create post meta fields like this
```php
<?php
add_action('init', function(){
  add_metadata_group( 'demo_meta', 'Page Options', array(
      'capability' => 'edit_posts'
  ) );
  add_metadata_field( 'demo_meta', 'demo_color', 'Demo Color', 'color' );
  add_post_type_support( 'page', 'demo_meta' );
});
```

## Changelog
**1.3.3**
* better handling around autoload files when required by multiple project dependencies

**1.3.2**
* moved to immediate initialization since admin_init was too late

**1.3.1**
* fixing bug with wrong has_action function

**1.3.0**
* Preventing fatal error for setups that load dependencies before WordPress


**1.1**
* Adding support for custom palette arg

**1.0.0**
* Initial release
