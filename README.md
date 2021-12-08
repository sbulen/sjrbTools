# sjrbTools
Some helpful tools for SMF'ers

This is a collection of utilities I use to perform maintenance on & testing of my SMF forum.  I am sharing them here in case others find them helpful.

## SMF Inquiry Tools & Diagnostics

These tools are inquiry only & are used to perform diagnostics.

* ***SMF_Img_Proxy_Diag.php*** - This tool dumps key info about the environment & a particular user-specified image.  Used to understand Image Proxy issues.  It works for SMF2.0 & 2.1. 
* ***smf_settings_diag.php*** - This tool dumps key settings.php entries and dumps the entire SMF settings table.  It works for SMF2.0 & 2.1.  ***NOTE -*** Some mods place sensitive information like passwords & hashes in the SMF settings table.  You may not want to share the output of this diagnostic publicly.  
* ***SMF_SSL_Diag.php*** - This tool dumps some helpful information on your SSL configuration.  It works for SMF2.0 & 2.1.
* ***SMF_Topic_Link_Diag.php*** - This tool dumps any quote link that appears to have issues, such as a missing originating message or an incorrect topic caused by splits/merges.  It works for SMF2.0 & 2.1.
* ***smf_utf8_diag.php*** - This tool dumps a bunch of helpful information on the state of the character set & collation of your SMF database.  It works for SMF2.0 & 2.1.
* ***smf_hex_dump.php*** - This tool dumps occurances of a specific column in a specific record in hex.  Useful for debugging UTF8 data issues.  It is UTF8 safe - it will not chop a multi-byte character in half.  It works for SMF2.0 & 2.1. 

## SMF Cron Jobs

* ***proxy-maint-cron.php*** - This is a very simple cron to prune back your image proxy cache every night.  SMF 2.0 & 2.1.  

## SMF DB Update Utilities

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***smf_innodb_converter.php*** - This tool converts your SMF forum's MySQL database engine to InnoDB.  SMF 2.0 & 2.1.  
* ***smf_read_inds_maint_2-0.php*** - This tool marks all boards read in a way that doesn't add millions of rows to your logs...  SMF 2.0.
* ***smf_read_inds_maint_2-1.php*** - This tool marks all boards read in a way that doesn't add millions of rows to your logs...  SMF 2.1.
* ***SMF_URLs_Paths.php*** - This tool converts all URLs and Paths throughout your SMF forum's database from one value to another.  SMF 2.0 & 2.1.  This tool updates all URLs and Paths found throughout the settings table, the themes table, the messages table, personal messages and members' signatures.  I use this to quickly clone working test environments, so they do not link to each other and I do not find myself working within the wrong environment after clicking on a link...  (Its original name was really_really_really_repair_settings.php, but I felt that was too long...)
* ***smf_fix_log_actions.php*** - Checks & fixes all string lengths in log_actions. UTF8 conversions can break string lengths in serialized strings.  SMF2.0.

## SMF UTF8 Utilities

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***smf_fix_dbl_enc_deep.php*** - Addresses double-encoding issues in messages.  While addressing, checks for 4-byte UTF8 characters & converts them to htmlentities if needed.  SMF2.0 & 2.1.

## Github utility

* ***github_dump.php*** - Dumps Issue & PR info for a specified repository into a comma-delimited file. 

## mergeSMF

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***mergeSMF.php*** - Merges two forums.  SMF2.0 & 2.1.

For more information about the mergeSMF.php script, check the thread in the forum here: https://www.simplemachines.org/community/index.php?topic=575102.0

## MySQL to Postgresql Utilities

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***PGConverter.php*** - Reads output from a mysqldump, then updates it to make it suitable for an import into postgresql.
* ***PGConvertSeqs.php*** - To be run after conversion from mysql to postgresql.  Updates sequences to ensure they are in sync with the current data.
