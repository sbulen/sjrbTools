# sjrbTools
Some helpful tools for SMF'ers

This is a collection of utilities I use to perform maintenance on & testing of my SMF forum.  I am sharing them here in case others find them helpful.

## SMF Inquiry Tools & Diagnostics

These tools are inquiry only & are used to perform diagnostics.

* ***SMF_Img_Proxy_Diag.php*** - This tool dumps key info about the environment & a particular user-specified image.  Used to understand Image Proxy issues.  It works for SMF2.0 & 2.1. 
* ***SMF_Settings_Diag.php*** - This tool dumps key settings.php entries and dumps the entire SMF settings table.  It works for SMF2.0 & 2.1.  ***NOTE -*** Some mods place sensitive information like passwords & hashes in the SMF settings table.  You may not want to share the output of this diagnostic publicly.  
* ***SMF_SSL_Diag.php*** - This tool dumps some helpful information on your SSL configuration.  It works for SMF2.0 & 2.1.
* ***SMF_Theme_Diag.php*** - This tool dumps a bunch of helpful information on your Themes.  It works for SMF2.0 & 2.1.
* ***SMF_Topic_Link_Diag.php*** - This tool dumps any quote link that appears to have issues, such as a missing originating message or an incorrect topic caused by splits/merges.  It works for SMF2.0 & 2.1.
* ***SMF_UTF8_Diag.php*** - This tool dumps a bunch of helpful information on the state of the character set & collation of your SMF database.  It works for SMF2.0 & 2.1.


## SMF Cron Jobs

* ***proxy-maint-cron.php*** - This is a very simple cron to prune back your image proxy cache every night.  SMF 2.0 & 2.1.  

## SMF DB Update Utilities

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***SMF_InnoDB_Converter.php*** - This tool converts your SMF forum's MySQL database engine to InnoDB.  SMF 2.0 & 2.1.  
* ***SMF_URLs_Paths.php*** - This tool converts all URLs and Paths throughout your SMF forum's database from one value to another.  SMF 2.0 & 2.1.  This tool updates all URLs and Paths found throughout the settings table, the themes table, the messages table, personal messages and members' signatures.  I use this to quickly clone working test environments, so they do not link to each other and I do not find myself working within the wrong environment after clicking on a link...  (Its original name was really_really_really_repair_settings.php, but I felt that was too long...)
